<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Config;
use Livewire\Component;
use App\Models\District;
use App\Models\DocumentType;
use App\Models\SchemeDocMap;
use Illuminate\Support\Facades\DB;
use Exception;


class GenericForm extends Component
{
    public $scheme_id;
    public $districts;
    public $ds_phases;
    public $document_msg = '';
    public $doc_profile_image_id = 999; // Set default as 999
    public $doc_list_man = [];
    public $doc_list_opt = [];
    public $is_active = 0;
    public $confirm_submit = 0;
    //Form Data
    public $entry_type = 1;
    public $ds_registration_no;
    public $ds_date;
    public $first_name = null;
    public $middle_name = null;
    public $last_name = null;
    public $gender = null;
    public $dob;
    public $father_first_name = null;
    public $father_middle_name = null;
    public $father_last_name = null;
    public $mother_first_name = null;
    public $mother_middle_name = null;
    public $mother_last_name = null;
    public $caste_certificate_no = null;
    public $maratial_status = null;
    public $monthly_income = null;
    public $spouse_first_name = null;
    public $spouse_middle_name = null;
    public $spouse_last_name = null;

    public $ration_no = null;
    public $ration_cat = null;
    public $epic_vot_id = null;
    public $pan = null;
    public $aadhar_no = null;

    public $showModal = false;


    protected $rules = [
        'scheme_id' => 'required|integer',
        'entry_type' => 'required|in:1,2',
        'first_name' => 'required|regex:/^[A-Za-z\s]+$/|min:3|max:50',
        'last_name' => 'required|regex:/^[A-Za-z\s]+$/|min:3|max:50',
        'gender' => 'required',
        'dob' => 'required',
        'father_first_name' => 'required|regex:/^[A-Za-z\s]+$/|min:3|max:50',
        'father_last_name' => 'required|regex:/^[A-Za-z\s]+$/|min:3|max:50',
        'monthly_income' => 'nullable|numeric',
        'maratial_status' => 'required',
        'ration_no' => 'required',
        'ration_cat' => 'required',
        'epic_vot_id' => 'required',
        'aadhar_no' => 'required'
    ];
    protected $messages = [
        'scheme_id.required' => 'The Scheme ID is required',
        'entry_type.required' => 'The Entry Type is required',
        'first_name.required' => 'The Name is required',
        'first_name.regex' => 'The name consists of only letters, spaces, parentheses and hyphens.',
        'last_name.required' => 'The Name is required',
        'last_name.regex' => 'The name consists of only letters, spaces, parentheses and hyphens.',
        'gender.required' => 'The Gender is required',
        'dob.required' => 'The Date of Birth is required',
        'father_first_name.required' => 'The Father\'s first Name is required',
        'father_first_name.regex' => 'The Father\'s name consists of only letters, spaces, parentheses and hyphens.',
        'father_last_name.required' => 'The The Father\'s first Name is required',
        'father_last_name.regex' => 'The Father\'s name consists of only letters, spaces, parentheses and hyphens.',
        'maratial_status.required' => 'Maratial Status is required',
        'ration_no.required' => 'The Ration Card Number is required',
        'ration_cat.required' => 'The Ration Card Category is required',
        'epic_vot_id.required' => 'The EPIC/VOTER ID is required',
        'aadhar_no.required' => 'The Aadhar Number is required'
    ];

    public function mount($scheme_id)
    {
        $this->scheme_id = $scheme_id;
        $this->districts = District::select(['district_code', 'district_name'])->get();
        $this->ds_phases = DB::table('m_ds_phase')->get();
        $this->document_msg = '';
        $doc_profile_image = DocumentType::where('is_profile_pic', true)->first();
        if ($doc_profile_image) {
            $this->doc_profile_image_id = $doc_profile_image->id;
        }
        $doc_id_list = SchemeDocMap::select('doc_list_man', 'doc_list_opt', 'doc_list_man_group')
            ->where('scheme_code', $scheme_id)
            ->first();

        if ($doc_id_list) {
            $this->doc_list_man = !empty($doc_id_list->doc_list_man)
                ? DocumentType::select('id', 'doc_size_kb', 'doc_name', 'doc_type', 'doucument_group')
                    ->whereIn('id', json_decode($doc_id_list->doc_list_man))
                    ->get()
                    ->toArray()
                : [];

            $this->doc_list_opt = !empty($doc_id_list->doc_list_opt)
                ? DocumentType::select('id', 'doc_size_kb', 'doc_name', 'doc_type', 'doucument_group')
                    ->whereIn('id', json_decode($doc_id_list->doc_list_opt))
                    ->get()
                    ->toArray()
                : [];

            $doc_list_man_group = !empty($doc_id_list->doc_list_man_group)
                ? json_decode($doc_id_list->doc_list_man_group)
                : [];

            if (count($doc_list_man_group) > 0) {
                $this->generateDocumentMsg($doc_list_man_group);
            }
        }
    }

    private function generateDocumentMsg($doc_list_man_group)
    {
        $all_doc_id = array_merge(
            array_column($this->doc_list_man, 'id'),
            array_column($this->doc_list_opt, 'id')
        );

        foreach ($doc_list_man_group as $man_group) {
            $heading_msg = "At least one document must be uploaded for ";
            $doucument_group_name = $this->getGroupName($man_group);
            $heading_msg .= '<span style="color:red;font-weight:bold">' . $doucument_group_name . '</span>';

            $this->document_msg .= "<div class='form-group col-md-12'>";
            $this->document_msg .= "<p style='font-weight:bold;font-size:17px;'>" . $heading_msg . "</p>";
            $this->document_msg .= "<ul>";

            $results = DB::select("
                SELECT doc_name 
                FROM m_attached_doc 
                WHERE id IN (" . implode(',', $all_doc_id) . ") 
                  AND ? = ANY (doucument_group)
            ", [$man_group]);

            foreach ($results as $requiredmsg) {
                $this->document_msg .= "<li style='font-weight:bold;'>" . $requiredmsg->doc_name . "</li>";
            }

            $this->document_msg .= "</ul>";
            $this->document_msg .= "</div>";
        }
    }

    private function getGroupName($groupId)
    {
        $groupArr = Config::get('constants.document_group', []);
        return $groupArr[$groupId] ?? 'NA';
    }


    // Method for submitting the form data
    // Dynamic validation logic and data insertion
    public function save()
    {
        // dd($this->all());
        try {
            // Handle dynamic validation rules based on scheme_id, entry_type, and maratial_status
            if ($this->scheme_id == 1 || $this->scheme_id == 3) {
                $this->rules['caste_certificate_no'] = 'required|regex:/^[0-9A-Za-z\s]+$/|min:3|max:50';
                $this->messages['caste_certificate_no.required'] = 'The Caste Certificate No. is required';
            }
            if ($this->entry_type == 2) {
                $this->rules['ds_registration_no'] = 'required';
                $this->messages['ds_registration_no.required'] = 'The DS Registration No. is required';
                $this->rules['ds_date'] = 'required';
                $this->messages['ds_date.required'] = 'The Date of Service is required';
            }
            if ($this->maratial_status == 'Married') {
                $this->rules['spouse_first_name'] = 'required|regex:/^[A-Za-z\s]+$/|min:3|max:50';
                $this->messages['spouse_first_name.required'] = 'The Spouse First Name is required';
                $this->messages['spouse_first_name.regex'] = 'The Spouse First Name consists of only letters and spaces.';
                $this->rules['spouse_last_name'] = 'required|regex:/^[A-Za-z\s]+$/|min:3|max:50';
                $this->messages['spouse_last_name.required'] = 'The Spouse Last Name is required';
                $this->messages['spouse_last_name.regex'] = 'The Spouse Last Name consists of only letters and spaces.';
            }

            // Validate the form data according to the dynamic rules
            $this->validate();
            $ds_date = $this->ds_date ? $this->ds_date : null;
            $dob = $this->dob ? $this->dob : null;
            $ds_registration_no = $this->ds_registration_no ? $this->ds_registration_no : null;
            $schemeID = $this->scheme_id;
            if ($schemeID == 10 || $schemeID == 17) {
                $caste_cat = 'General';
            }
            if ($schemeID == 3) {
                $caste_cat = 'SC';
            }
            if ($schemeID == 1) {
                $caste_cat = 'ST';
            }

            // Insert the validated data into the database
            DB::table('public.ben_personal_details')->insert([
                'scheme_id' => trim($this->scheme_id),
                'entry_type' => trim($this->entry_type),
                'ds_reg_no' => trim($ds_registration_no), // Use $ds_registration_no here
                'ds_date' => $ds_date,
                'ben_fname' => trim($this->first_name),
                'ben_mname' => trim($this->middle_name),
                'ben_lname' => trim($this->last_name),
                'gender' => trim($this->gender),
                'dob' => $dob,
                'father_fname' => trim($this->father_first_name),
                'father_mname' => trim($this->father_middle_name),
                'father_lname' => trim($this->father_last_name),
                'mother_fname' => trim($this->mother_first_name),
                'mother_mname' => trim($this->mother_middle_name),
                'mother_lname' => trim($this->mother_last_name),
                'caste_cat' => $caste_cat,
                'caste_cat_no' => trim($this->caste_certificate_no),
                'maratial_status' => trim($this->maratial_status),
                'monthly_income' => trim($this->monthly_income),
                'spouse_fname' => trim($this->spouse_first_name),
                'spouse_mname' => trim($this->spouse_middle_name),
                'spouse_lname' => trim($this->spouse_last_name),
            ]);
            $aadhar_no = trim($this->aadhar_no);
            $masked_aadhar_no = str_repeat('*', 6) . substr($aadhar_no, -6);
            $hashed_aadhar_no = hash('sha256', $aadhar_no); // Using SHA-256 for example
            DB::table('public.ben_personal_identification')->insert([
                'scheme_id' => trim($this->scheme_id),
                'ration_no' => trim($this->ration_no),
                'ration_cat' => trim($this->ration_cat),
                'epic_vot_id' => trim($this->epic_vot_id),
                'pan' => trim($this->pan),
                'aadhar_no' => $masked_aadhar_no, // Store masked Aadhar number
            ]);
            DB::table('public.ben_aadhar_details')->insert([
                'encoded_aadhar' => base64_encode($aadhar_no), // Encode Aadhar number
                'aadhar_hash' => $hashed_aadhar_no, // Store hash of the Aadhar number
                
            ]);

            session()->flash('message', 'Form successfully submitted and data inserted into the database!');
            $this->resetFormFields();
            return $this->redirect('/formEntry');

        } catch (Exception $e) {
            // Handle the exception properly and display the error message
            session()->flash('error', $e->getMessage());
        }
    }


    // Reset form fields function
    private function resetFormFields()
    {
        $this->reset(['scheme_id', 'entry_type', 'ds_reg_no', 'ds_date', 'ben_fname', 'ben_mname', 'ben_lname', 'gender', 'dob', 'father_fname', 'father_mname', 'father_lname', '', '']); // Specify the fields to reset
    }
    public function render()
    {
        return view('livewire.generic-form', [
            'scheme_id' => $this->scheme_id,
            'confirm_submit' => $this->confirm_submit,
            'districts' => $this->districts,
            'ds_phases' => $this->ds_phases,
            'document_msg' => $this->document_msg,
            'doc_list_man' => $this->doc_list_man,
            'doc_list_opt' => $this->doc_list_opt,
            'profile_img' => $this->doc_profile_image_id,
        ]);
    }
}
