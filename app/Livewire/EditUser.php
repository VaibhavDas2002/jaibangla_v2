<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Designation;
use App\Models\UserLevel;
use App\Models\Scheme;
use App\Models\DutyAssignement;
use App\Models\District;
use App\Models\Block;
use App\Models\SubDistrict;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class EditUser extends Component
{
    public $userId;
    public $fullname;
    public $username;
    public $email;
    public $mobile;
    public $role_id;
    public $user_level_id;
    public $district_id;
    public $block_id;
    public $subdivision_id;
    public $schemelist = []; // Array to store selected schemes
    public $roles = [];
    public $userLevels = [];
    public $schemes = []; // Array to store available schemes
    public $districts = [];
    public $blocks = [];
    public $subdivisions = [];

    public function mount($userId)
    {
        $this->userId = $userId;
        $this->loadUserData();

        // Fetch roles, user levels, schemes, and districts initially
        $this->roles = Designation::all();
        $this->userLevels = UserLevel::where('is_active', 1)->get();
        $this->schemes = Scheme::all();
        $this->districts = District::all();

        // Load blocks and subdivisions based on selected district, if any
        if ($this->district_id) {
            $this->loadBlocksAndSubdivisions($this->district_id);
        } else {
            $this->blocks = [];
            $this->subdivisions = [];
        }
    }

    public function updatedDistrictId($district_id)
    {
        // Reset block and subdivision when district changes
        $this->block_id = null;
        $this->subdivision_id = null;

        // Clear blocks and subdivisions if no district is selected
        if (!$district_id) {
            $this->blocks = [];
            $this->subdivisions = [];
            return;
        }

        // Load blocks and subdivisions based on the selected district
        $this->loadBlocksAndSubdivisions($district_id);
    }

    protected function loadBlocksAndSubdivisions($district_id)
    {
        $this->blocks = Block::where('district_code', $district_id)->get();
        $this->subdivisions = SubDistrict::where('district_code', $district_id)->get();
    }

    public function loadUserData()
    {
        // Fetch the user along with their associated data
        $user = DB::table('users')
            ->leftJoin('designation', 'users.role_id', '=', 'designation.id')
            ->leftJoin('duty_assignement', 'users.id', '=', 'duty_assignement.user_id')
            ->leftJoin('m_user_level', 'users.user_level_id', '=', 'm_user_level.id')
            ->leftJoin('m_district', 'duty_assignement.district_code', '=', 'm_district.district_code')
            ->leftJoin('m_block', 'duty_assignement.blk_subdiv_code', '=', 'm_block.block_code')
            ->leftJoin('m_sub_district', 'duty_assignement.blk_subdiv_code', '=', 'm_sub_district.sub_district_code')
            ->leftJoin('m_scheme', 'duty_assignement.scheme_id', '=', 'm_scheme.id')
            ->select(
                'users.id',
                'users.full_name',
                'users.username',
                'users.mobile_no',
                'users.email',
                'users.role_id',
                'users.user_level_id',
                'm_user_level.stake_code',
                'designation.name as role_name',
                'm_district.district_name',
                'm_district.district_code',
                'm_block.block_name',
                'm_block.block_code',
                'm_sub_district.sub_district_name',
                'm_sub_district.sub_district_code',
                DB::raw('string_agg(m_scheme.scheme_name, \', \') as scheme_names')
            )
            ->where('users.id', $this->userId) // Fetch user based on userId
            ->where(function ($query) {
                $query->where('users.is_deleted', false)
                    ->orWhereNull('users.is_deleted'); // Include only active users
            })
            ->groupBy(
                'users.id',
                'users.full_name',
                'users.username',
                'users.mobile_no',
                'users.email',
                'users.role_id',
                'users.user_level_id',
                'm_user_level.stake_code',
                'designation.name',
                'm_district.district_name',
                'm_district.district_code',
                'm_block.block_code',
                'm_block.block_name',
                'm_sub_district.sub_district_name',
                'm_sub_district.sub_district_code'
            )
            ->first(); // Get the first result
        //dd($user);
        if ($user) {
            // Load user data into properties
            $this->fullname = $user->full_name ?? null; // Adjust if full_name is not in the query
            $this->username = $user->username;
            $this->email = $user->email;
            $this->mobile = $user->mobile_no;
            //$this->role_id = $user->role_id; // Make sure to fetch role_id if needed
            $this->user_level_id = $user->user_level_id ?? null; // Adjust if user_level_id is not in the query
            $this->role_id = $user->role_id ?? null;
            // Load user duty assignments
            $this->loadUserDutyAssignments($user->id);

            // Fetch associated districts, blocks, and subdivisions if necessary
            $this->district_id = $user->district_code ?? null; // If you have the district code, map to the district ID
            $this->block_id = $user->block_code ?? null; // Similarly for block
            $this->subdivision_id = $user->sub_district_code ?? null; // Assuming you have the subdivision logic as needed
        }
    }

    public function loadUserDutyAssignments($userId)
    {
        $assignments = DutyAssignement::where('user_id', $userId)->get();
        $this->schemelist = $assignments->pluck('scheme_id')->toArray();
    }


    public function submit()
    {
        // Define the validation rules
        $rules = [
            'fullname' => 'required|max:60',
            'username' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->userId, // Unique validation excluding current user
            'mobile' => 'required|digits:10|unique:users,mobile_no,' . $this->userId, // Unique validation excluding current user
            'role_id' => 'required',
            'user_level_id' => 'required',
            'schemelist' => 'required|array|min:1',
        ];

        // Define custom validation messages
        $messages = [
            'email.unique' => 'This email address is already registered.',
            'mobile.unique' => 'This mobile number is already registered.',
        ];

        // Manually validate the data
        $validator = Validator::make([
        'fullname' => $this->fullname,
        'username' => $this->username,
        'email' => $this->email,
        'mobile' => $this->mobile,
        'role_id' => $this->role_id,
        'user_level_id' => $this->user_level_id,
        'schemelist' => $this->schemelist,
    ], $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {
            // Redirect back with errors and input if validation fails
            $messages = $validator->messages();
            if($messages->first('email'))
             session()->flash('ErrorEmail', $messages->first('email'));
            if($messages->first('mobile'))
             session()->flash('ErrorMmobile', $messages->first('mobile'));
            return back()->withErrors($validator)->withInput();
        }

        // Update the user
        $user = User::find($this->userId);
        if ($user) {
            $user->update([
                'full_name' => $this->fullname,
                'username' => $this->username,
                'email' => $this->email,
                'mobile_no' => $this->mobile,
                'role_id' => $this->role_id,
                'user_level_id' => $this->user_level_id,
            ]);

            //dd($this->district_id, $this->block_id, $this->subdivision_id);

            // Fetch district, block, and sub-district codes
            $districtCode = DB::table('m_district')->where('district_code', $this->district_id)->value('district_code');
            $blockCode = DB::table('m_block')->where('block_code', $this->block_id)->value('block_code');
            $subDistrictCode = DB::table('m_sub_district')->where('sub_district_code', $this->subdivision_id)->value('sub_district_code');

            //dd($districtCode, $blockCode, $subDistrictCode);

            $isUrban = null;
            $selectedUserLevel = UserLevel::find($this->user_level_id);
            if ($selectedUserLevel->stake_code == 'Block') {
                $isUrban = 1;
            } elseif ($selectedUserLevel->stake_code == 'Subdiv') {
                $isUrban = 2;
            }

            DutyAssignement::where('user_id', $user->id)->delete();

            foreach ($this->schemelist as $schemeId) {
                DutyAssignement::create([
                    'user_id' => $user->id,
                    'scheme_id' => $schemeId,
                    'role_id' => $this->role_id,
                    'mapping_level' => $this->user_level_id,
                    'is_active' => 1,
                    'created_by' => Auth::id(),
                    'is_state_login' => false,
                    'district_code' => $districtCode,
                    'blk_subdiv_code' => $blockCode ?? $subDistrictCode,
                    'is_urban' => $isUrban,
                ]);
            }

            Session::flash('success', 'User and duty assignments updated successfully!');
            return redirect()->route('editUserForm', ['id' => $user->id])
                ->with('success', 'User and duty assignments updated successfully!');
        }
    }

    public function filterRolesByUserLevel($user_level_id)
    {
        $this->roles = [];

        $selectedUserLevel = UserLevel::find($user_level_id);

        if ($selectedUserLevel) {
            if ($selectedUserLevel->stake_code == 'State') {
                $this->roles = Designation::where('name', 'HOD')->get();
            } else {
                $this->roles = Designation::all();
            }
        }
    }

    public function updatedUserLevelId($user_level_id)
    {
        // Reset district, block, and subdivision values when user level changes
        $this->district_id = null;
        $this->block_id = null;
        $this->subdivision_id = null;

        // Only clear blocks and subdivisions here
        $this->blocks = [];
        $this->subdivisions = [];

        // Maintain districts and populate based on user level, if required
        if (!$this->districts) {
            $this->districts = District::all();
        }

        // Optionally call filterRolesByUserLevel to adjust roles
        $this->filterRolesByUserLevel($user_level_id);
    }


    public function getDropdownStates()
    {
        $states = [
            'district' => true,
            'block' => true,
            'subdivision' => true,
        ];

        if ($this->user_level_id) {
            $selectedUserLevel = UserLevel::find($this->user_level_id);

            if ($selectedUserLevel) {
                if ($selectedUserLevel->stake_code === 'State') {
                    $states['district'] = false;
                    $states['block'] = false;
                    $states['subdivision'] = false;
                } elseif ($selectedUserLevel->stake_code === 'District') {
                    $states['block'] = false;
                    $states['subdivision'] = false;
                } elseif ($selectedUserLevel->stake_code === 'Block') {
                    $states['district'] = true;
                    $states['block'] = true;
                    $states['subdivision'] = false;
                } elseif ($selectedUserLevel->stake_code === 'Subdiv') {
                    $states['district'] = true;
                    $states['block'] = false;
                    $states['subdivision'] = true;
                }
            }
        }

        return $states;
    }


    public function render()
    {
        return view('livewire.edit-user');
    }
}
