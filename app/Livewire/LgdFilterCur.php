<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\District;
use App\Models\Assembly;
use App\Models\Taluka;
use App\Models\Ward;
use App\Models\UrbanBody;
use App\Models\GP;

class LgdFilterCur extends Component
{
    public $districts;
    public $assemblys = [];
    public $blocks = [];
    public $wards = [];
    public $urbanbodys = [];
    public $gps = [];

    public $selectedDistrictcur = null;
    public $selectedRuralurbancur = null;
    public $selectedBlockurbancur = null;
    public $selectedAssemblycur = null;
    public $selectedGpWardcur = null;

    public function mount()
    {
        $this->districts = District::all();
    }

    public function updatedSelectedDistrictcur()
    {
        $this->assemblys = $this->selectedDistrictcur
            ? Assembly::where('district_code', $this->selectedDistrictcur)->get()
            : [];

        // Reset dependent dropdowns
        $this->selectedAssemblycur = null;
        $this->selectedRuralurbancur = null;
        $this->selectedBlockurbancur = null;
        $this->urbanbodys = [];
        $this->blocks = [];
        $this->gps = [];
        $this->wards = [];
    }

    public function updatedSelectedRuralurbancur()
    {
        if ($this->selectedRuralurbancur == 1 && $this->selectedDistrictcur) {
            $this->urbanbodys = UrbanBody::where('district_code', $this->selectedDistrictcur)->get();
            $this->gps = [];
        } elseif ($this->selectedRuralurbancur == 2 && $this->selectedDistrictcur) {
            $this->blocks = Taluka::where('district_code', $this->selectedDistrictcur)->get();
            $this->wards = [];
            $this->gps = [];
        } else {
            $this->urbanbodys = [];
            $this->blocks = [];
        }
    }

    public function updatedSelectedBlockurbancur()
    {
        if ($this->selectedRuralurbancur == 1 && $this->selectedDistrictcur) {
            $this->wards = Ward::where('urban_body_code', $this->selectedBlockurbancur)->get();
        } elseif ($this->selectedRuralurbancur == 2 && $this->selectedDistrictcur) {
            $this->gps = GP::where('block_code', $this->selectedBlockurbancur)->get();
        } else {
            $this->wards = [];
            $this->gps = [];
        }
    }

    public function render()
    {
        return view('livewire.lgd-filter-cur');
    }
}
