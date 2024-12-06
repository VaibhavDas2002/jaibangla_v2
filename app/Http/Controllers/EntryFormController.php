<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\JBValidation;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use Illuminate\Support\Facades\DB;   // Import DB facade
use App\Models\Scheme;
use App\Models\District;
use App\Models\Configduty;
use App\Models\BlkUrbanlEntryMapping;
use App\DTO\JBPersonalDetailsDTO;
use App\DTO\JBPersonalIdDTO;
use App\DTO\JBContactDTO;
use App\DTO\JBBankDetailsDTO;
use App\DTO\JBLandDetailsDTO;

use App\Http\Requests\JBFormRequest;
use App\Http\Requests\PurohitMonthlyRequest;
use App\Interface\PersonalDtlRepositoryInterface;
use App\Repositories\PersonalDtlRepository;
use App\Repositories\PersonalIdRepository;
use App\Repositories\BankDtlRepository;
use App\Repositories\ContactDtlRepository;
use App\Repositories\LandDtlRepository;
use App\Repositories\AdditionalDtlRepository;
use App\Repositories\SelfDeclRepository;

class EntryFormController extends Controller
{
  public function __construct()
  {

  }

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
      'scheme-selection/schemeList',
      [
        'schemes' => $schemes,
      ]
    );
  }

  public function FormEntry(Request $request)
  {
    $districts = District::select(['district_code', 'district_name'])->get();

    // dd($request->schemeId);
    return view(
      'Forms.GenericForm',
      [
        'scheme_id' => $request->schemeId,
        'districts' => $districts,
      ]
    );
  }

  /**
   * Store form data based on the scheme_id and dump the response for debugging.
   *
   * @param  \App\Http\Requests\JBFormRequest  $request
   * @param  int  $scheme_id
   * @return void
   */

   public function store(Request $request, $scheme_id)
   {
       try {
           $response = JBValidation::Validator($scheme_id, $request);
           if ($response) {
               $data = $request->all();
               $benid = PersonalDtlRepository::savePersonalDtl($data);
   
               if ($benid) {
                   // Save Personal ID details
                   $responseId = PersonalIdRepository::savePersonalId($data, $benid);
               }
   
               if ($responseId) {
                   // Save Contact details
                   $responseC = ContactDtlRepository::saveConatctDtl($data, $benid);
               }
   
               if ($responseC) {
                   // Save Bank details
                   $responseBnk = BankDtlRepository::saveBankDtl($data, $benid);
               }
   
               if ($scheme_id == 17 && $responseBnk) {
                   // Save Land details for scheme 17
                   $responseLand = LandDtlRepository::saveLandlDtl($data, $benid);
               }
   
               if ($scheme_id == 17 && $responseBnk) {
                   // Save Additional details for scheme 17
                   $responseAdd = AdditionalDtlRepository::saveAdditionalDtl($data, $benid);
               }
   
               // Save Self Declaration if Additional or Bank details are saved
               if ($responseAdd || $responseBnk) {
                   $responseSelf = SelfDeclRepository::saveSelfDec($data, $benid);
               }
   
               // Redirect upon success with schemeId and message
               
                   return redirect()->route('formEntry', ['schemeId' => $scheme_id])
                       ->with('message', 'Form successfully submitted and data inserted into the database!');
           }
       } catch (\Exception $e) {
           // Error handling
           return redirect()->route('formEntry', ['schemeId' => $scheme_id])
               ->with('error', $e->getMessage());
       }
   }
   
   

}
