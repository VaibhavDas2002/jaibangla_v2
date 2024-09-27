<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class AdditionalDtlRepository
{
    public static function saveAdditionalDtl(array $data, $benId)
    {
        // dd($data);
        try {
            $schemeID = $data['scheme_id'];
            // Insert into ben_personal_details table and get the auto-increment ID
            $response = DB::table('public.ben_additional_details')->insertGetId([
                'ben_id' => $benId,
                'app_phase' => $data['app_phase'],
                'temple_type' => $data['temple_type'],
                'scheme_id' => trim($schemeID),
            ]);

            return $response;
        } catch (Exception $error) {
            dd($error);
        }
    }
}
