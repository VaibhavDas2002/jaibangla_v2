<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Interface\ContactDtlRepositoryInterface;

class ContactDtlRepository implements ContactDtlRepositoryInterface
{
    public static function saveConatctDtl(array $data, $benId): bool
    {
        // dd($data);
        try {

            $schemeID = $data['scheme_id'];

            if ($schemeID == 17) {
                $response = DB::table('public.ben_contact_details_cur')->insert([
                    'ben_id' => $benId,
                    'scheme_id' => trim($schemeID),
                    'state' => $data['state'],
                    'dist_code' => $data['district'],
                    'assembly_code' => $data['asmb_cons'],
                    'rural_urban_id' => $data['urban_code'],
                    'block_ulb_code' => $data['block_urbanBody'],
                    'gp_ward_code' => $data['gp_ward'],
                    'house_premise_no' => $data['house'],
                    'post_office' => $data['post_office'],
                    'pincode' => $data['pin_code'],
                    'village_town' => $data['village'],
                    'police_station' => $data['police_station'],
                    'state_cur' => $data['state_cur'],
                    'dist_code_cur' => $data['district'],
                    'assembly_code_cur' => $data['asmb_cons_cur'],
                    'rural_urban_id_cur' => $data['urban_code_cur'],
                    'block_ulb_code_cur' => $data['block_cur'],
                    'gp_ward_code_cur' => $data['gp_ward_cur'],
                    'house_premise_no_cur' => $data['house_cur'],
                    'post_office_cur' => $data['post_office_cur'],
                    'pincode_cur' => $data['pin_code_cur'],
                    'village_town_cur' => $data['village_cur'],
                    'police_station_cur' => $data['police_station_cur'],
                ]);
            } else {
                $response = DB::table('public.ben_contact_details')->insert([
                    'ben_id' => $benId,
                    'scheme_id' => trim($schemeID),
                    'state' => $data['state'],
                    'dist_code' => $data['district'],
                    'assembly_code' => $data['asmb_cons'],
                    'rural_urban_id' => $data['urban_code'],
                    'block_ulb_code' => $data['block_urbanBody'],
                    'gp_ward_code' => $data['gp_ward'],
                    'house_premise_no' => $data['house'],
                    'post_office' => $data['post_office'],
                    'pincode' => $data['pin_code'],
                    'village_town' => $data['village'],
                    'police_station' => $data['police_station'],
                ]);
            }

            return $response;
        } catch (Exception $error) {
            dd($error);
        }
    }
}
