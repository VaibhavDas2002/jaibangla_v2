<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Interface\PersonalDtlRepositoryInterface;
class PersonalDtlRepository implements PersonalDtlRepositoryInterface
{
    public static function savePersonalDtl(array $data): int
    {
        // dd($data);
        try {

            // Initialize variables from the array 
            $ds_registration_no = $data['ds_registration_no'] ?? null;
            $schemeID = $data['scheme_id'];

            if ($schemeID == 1 || $schemeID == 3) {
                $benId = DB::table('public.ben_personal_details')->insertGetId([
                    'scheme_id' => trim($schemeID),
                    'entry_type' => $data['entry_type'],
                    'ds_reg_no' => trim($ds_registration_no),
                    'ds_date' => $data['ds_date'],
                    'ds_phase' => $data['ds_phase'],
                    'ben_fname' => trim($data['first_name']),
                    'ben_mname' => trim($data['middle_name']) ?? null,
                    'ben_lname' => trim($data['last_name']),
                    'gender' => trim($data['gender']),
                    'dob' => $data['dob'] ?? null,
                    'father_fname' => trim($data['father_first_name']),
                    'father_mname' => trim($data['father_middle_name']) ?? null,
                    'father_lname' => trim($data['father_last_name']),
                    'mother_fname' => trim($data['mother_first_name']),
                    'mother_mname' => trim($data['mother_middle_name']) ?? null,
                    'mother_lname' => trim($data['mother_last_name']),
                    'caste_cat' => trim($data['caste_category']),
                    'caste_cat_no' => trim($data['caste_certificate_no']) ?? null,
                    'maratial_status' => trim($data['marital_status']),
                    'monthly_income' => trim($data['monthly_income']),
                    'spouse_fname' => trim($data['spouse_first_name']) ?? null,
                    'spouse_mname' => trim($data['spouse_middle_name']) ?? null,
                    'spouse_lname' => trim($data['spouse_last_name']) ?? null,
                    'email' => trim($data['email']),
                    'mobile_no' => trim($data['mobile_no']),
                    'residency_period' => $data['residency_period']
                ]);
            }
            if ($schemeID == 17) {
                $benId = DB::table('public.ben_personal_details')->insertGetId([
                    'scheme_id' => trim($schemeID),
                    'entry_type' => $data['entry_type'],
                    'ds_reg_no' => trim($ds_registration_no),
                    'ds_date' => $data['ds_date'],
                    'ds_phase' => $data['ds_phase'],
                    'ben_fname' => trim($data['first_name']),
                    'ben_mname' => trim($data['middle_name']) ?? null,
                    'ben_lname' => trim($data['last_name']),
                    'gender' => trim($data['gender']),
                    'dob' => $data['dob'] ?? null,
                    'father_fname' => trim($data['father_first_name']),
                    'father_mname' => trim($data['father_middle_name']) ?? null,
                    'father_lname' => trim($data['father_last_name']),
                    'mother_fname' => trim($data['mother_first_name']),
                    'mother_mname' => trim($data['mother_middle_name']) ?? null,
                    'mother_lname' => trim($data['mother_last_name']),
                    'caste_cat' => trim($data['caste_category']),
                    'maratial_status' => trim($data['marital_status']),
                    'monthly_income' => trim($data['monthly_income']),
                    'spouse_fname' => trim($data['spouse_first_name']) ?? null,
                    'spouse_mname' => trim($data['spouse_middle_name']) ?? null,
                    'spouse_lname' => trim($data['spouse_last_name']) ?? null,
                    'email' => trim($data['email']),
                    'mobile_no' => trim($data['mobile_no']),
                    'residency_period' => $data['residency_period']
                ]);
            }
            return $benId;
        } catch (Exception $error) {
            dd($error);
        }
    }
}
