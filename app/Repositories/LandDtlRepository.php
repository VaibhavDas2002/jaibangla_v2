<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Interface\LandDtlRepositoryInterface;

class LandDtlRepository implements LandDtlRepositoryInterface
{
    public static function saveLandlDtl(array $data, $benId)
    {
        // dd($data);
        try {

            // Initialize variables from the array 
            $ds_registration_no = $data['ds_registration_no'] ?? null;
            $schemeID = $data['scheme_id'];
    
            // Insert into ben_personal_details table and get the auto-increment ID
            $response = DB::table('public.ben_land_details')->insertGetId([
                'ben_id' => $benId,
                'scheme_id' => trim($schemeID),
                'mouza_name' => $data['mouza_name'],
                'land_jlno' => $data['land_jlno'],
                'khatian_no'=>$data['khatian_no'],
                'plot_no'=>$data['plot_no'],
                'land_area'=>$data['land_area'],
                'name_of'=>$data['land_holdername']        
            ]);

            return $response;
        } catch (Exception $error) {
            dd($error);
        }
    }
}
