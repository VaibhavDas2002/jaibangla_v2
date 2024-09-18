<?php

namespace App\Http\Controllers;

use App\District;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Config;
use Illuminate\Support\Facades\DB;
use App\Scheme;
use App\Designation;
use App\UserManual;

use App\GP;
use App\Taluka;
use App\UrbanBody;
use App\PensionLBWCDTemp;
use App\PensionSC;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use File;
use Illuminate\Support\Facades\Storage;
use App\Configduty;
use App\DataSourceCommon;

class UserManualController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function upload(Request $request)
    {
        ini_set('memory_limit', '-1');
        ini_set('pcre.backtrack_limit', "10000000");
        ini_set('max_execution_time', 300);
        $designation_id = Auth::user()->designation_id;

        $code = 0;
        $fill_array = array();
        $old_files = array();
        $fill_array['scheme_id'] = '';
        $fill_array['designation_id'] = '';
        $fill_array['file_name'] = '';
        $issubmitted = 0;
        $valid = 1;
        $msg = '';
        $errors = array();
        $is_active = 0;
        $scheme_arr = Scheme::where('is_active', 1)->get();
        $designation_arr = Designation::get();
        $designation_id = Auth::user()->designation_id;
        if (!in_array($designation_id, array('Admin'))) {
            return redirect("/")->with('error', 'Not Allowed');
        }


        if (isset($request->submit)) {
            if (!empty($request->scheme_id)) {
                $fill_array['scheme_id'] = $request->scheme_id;
            }
            if (!empty($request->designation_id)) {
                $fill_array['designation_id'] = $request->designation_id;
            }
            if (!empty($request->file_name)) {
                $fill_array['file_name'] = $request->file_name;
            }
            $issubmitted = 1;
            $rules = [
                'scheme_id' => 'required|integer',
                'designation_id' => 'required',
                'file_name' => 'required',
                'uploaded_file' => 'required|mimetypes:application/pdf'
            ];
            $attributes = array();
            $messages = array();
            $attributes['scheme_id'] = 'Scheme';
            $attributes['designation_id'] = 'Designation';
            $attributes['file_name'] = 'Manual Name';
            $attributes['uploaded_file'] = 'Upload File';
            $validator = Validator::make($request->all(), $rules, $messages, $attributes);
            if ($validator->passes()) {
                $destinationPath = storage_path('app/userManual/');
                if ($request->hasFile('uploaded_file')) {
                    $doc_file = $request->file('uploaded_file');
                    $file_profile = "user_manual_" . rand(10000, 99999) . '_' . time() . '.' . $doc_file->getClientOriginalExtension();
                    if ($doc_file->move($destinationPath, $file_profile)) {
                        $count_data = UserManual::where('scheme_id', $request->scheme_id)->where('designation_id', $request->designation_id)->count();
                        try {
                            if ($count_data > 0) {
                                $input = [
                                    'is_active' => 0
                                ];
                                $is_update1 =  UserManual::where('scheme_id', $request->scheme_id)->where('designation_id', $request->designation_id)->where("is_active", 1)->update($input);
                            }
                            $manual = new UserManual();
                            $manual->scheme_id = $request->scheme_id;
                            $manual->designation_id = $request->designation_id;
                            $manual->file_name = trim($request->file_name);
                            $manual->uploaded_file = $file_profile;
                            $manual->is_active = 1;
                            $is_saved2 = $manual->save();
                            $valid = 1;
                            $msg = 'User Manual has been uploaded Successfully';
                        } catch (\Exception $e) {
                            $valid = 0;
                            $msg = 'Error.. Please try later.';
                        }
                    } else {
                        $valid = 0;
                        $msg = 'Error.. Please try later.';
                    }
                }
            } else {
                $valid = 0;
                $errors = $validator->errors()->all();
            }
        }
        // dd($is_urban);
        return view(
            'UserManual.upload',
            [
                'valid' => $valid,
                'msg' => $msg,
                'scheme_arr' => $scheme_arr,
                'fill_array' => $fill_array,
                'designation_arr' => $designation_arr,
                'errors' => $errors,
                'issubmitted' => $issubmitted
            ]
        );
    }
    function get(Request $request)
    {
        $designation_id = Auth::user()->designation_id;
        $data = UserManual::where('designation_id', $designation_id)->where('is_active', 1)->get();
        $result = array();
        $scheme_in = array();
        $arrayData = array();
        $i = 0;
        foreach ($data  as $row) {
            $scheme_arr = Scheme::where('id',  $row->scheme_id)->where('is_active',  1)->first();
            if ($scheme_arr->is_active == 1) {
                if (!in_array($scheme_arr->id, $scheme_in)) {
                    $result[$i]['scheme_name'] = $scheme_arr->scheme_name;
                    $arrayData = array();
                    array_push($scheme_in, $scheme_arr->id);
                    array_push($arrayData, $row->toArray());
                    $result[$i]['manualData'] = $arrayData;
                    $i++;
                } else {
                    // $arrayDataRow = array();
                    array_push($arrayData, $row->toArray());
                    $result[$i]['manualData'] = $arrayData;
                }
            } else
                continue;
        }
        //dd($result);
        return view(
            'UserManual.list',
            [
                'data' => $result
            ]
        );
    }
    public function downloadstaticpdf(Request $request)
    {
        $designation_id = Auth::user()->designation_id;
        if (!in_array($designation_id, array('Admin', 'Operator', 'Approver', 'Verifier','Corp'))) {
            return redirect("/")->with('error', 'Not Allowed');
        }
        $file_name = $request->file_name;
        if (empty($file_name)) {
            return redirect("/get-user-manual")->with('error', 'File Name not Passed');
        }
        $file_name1 = 'userManual/' . $file_name;
        $exists = Storage::disk('local')->has($file_name1);
        if ($exists) {
            return response()->download(storage_path('app/userManual//' . $file_name));
        } else {
            return redirect("/get-user-manual")->with('error', 'File not Found');
        }
    }
}
