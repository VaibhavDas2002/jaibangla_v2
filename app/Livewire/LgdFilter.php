<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\District;
use App\Models\Assembly;
use App\Models\Taluka;
use App\Models\Ward;
use App\Models\UrbanBody;
use App\Models\GP;

class LgdFilter extends Component
{
    public $districts;
    public $assemblys = [];
    public $blocks = [];
    public $wards = [];
    public $urbanbodys = [];
    public $gps = [];

    public $selectedDistrict = null;
    public $selectedRuralurban = null;
    public $selectedBlockurban = null;
    public $selectedAssembly = null;
    public $selectedGpWard = null;

    public function mount()
    {
        $this->districts = District::all();
    }

    public function updatedSelectedDistrict()
    {
        $this->assemblys = $this->selectedDistrict
            ? Assembly::where('district_code', $this->selectedDistrict)->get()
            : [];

        // Reset dependent dropdowns
        $this->selectedAssembly = null;
        $this->selectedRuralurban = null;
        $this->selectedBlockurban = null;
        $this->urbanbodys = [];
        $this->blocks = [];
        $this->gps = [];
        $this->wards = [];
    }

    public function updatedSelectedRuralurban()
    {
        if ($this->selectedRuralurban == 1 && $this->selectedDistrict) {
            $this->urbanbodys = UrbanBody::where('district_code', $this->selectedDistrict)->get();
            $this->gps = [];
        } elseif ($this->selectedRuralurban == 2 && $this->selectedDistrict) {
            $this->blocks = Taluka::where('district_code', $this->selectedDistrict)->get();
            $this->wards = [];
            $this->gps = [];
        } else {
            $this->urbanbodys = [];
            $this->blocks = [];
        }
    }

    public function updatedSelectedBlockurban()
    {
        if ($this->selectedRuralurban == 1 && $this->selectedDistrict) {
            $this->wards = Ward::where('urban_body_code', $this->selectedBlockurban)->get();
        } elseif ($this->selectedRuralurban == 2 && $this->selectedDistrict) {
            $this->gps = GP::where('block_code', $this->selectedBlockurban)->get();
        } else {
            $this->wards = [];
            $this->gps = [];
        }
    }

    public function render()
    {
        return view('livewire.lgd-filter');
    }
}
