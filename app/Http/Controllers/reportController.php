<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth; // Import Auth facade
use Illuminate\Support\Facades\DB;   // Import DB facade
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Validator;

use App\Models\Scheme;
use App\Models\User;
use App\Models\Report;
use App\Models\Configduty;
use App\Models\GP;
use App\Models\Taluka;
use App\Models\UrbanBody;
use App\Models\SubDistrict;
use App\Models\Ward;
use App\Models\DsPhase;
use App\Models\District;
use App\Models\BenPersonalDetail;
use App\Models\BenBankDetail;
use App\Models\BenContactDetail;

class reportController extends Controller
{
    public function SelectReport(Request $request)
    {
        $designation_id = Auth::user()->designation_id;
        if ($designation_id != 'Operator') {
            return redirect('/')->with('error', 'Not Allowed');
        }

        return view('report.reportList');
    }

    public function generateReport(Request $request){
        // dd($request);
        $request->validate([
            'schemeId' => 'required|exists:m_scheme,id',
            'reportId' => 'required|exists:m_report,id',
        ]);

        // Fetch the selected scheme and report
        $schemeDetails = Scheme::find($request->input('schemeId'));
        $reportDetails = Report::find($request->input('reportId'));
        $fields = ['username', 'email', 'mobile_no'];
        // Fetch users based on scheme and report type (e.g., verified status)
        $query = User::where('is_active', '1');
        // where('scheme_name', $scheme) // aita add korata hba,,
        $users = $query->select($fields)->get();

        // Redirect to the report view with the data
        return view('report.show', [
            'scheme' => $schemeDetails,
            'report' => $reportDetails,
            'users' => $users,
            'fields' => $fields,
        ]);
    }


    public function applicantReport(){

        // $phases = DsPhase::get();
        // $districtList = collect([]);
        // $muncList = collect([]);
        // $gpwardList = collect([]);
        // // else part of role_name
        //     $district_visible = 1;
        //     $is_urban = NULL;
        //     $districtList = District::get();
        //     // -- No request data comes here. --
        //     // $district_code = $request->district_code;
        //     // $urban_body_code = $request->urban_body_code;
        //     // $block_ulb_code = $request->block_ulb_code;
        //     $is_rural_visible = 1;
        //     $munc_visible = 1;
        //     $gp_ward_visible = 1;
        //     $urban_visible = 1;
        // // else part ends

        // // for beneficiary report list
        // // $beneficiaries = BenPersonalDetail::join('ben_bank_details', 'ben_personal_details.id', '=', 'ben_bank_details.ben_id')
        // //     ->join('ben_contact_details', 'ben_personal_details.id', '=', 'ben_contact_details.ben_id')
        // //     ->select(
        // //         'ben_personal_details.ben_fname',
        // //         'ben_personal_details.ben_mname',
        // //         'ben_personal_details.ben_lname',
        // //         'ben_personal_details.mobile_no',
        // //         'ben_bank_details.bank_ifsc',
        // //         'ben_bank_details.bank_code',
        // //         'ben_contact_details.block_ulb_name',
        // //         'ben_contact_details.gp_ward_name',
        // //         'ben_contact_details.village_town',
        // //         'ben_contact_details.house_premise_no'
        // //     )
        // //     ->get();
        // // ends of b-r-l

        return view('report.applicantReport' );
    }



}
