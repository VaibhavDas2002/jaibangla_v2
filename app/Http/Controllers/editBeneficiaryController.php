<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class editBeneficiaryController extends Controller
{
    //
    public function editBeneficiary()
    {
        $docPresent = DB::table('m_doc_modification')->get();
        $schemes = DB::table('m_scheme')->get();
        return view('components/editBeneficiary/editBeneficiary', compact('docPresent', 'schemes'));
    }

    public function findApplicants(Request $request)
    {
        $request->validate([
            'schemes' => 'required',
            'searchCriteria' => 'required',
            'searchValue' => 'required'
        ]);

        $criteria = $request->searchCriteria;
        $value = strtoupper($request->searchValue);
        // dd($value , $criteria);

        $records = DB::table('beneficiary_modifications')
            ->join('m_doc_modification', 'beneficiary_modifications.selected_documents_id', '=', 'm_doc_modification.id')
            ->select(
                'beneficiary_modifications.token_id',
                'beneficiary_modifications.beneficiary_id',
                'beneficiary_modifications.beneficiary_name',
                'beneficiary_modifications.mobile_no',
                'beneficiary_modifications.aadhar_no',
                'beneficiary_modifications.is_changed',
                DB::raw('STRING_AGG(m_doc_modification.doc_name, \', \') as selected_documents')
            )
            ->where("beneficiary_modifications.{$criteria}", 'LIKE', "%{$value}%") // Fully qualify the column
            ->where('scheme_id', $request->schemes)
            ->where('beneficiary_modifications.status', 3)
            ->groupBy(
                'beneficiary_modifications.token_id',
                'beneficiary_modifications.beneficiary_id',
                'beneficiary_modifications.beneficiary_name',
                'beneficiary_modifications.mobile_no',
                'beneficiary_modifications.aadhar_no',
                'beneficiary_modifications.is_changed'
            )
            ->get();

        // dd($records);

        return response()->json(['success' => true, 'data' => $records]);
    }


    public function editBeneficiaryPage(Request $request)
    {
        // Retrieve the token_id and beneficiary_id from the request
        $tokenId = $request->query('token_id');
        $beneficiaryId = $request->query('beneficiary_id');

        // Fetch the beneficiary data based on token_id and beneficiary_id
        $beneficiary = DB::table('pension.beneficiaries')
            ->where('id', $beneficiaryId)
            ->first();

        // Fetch the selected documents related to the beneficiary
        $selectedDocuments = DB::table('beneficiary_modifications')
            ->join('m_doc_modification', 'beneficiary_modifications.selected_documents_id', '=', 'm_doc_modification.id')
            ->where('beneficiary_modifications.token_id', $tokenId)
            ->where('beneficiary_modifications.beneficiary_id', $beneficiaryId)
            ->pluck('m_doc_modification.doc_name'); // This will return the selected documents

        // Fetch details for selected documents
        $documentMap = [
            "Aadhar Information" => "Copy of Aadhar Card",
            "Bank Information" => "Copy of Bank Pass book",
            "Caste Certificate Information" => "Copy of Caste Certificate",
            "Ration Card Information" => "Copy of Digital Ration Card",
        ];

        // Map the selected documents to their corresponding values in m_attached_doc
        $mappedDocumentNames = $selectedDocuments->map(function ($docName) use ($documentMap) {
            return $documentMap[$docName] ?? null; // Get the mapped value or null if not found
        })->filter(); // Remove null values in case of unmapped doc names

        // Fetch document details from m_attached_doc using the mapped names
        $documentDetails = DB::table('m_attached_doc')
            ->whereIn('doc_name', $mappedDocumentNames->toArray())
            ->get()
            ->keyBy(function ($item) use ($documentMap) {
                return array_search($item->doc_name, $documentMap) ?: $item->doc_name;
            });

        // Return the data to the Blade view
        return view('components/editBeneficiary/editPage', compact('beneficiary', 'selectedDocuments', 'documentDetails'));
    }


    public function handleDocumentUpload(Request $request)
    {
        // dd($request->input('mobile_number'));
        $ip_address = $request->ip();
        $beneficiary_id = $request->input('beneficiary_id');
        $token_id = $request->input('token_id');
        $c_datetime = date('Y-m-d H:i:s');
        $user_id = Auth::user()->id; // Replace with actual user ID fetch logic
        $selectedDocuments = $request->input('selected_documents'); // Array of selected document types

        // Json data store for old benefiaries table
        $oldRecord = DB::table('pension.beneficiaries')->where('id', $beneficiary_id)->first();
        if ($oldRecord) {
            $trimmedRecord = [];
            foreach ($oldRecord as $key => $value) {
                $trimmedRecord[$key] = is_string($value) ? trim($value) : $value;
            }
            $oldRecordJson = json_encode($trimmedRecord);
            DB::table('public.old_beneficiary_archives')->insert([
                'beneficiary_id' => $beneficiary_id,
                'old_record' => $oldRecordJson,
                'token_id' => $token_id,
                'edited_by' => $user_id,
                'created_at' => now()
            ]);
        } else {
            return response()->json(['error' => 'Beneficiary not found.'], 404);
        }

        $scheme_id = DB::table('beneficiary_modifications')
            ->where('beneficiary_id', $beneficiary_id)
            ->where('token_id', $token_id)
            ->first()
            ->scheme_id;

        $benDetails = DB::table('pension.beneficiaries')->where('id', $beneficiary_id)->first();

        // Static mapping
        $documentMap = [
            "Aadhar Information" => "Copy of Aadhar Card",
            "Bank Information" => "Copy of Bank Pass book",
            "Caste Certificate Information" => "Copy of Caste Certificate",
            "Ration Card Information" => "Copy of Digital Ration Card",
        ];
        // $rules = [
        //     'ben_fname' => 'required|string|max:255',
        //     'ben_mname' => 'nullable|string|max:255',
        //     'ben_lname' => 'required|string|max:255',
        //     'mobile_number' => 'required|digits:10',
        //     'aadhar_number' => 'required|digits:12',
        //     'ration_card_cat' => 'required|string|max:255',
        //     'ration_card_no' => 'required|string|max:255',
        //     'caste' => 'required|string|max:255',
        //     'caste_certificate_no' => 'required|string|max:255',
        //     'bank_ifsc_code' => 'required|string|max:11',
        //     'name_of_bank' => 'required|string|max:255',
        //     'bank_branch' => 'required|string|max:255',
        //     'bank_account_number' => 'required|string|max:255',
        // ];

        // // Validate incoming fields
        // $validator = Validator::make($request->all(), $rules);

        // if ($validator->fails()) {
        //     return back()->with('error', "Missing Values! Some Fields are required.");
        // }

        $updateData = ['updated_at' => $c_datetime];

        foreach ($selectedDocuments as $doc_type_name) {

            // rules checking
            $specificRules = [];

            // Set validation rules for specific document types
            if ($doc_type_name === "Name") {
                $specificRules = [
                    'ben_fname' => 'required|string|max:255',
                    'ben_mname' => 'nullable|string|max:255',
                    'ben_lname' => 'required|string|max:255',
                ];
            }

            if ($doc_type_name === "Mobile No.") {
                $specificRules = [
                    'mobile_number' => 'required|digits:10',
                ];
            }

            if ($doc_type_name === "Aadhar Information") {
                $specificRules = [
                    'aadhar_number' => 'required|digits:12',
                ];
            }

            if ($doc_type_name === "Ration Card Information") {
                $specificRules = [
                    'ration_card_cat' => 'required|string|max:255',
                    'ration_card_no' => 'required|string|max:255',
                ];
            }

            if ($doc_type_name === "Caste Certificate Information") {
                $specificRules = [
                    'caste' => 'required|string|max:255',
                    'caste_certificate_no' => 'required|string|max:255',
                ];
            }

            if ($doc_type_name === "Bank Information") {
                $specificRules = [
                    'bank_ifsc_code' => 'required|string|max:11',
                    'name_of_bank' => 'required|string|max:255',
                    'bank_branch' => 'required|string|max:255',
                    'bank_account_number' => 'required|string|max:255',
                ];
            }

            // If there are specific rules, validate the input
            if (!empty($specificRules)) {
                $validator = Validator::make($request->all(), $specificRules);

                if ($validator->fails()) {
                    return back()->with('error', "Missing or Invalid values for {$doc_type_name}. Please check the fields.");
                }
            }

            // Collect Name fields
            if ($doc_type_name === "Name") {
                $updateData['ben_fname'] = $request->input('ben_fname');
                $updateData['ben_mname'] = $request->input('ben_mname');
                $updateData['ben_lname'] = $request->input('ben_lname');
                continue;
            }

            // Collect Mobile Number
            if ($doc_type_name === "Mobile No.") {

                $updateData['mobile_no'] = $request->input('mobile_number');
                continue;
            }

            // Collect Aadhar Number
            if ($doc_type_name === "Aadhar Information") {
                $updateData['aadhar_no'] = $request->input('aadhar_number');
                continue;
            }

            // Collect Ration Card Information
            if ($doc_type_name === "Ration Card Information") {
                $updateData['ration_card_cat'] = $request->input('ration_card_cat');
                $updateData['ration_card_no'] = $request->input('ration_card_no');
                continue;
            }

            // Collect Caste and Caste Certificate Information
            if ($doc_type_name === "Caste Certificate Information") {
                $updateData['caste'] = $request->input('caste');
                $updateData['caste_certificate_no'] = $request->input('caste_certificate_no');
                continue;
            }

            // Collect Bank Information
            if ($doc_type_name === "Bank Information") {
                $updateData['bank_ifsc'] = $request->input('bank_ifsc_code');
                $updateData['bank_name'] = $request->input('name_of_bank');
                $updateData['branch_name'] = $request->input('bank_branch');
                $updateData['bank_code'] = $request->input('bank_account_number');
                continue;
            }
        }

        DB::table('pension.beneficiaries')->where('id', $beneficiary_id)->update($updateData);

        // For Files Upload..
        foreach ($selectedDocuments as $doc_type_name) {

            // Skip unmapped types
            if (!array_key_exists($doc_type_name, $documentMap)) {
                continue;
            }

            // Map to the corresponding database document name
            $mappedDocName = $documentMap[$doc_type_name];

            // Retrieve document details from the database
            $doc_arr = DB::table('m_attached_doc')->where('doc_name', $mappedDocName)->first();
            if (!$doc_arr) {
                continue; // Skip if the document does not exist in the database
            }

            // Match the input file field to the mapped document name
            $inputName = strtolower(str_replace(' ', '_', $doc_type_name)); // Convert spaces to underscores
            $upload_file = $request->file($inputName);
            if (!$upload_file) {
                continue; // Skip if no file is uploaded for this document
            }

            // Check if the file is required
            // dd($doc_arr);
            // $isRequired = isset($doc_arr->is_required) && $doc_arr->is_required; // Assuming 'is_required' is a column in 'm_attached_doc'

            // if ($isRequired && !$upload_file) {
            //     return back()->with('error', "The file for {$doc_type_name} is required.");
            // }

            // // Validate file type
            $mime_type = $upload_file->getMimeType();
            $allowedMimeTypes = array_map('trim', explode(',', preg_replace('/\s+/', '', $doc_arr->doc_mime_type)));

            if (!in_array($mime_type, $allowedMimeTypes)) {
                return back()->with('error', "Invalid file type for {$doc_type_name}. Allowed types: " . implode(', ', $allowedMimeTypes));
            }

            // Validate file size
            $maxSizeInKB = $doc_arr->doc_size_kb;
            $maxSizeInBytes = $maxSizeInKB * 1024;
            $fileSize = $upload_file->getSize();
            if ($fileSize > $maxSizeInBytes) {
                return back()->with('error', "File size for {$doc_type_name} is too large. Maximum allowed size is {$maxSizeInKB} KB.");
            }

            // Prepare file-specific data
            $img_data = file_get_contents($upload_file);
            $extension = $upload_file->getClientOriginalExtension();
            $mime_type = $upload_file->getMimeType();
            $base64 = base64_encode($img_data);

            // Call the database function
            $fun_call = DB::connection('pgsql_encwrite')->select("
                SELECT jb_doc.ben_docs_insert_archive(
                    in_document_type => {$doc_arr->id},
                    in_attched_document => '{$base64}',
                    in_document_extension => '{$extension}',
                    in_document_mime_type => '{$mime_type}',
                    in_doc_type_name => '{$doc_arr->doc_name}',
                    in_beneficiary_id => {$beneficiary_id},
                    in_scheme_id => {$scheme_id},
                    in_created_by => {$user_id},
                    in_created_by_level => '{$benDetails->created_by_level}',
                    in_created_by_dist_code => {$benDetails->created_by_dist_code},
                    in_created_by_local_body_code => {$benDetails->created_by_local_body_code},
                    in_ip_address => '{$ip_address}',
                    in_datetime => '{$c_datetime}'
                );
            ");

            $is_upload = $fun_call[0]->ben_docs_insert_archive;
            if (!$is_upload) {
                return back()->with('error', "Failed to upload document: {$doc_type_name}");
            }
        }

        // update status of is_changed field to 1 for updating
        DB::table('beneficiary_modifications')
            ->where('beneficiary_id', $beneficiary_id)
            ->where('token_id', $token_id)
            ->update(['is_changed' => 1]);

        return redirect()->route('editBeneficiary')->with('success', 'All documents uploaded successfully!');
    }
}
