<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Designation;
use App\Models\UserLevel;
use App\Models\Scheme;
use App\Models\DutyAssignement;
use App\Models\District;
use App\Models\Block;
use App\Models\SubDistrict;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AddUser extends Component
{
    public $fullname;
    public $username;
    public $email;
    public $password;
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

    public function mount()
    {
        // Fetch roles, user levels, and schemes
        $this->roles = Designation::all();
        $this->userLevels = UserLevel::where('is_active', 1)->get();
        $this->schemes = Scheme::all(); // Fetch all schemes
    }

    public function getShouldShowBlocksProperty()
    {
        return $this->user_level_id && UserLevel::find($this->user_level_id)->stake_code == 'Block' && count($this->blocks) > 0;
    }

    public function getShouldShowSubdivisionsProperty()
    {
        return $this->user_level_id && UserLevel::find($this->user_level_id)->stake_code == 'Subdiv' && count($this->subdivisions) > 0;
    }

    public function updatedUserLevelId($user_level_id)
    {
        $this->district_id = null; // Reset district when user level changes
        $this->block_id = null; // Reset block when user level changes
        $this->subdivision_id = null; // Reset subdivision when user level changes
        $this->districts = []; // Clear districts
        $this->blocks = []; // Clear blocks
        $this->subdivisions = []; // Clear subdivisions
        $this->filterRolesByUserLevel($user_level_id);
        $selectedUserLevel = UserLevel::find($user_level_id);

        if ($selectedUserLevel) {
            if ($selectedUserLevel->stake_code == 'Block') {
                // Fetch districts if stake_code is "Block"
                $this->districts = District::all();
            } elseif ($selectedUserLevel->stake_code == 'District') {
                // Fetch districts if stake_code is "District"
                $this->districts = District::all();
            } elseif ($selectedUserLevel->stake_code == 'Subdiv') {
                // Fetch districts if stake_code is "District"
                $this->districts = District::all();
            }
        }
    }

    public function updatedDistrictId($district_id)
    {
        $this->block_id = null; // Reset block when district changes
        $this->blocks = []; // Clear blocks if no district is selected
        $this->subdivision_id = null; // Reset subdivision when district changes
        $this->subdivisions = []; // Clear subdivisions if no district is selected

        $selectedDistrict = District::find($district_id);

        if ($selectedDistrict) {
            // Fetch blocks based on the selected district's district_code
            $this->blocks = Block::where('district_code', $selectedDistrict->district_code)->get();
            // Fetch subdivisions based on the selected district's district_code
            $this->subdivisions = SubDistrict::where('district_code', $selectedDistrict->district_code)->get();
        }
    }

    protected $rules = [
        'fullname' => 'required|max:60',
        'username' => 'required',
        'password' => 'required',
        'email' => 'required|email',
        'mobile' => 'required|digits:10',
        'role_id' => 'required',
        'user_level_id' => 'required',
        'schemelist' => 'required|array|min:1', // Ensure at least one scheme is selected
    ];

    public function submit()
    {
        $this->validate();

        // Save the user with created_by and login_otp
        $user = User::create([
            'full_name' => $this->fullname,
            'username' => $this->username,
            'password' => bcrypt($this->password),
            'email' => $this->email,
            'mobile_no' => $this->mobile,
            'role_id' => $this->role_id,
            'user_level_id' => $this->user_level_id,
            'created_by' => Auth::id(), // Store the ID of the user creating this record
            'login_otp' => 123456, // Hardcoded login OTP
        ]);

        // Fetch district_code, block_code, and sub_district_code
        $districtCode = District::find($this->district_id)->district_code ?? null;
        $blockCode = Block::find($this->block_id)->block_code ?? null;
        $subDistrictCode = SubDistrict::find($this->subdivision_id)->sub_district_code ?? null;

        // Determine the is_urban value based on the user level
        $isUrban = null;
        $selectedUserLevel = UserLevel::find($this->user_level_id);
        if ($selectedUserLevel->stake_code == 'Block') {
            $isUrban = 1; // For Block user level
        } elseif ($selectedUserLevel->stake_code == 'Subdiv') {
            $isUrban = 2; // For Subdivision user level
        }

        // Save duty assignments for the selected schemes
        foreach ($this->schemelist as $schemeId) {
            DutyAssignement::create([
                'user_id' => $user->id,
                'scheme_id' => $schemeId,
                'role_id' => $this->role_id,
                'mapping_level' => $this->user_level_id, // Assign user_level_id to mapping_level
                'is_active' => 1, // Assuming 1 means active
                'created_by' => Auth::id(), // Assuming the logged-in user is creating this
                'is_state_login' => false, // Adjust this based on your business logic
                'district_code' => $districtCode, // Insert district_code
                'blk_subdiv_code' => $blockCode ?? $subDistrictCode, // Insert block_code or sub_district_code
                'is_urban' => $isUrban, // Set is_urban based on user level
            ]);
        }

        Session::flash('success', 'User and duty assignments added successfully!');
        $this->reset(); // Reset form fields

        // Redirect back to the same page
        return redirect()->route('dutymanagementForm')->with('success', 'User and duty assignments added successfully!');
    }
    
    public function filterRolesByUserLevel($user_level_id)
    {
        // Reset the roles array
        $this->roles = [];

        $selectedUserLevel = UserLevel::find($user_level_id);

        if ($selectedUserLevel) {
            if ($selectedUserLevel->stake_code == 'State') {
                // If user level is 'State', filter roles to only include 'HOD'
                $this->roles = Designation::where('name', 'HOD')->get();
            } else {
                // Otherwise, fetch all roles
                $this->roles = Designation::all();
            }
        }
    }



    public function render()
    {
        return view('livewire.add-user');
    }
}
