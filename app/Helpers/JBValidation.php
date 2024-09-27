<?php

namespace App\Helpers;

use Illuminate\Validation\ValidationException;
use App\Http\Requests\JaiJoharRequest;
use App\Http\Requests\FarmerOldAgeRequest;
use App\Http\Requests\LegacyOldAgeSTRequest;
use App\Http\Requests\ManabikWCDRequest;
use App\Http\Requests\MSMSERequest;
use App\Http\Requests\OldAgeWCDRequest;
use App\Http\Requests\OldAgeFishermanRequest;
use App\Http\Requests\PrachestaRequest;
use App\Http\Requests\PurohitMonthlyRequest;
use App\Http\Requests\TaposiliBandhuSCRequest;
use App\Http\Requests\TextileRequest;
use App\Http\Requests\WidowWCDRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JBValidation
{
    public static function Validator($scheme_id, Request $request)
    {
        switch ($scheme_id) {
            case 1:
                return self::JaiJoharValidation(new JaiJoharRequest($request->all()));
            case 2:
                return self::ManabikValidation(new ManabikWCDRequest($request->all()));
            case 3:
                return self::TaposiliValidation(new TaposiliBandhuSCRequest($request->all()));
            case 4:
                return self::PrachestaValidation(new PrachestaRequest($request->all()));
            case 5:
                return self::OldAgeFishermanValidation(new OldAgeFishermanRequest($request->all()));
            case 6:
                return self::MSMEValidation(new MSMSERequest($request->all()));
            case 7:
                return self::TextileValidation(new TextileRequest($request->all()));
            case 10:
                return self::OldAgeWCDValidation(new OldAgeWCDRequest($request->all()));
            case 11:
                return self::WidowWCDValidation(new WidowWCDRequest($request->all()));
            case 13:
                return self::FarmerOldAgeValidation(new FarmerOldAgeRequest($request->all()));
            case 17:
                return self::PurohitMonthlyValidation(new PurohitMonthlyRequest($request->all()));
            case 19:
                return self::LegacyOldAgeSTValidation(new LegacyOldAgeSTRequest($request->all()));
            default:
                return response()->json(['error' => 'Invalid scheme_id'], 400);
        }
    }

    protected static function JaiJoharValidation(JaiJoharRequest $request)
    {
        try {

            return true;
        } catch (ValidationException $e) {

            return $e;
        }
    }

    protected static function ManabikValidation(ManabikWCDRequest $request)
    {
        try {

            return true;
        } catch (ValidationException $e) {

            return $e;
        }
    }

    protected static function TaposiliValidation(TaposiliBandhuSCRequest $request)
    {
        try {

            return true;
        } catch (ValidationException $e) {

            return $e;
        }
    }

    protected static function PrachestaValidation(PrachestaRequest $request)
    {
        try {

            return true;
        } catch (ValidationException $e) {

            return $e;
        }
    }

    protected static function OldAgeFishermanValidation(OldAgeFishermanRequest $request)
    {
        try {

            return true;
        } catch (ValidationException $e) {

            return $e;
        }
    }

    protected static function MSMEValidation(MSMSERequest $request)
    {
        try {

            return true;
        } catch (ValidationException $e) {

            return $e;
        }
    }

    protected static function TextileValidation(TextileRequest $request)
    {
        try {

            return true;
        } catch (ValidationException $e) {

            return $e;
        }
    }

    protected static function OldAgeWCDValidation(OldAgeWCDRequest $request)
    {
        try {

            return true;
        } catch (ValidationException $e) {

            return $e;
        }
    }

    protected static function WidowWCDValidation(WidowWCDRequest $request)
    {
        try {

            return true;
        } catch (ValidationException $e) {

            return $e;
        }
    }

    protected static function FarmerOldAgeValidation(FarmerOldAgeRequest $request)
    {
        try {

            return true;
        } catch (ValidationException $e) {

            return $e;
        }
    }

    protected static function PurohitMonthlyValidation(PurohitMonthlyRequest $request)
    {
        try {

            return true;
        } catch (ValidationException $e) {

            return $e;
        }

    }


    protected static function LegacyOldAgeSTValidation(LegacyOldAgeSTRequest $request)
    {
        try {

            return true;
        } catch (ValidationException $e) {

            return $e;
        }
    }
}
