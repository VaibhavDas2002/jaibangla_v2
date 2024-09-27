<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class PersonalIdRepository
{
    public static function savePersonalId(array $data, int $benId): int
    {
        try {
            // Process Aadhar details from the data array
            $aadhar_no = trim($data['aadhar_no']);
            $masked_aadhar_no = str_repeat('*', 6) . substr($aadhar_no, -6);
            $hashed_aadhar_no = hash('sha256', $aadhar_no);
            $schemeID = $data['scheme_id']; // Make sure this is included in the passed data array
            
            // Insert into ben_personal_id table with benId
            DB::table('public.ben_personal_id')->insert([
                'ben_id' => $benId, 
                'scheme_id' => trim($schemeID),
                'ration_no' => trim($data['ration_card_no']),
                'ration_cat' => trim($data['ration_card_cat']),
                'epic_vot_id' => trim($data['epic_voter_id']),
                'pan' => trim($data['pan_no']),
                'aadhar_no' => $masked_aadhar_no,
            ]);
    
            // Insert into ben_aadhar_details table with benId
            DB::table('public.ben_aadhar_details')->insert([
                'ben_id' => $benId, 
                'encoded_aadhar' => base64_encode($aadhar_no),
                'aadhar_hash' => $hashed_aadhar_no,
            ]);

            return $benId;
        } catch (Exception $error) {
            dd($error);
        }
    }
}

