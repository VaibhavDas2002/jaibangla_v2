<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class tokenrequestcreationController extends Controller
{
    public function tokenCreation()
    {
        $docPresent = DB::table('m_doc_modification')->get();
        $schemes = DB::table('m_scheme')->get();
        return view('components/tokenCreate/tokencreation', compact('docPresent', 'schemes'));
    }

    public function searchBeneficiaries(Request $request)
    {
        $schemeId = $request->input('schemes');
        $searchCriteria = $request->input('searchCriteria');
        $searchValue = strtoupper($request->input('searchValue'));
        // Validate if search criteria is allowed
        $validCriteria = ['id', 'mobile_no', 'aadhar_no', 'bank_code', 'ben_fname'];

        if (!in_array($searchCriteria, $validCriteria)) {
            return response()->json(['error' => 'Invalid search criteria'], 400);
        }
        // Perform the search, first filtering by scheme_id, then by the search criteria
        $query = DB::table('pension.beneficiaries')
            ->where('scheme_id', $schemeId);

        if ($searchValue) {
            $query->where($searchCriteria, 'LIKE', "%{$searchValue}%");
        }
        // Execute the query and get the results
        $searchResults = $query->get();
        // Return the results as a JSON response
        return response()->json($searchResults);
    }


    public function finalSubmit(Request $request)
    {
        // dd('kyfk');
        $updateData['process_edit_status'] = 1;
        $records = $request->input('records');
        $tokenId = random_int(100000, 999999); // Generate a random token
        foreach ($records as $record) {
            $beneficiaryId = $record['id'];
            $beneficiaryName = $record['name'];
            $mobileNo = $record['mobile'];
            $aadharNo = $record['aadhar'];
            $schemeId = $request->input('schemes'); // assuming this is passed with the records
            // dd($record);
            foreach ($record['selectedDocuments'] as $document) {
                DB::table('beneficiary_modifications')->insert([
                    'beneficiary_id' => $beneficiaryId,
                    'beneficiary_name' => $beneficiaryName,
                    'mobile_no' => $mobileNo,
                    'aadhar_no' => $aadharNo,
                    'scheme_id' => $schemeId,
                    'selected_documents_id' => $document, // assuming document IDs are available
                    // 'selected_documents' => $document['name'],
                    'token_id' => $tokenId,
                    'status' => 1, // or any other default status
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            DB::table('pension.beneficiaries')->where('id', $beneficiaryId)->update($updateData);
        }
        return response()->json(['success' => 'Records submitted successfully']);
    }
}
