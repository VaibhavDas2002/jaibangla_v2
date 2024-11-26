<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use Illuminate\Support\Facades\DB;   // Import DB facade
use App\Models\Scheme;
class workflowController extends Controller
{
    public function SelectScheme(Request $request)
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
      // dd($schemes);
      return view(
        'workflow/workflowList',
        [
          'schemes' => $schemes,
        ]
      );
    }

    public function workflowFrom(Request $request)
    {
        $designations = DB::table('designation')->get();
        $steps = DB::table('step_name')->get();
      //dd($request->schemeId);
      return view(
        'Forms.workflowFrom',
        [
          'scheme_id' => $request->schemeId,
          'designations' => $designations,
            'steps' => $steps
        ]
      );
    }
}
