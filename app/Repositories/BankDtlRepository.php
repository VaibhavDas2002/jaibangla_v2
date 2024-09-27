<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Interface\BankDtlRepositoryInterface;

class BankDtlRepository implements BankDtlRepositoryInterface
{
    public static function saveBankDtl(array $data, $benId)
    {
        // dd($data);
        try {


            $schemeID = $data['scheme_id'];
        
            // Insert into ben_personal_details table and get the auto-increment ID
            $response = DB::table('public.ben_bank_details')->insertGetId([
                'ben_id' => $benId,
                'bank_ifsc' => trim($data['bank_ifsc_code']),
                'bank_name' => trim($data['name_of_bank']),
                'branch_name' => trim($data['bank_branch']),
                'bank_code' => trim($data['bank_account_number']),
                'scheme_id' => trim($schemeID),
            ]);

            return $response;
        } catch (Exception $error) {
            dd($error);
        }
    }
}
