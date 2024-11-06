<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use App\Models\Scheme;
use DB;

class SchemeSelection extends Component
{

    public $schemes;
    public $reports = [];
    public $selectedSchemeId = null;

    public function mount()
    {
        $user_id = Auth::user()->id;
        $designation_id = Auth::user()->designation_id;

        // Redirect if the user is not an Operator
        if ($designation_id != 'Operator') {
            abort(403, 'Not Allowed');
        }

        // Fetch user's assigned schemes from duty_assignment and m_scheme
        $this->schemes = DB::table('m_scheme')
            ->select('id', 'scheme_name', 'display_name')
            ->whereIn('id', function ($query) use ($user_id) {
                $query->select('scheme_id')
                    ->from('duty_assignement')
                    ->where('is_active', 1)
                    ->where('user_id', $user_id);
            })
            ->orderBy('rank')
            ->get();
    }

    public function updatedSelectedSchemeId($schemeId)
    {
        if ($schemeId) {
            // Fetch reports where is_common is true or the scheme list contains the selected scheme ID
            $this->reports = Report::where('is_active', true)
                ->where(function ($query) use ($schemeId) {
                    $query->where('is_common', true)
                        ->orWhereJsonContains('scheme_list', (int) $schemeId);
                })
                ->get();
        } else {
            $this->reports = [];
        }
    }

    public function render()
    {
        return view('livewire.scheme-selection');
    }
}
