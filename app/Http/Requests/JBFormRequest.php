<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JBFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'scheme_id' => 'required|integer',
            'entry_type' => 'required|in:1,2',
            'first_name' => 'required||max:200',
            'middle_name' => 'nullable|',
            'last_name' => 'required||max:200',
            'gender' => 'required',
            'dob' => 'required',
            'father_first_name' => 'required||max:200',
            'father_middle_name' => 'nullable|',
            'father_last_name' => 'required||max:200',
            'mother_first_name' => '|nullable|max:200',
            'mother_middle_name' => '|nullable',
            'mother_last_name' => '|nullable|max:200',
            'monthly_income' => 'nullable|numeric',
            'maratial_status' => 'required',
            'spouse_first_name' => '|nullable',
            'spouse_middle_name' => '|nullable',
            'spouse_last_name' => '|nullable',
            'residency_period' => 'nullable|numeric',
            'mobile' => 'required',
            'email' => 'nullable|email',

            'ration_no' => '|nullable|max:11',
            'ration_cat' => '|nullable',
            'epic_vot_id' => 'tring|nullable|max:20',
            'aadhar_no' => 'required|numeric|digits:12',
            'pan_no' => '|nullable|max:12',

            'state' => 'required|',
            'district' => 'required|',
            'asmb_cons' => 'required|',
            'urban_code' => 'required|',
            'block_urbanBody' => 'required|',
            'gp_ward' => 'required|',
            'village' => 'required|',
            'post_office' => 'required|',
            'pin_code' => 'required|',
            'police_station' => 'required|',
            'state_cur' => 'required|',
            'district_cur' => 'required|',
            'asmb_cons_cur' => 'required|',
            'urban_code_cur' => 'required|',
            'block_cur' => 'required|',
            'gp_ward_cur' => 'required|',
            'village_cur' => 'required|',
            'post_office_cur' => 'required|',
            'pin_code_cur' => 'required|',
            'police_station_cur' => 'required|',


            'name_of_bank' => 'required||max:200',
            'bank_branch' => 'required||max:200',
            'bank_account_number' => 'required|numeric',
            'bank_ifsc_code' => 'required|',


        ];
    }

    public function messages()
    {
        return [
            'scheme_id.required' => 'Scheme  ID is required',
            'entry_type.required' => 'Entry Type is required',
            'first_name.required' => 'First Name is required',
            'last_name.required' => 'Last Name is required',
            'gender.required' => 'Gender is required',
            'dob.required' => 'Date of Birth is required',
            'father_first_name.required' => 'Father First Name is required',
            'father_last_name.required' => 'Father Last Name is required',
            'mother_first_name.required' => 'Mother First Name is required',
            'mother_last_name.required' => 'Mother Last Name is required',
            'monthly_income.required' => 'Monthly Income is required',
            'maratial_status.required' => 'Marital Status is required',
            'mobile.required' => 'Mobile is required',
            'email.required' => 'Email is required',

            'ration_no.required' => 'Ration Card No is required',
            'ration_cat.required' => 'Ration Card Category is required',
            'epic_vot_id.required' => 'Epic Vot ID is required',
            'aadhar_no.required' => 'Aadhar No is required',
            'pan_no.required' => 'PAN No is required',

            'state.required' => 'State is required',
            'district.required' => 'District is required',
            'asmb_cons.required' => 'Assembly Constituency is required',
            'urban_code.required' => 'Urban Code is required',
            'block_urbanBody.required' => 'Block Urban Body is required',
            'gp_ward.required' => 'Gram Panchayat Ward is required',
            'village.required' => 'Village is required',
            'post_office.required' => 'Post Office is required',
            'pin_code.required' => 'Pin Code is required',
            'police_station.required' => 'Police Station is required',
            'state_cur.required' => 'Current State is required',
            'district_cur.required' => 'Current District is required',
            'asmb_cons_cur.required' => 'Current Assembly Constituency is required',
            'urban_code_cur.required' => 'Current Urban Code is required',
            'block_cur.required' => 'Current Block Urban Body is required',
            'gp_ward_cur.required' => 'Current Gram Panchayat Ward is required',
            'village_cur.required' => 'Current Village is required',
            'post_office_cur.required' => 'Current Post Office is required',
            'pin_code_cur.required' => 'Current Pin Code is required',
            'police_station_cur.required' => 'Current Police Station is required',
            
            'name_of_bank.required' => 'Name of Bank is required',
            'bank_branch.required' => 'Bank Branch is required',
            'bank_account_number.required' => 'Bank Account Number is required',
            'bank_ifsc_code.required' => 'Bank IFSC Code is required',

        ];


    }
}
