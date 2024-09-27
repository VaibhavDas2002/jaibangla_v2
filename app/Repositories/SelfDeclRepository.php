<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Interface\SelfDeclRepositoryInterface;
class SelfDeclRepository implements SelfDeclRepositoryInterface
{
    public static function saveSelfDec(array $data, $benId)
    {
        // dd($data);
        $schemeID = $data['scheme_id']; // Make sure this is included in the passed data array
        
        try {
            $response = DB::table('public.ben_decl_details')->insert([
                'ben_id' => $benId,
                'is_ben' => $data['ssp_y_n'],
                'scheme_id' => trim($schemeID),
                'is_house' => $data['pucca_house_y_n'],
                'nom_name' => $data['nominate_name'],
                'nom_add' => $data['nominate_address'],
                'nom_rel' => $data['nominate_relationship'],
                'is_aadh_const' => $data['av_status'], // Convert array to JSON
                'recv_pen' => json_encode($data['receive_pension']),
                'app_pen_1' => $data['receiving_pension_other_source_1'],
                'app_pen_2' => $data['receiving_pension_other_source_2'],
            ]);
        
            return $response;
        } catch (Exception $error) {
            dd($error);
        }
    }        
}
