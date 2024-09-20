<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; // Import Auth facade
use Illuminate\Support\Facades\DB;   // Import DB facade
use App\Models\Scheme;

class reportController extends Controller
{
    public function SelectReport(Request $request)
    {
      $designation_id = Auth::user()->designation_id;
      $user_id = Auth::user()->id;
      if ($designation_id != 'Operator') {
        return redirect('/')->with('error', 'Not Allowded');
      }

      $return_arr = array();
      $schemes_arr_all = Scheme::where('is_active', 1)->orderBy('rank')->get();
      $user_id = (int) $user_id; // Ensure user_id is an integer to prevent SQL injection
      $schemes = DB::table('m_scheme')
        ->select('id', 'scheme_name', 'display_name')
        ->whereIn('id', function ($query) use ($user_id) {
          $query->select('scheme_id')
            ->from('duty_assignement')
            ->where('is_active', 1)
            ->where('user_id', $user_id);
        })
        ->orderBy('rank')
        ->get();

        $reports = DB::table('m_report')
        ->where('is_active', true)
        ->get();

    //   dd($schemes, $reports);
      return view(
        'report/reportList',
        [
          'schemes' => $schemes,
          'reports' => $reports,
        ]
      );
    }

    public function report_search(Request $request){
        dd($request);
    }
}
