<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DsPhase;
use App\Models\District;
use App\Models\UrbanBody;
use App\Models\GP;
use App\Models\Taluka;
use App\Models\Ward;
use App\Models\BenPersonalDetail;
use App\Models\BenBankDetail;
use App\Models\BenContactDetail;

class ReportFilter extends Component
{
    public $phases;
    public $districts = [];
    public $ruralUrbanOptions = [
        1 => 'Urban',
        2 => 'Rural',
    ];
    public $blocks = [];
    public $municipalities = [];
    public $gpwards = [];
    public $beneficiaries = []; // To store the filtered beneficiaries

    public $selectedPhase = null;
    public $selectedDistrict = null;
    public $selectedRuralUrban = null;
    public $selectedBlock = null;
    public $selectedMunicipality = null;
    public $selectedGpWard = null;
    public $selectedUrbanWard = null;

    public function mount()
    {
        $this->phases = DsPhase::all();
        $this->districts = District::orderBy('district_name', 'ASC')->get();
        // Load initial beneficiaries without filters
        $this->loadBeneficiaries();
    }

    public function loadBeneficiaries()
    {
        $this->beneficiaries = BenPersonalDetail::join('ben_bank_details', 'ben_personal_details.id', '=', 'ben_bank_details.ben_id')
            ->join('ben_contact_details', 'ben_personal_details.id', '=', 'ben_contact_details.ben_id')
            ->join('m_district', 'm_district.district_code', '=', 'ben_contact_details.dist_code')
            ->select(
                'ben_personal_details.ben_fname',
                'ben_personal_details.ben_mname',
                'ben_personal_details.ben_lname',
                'ben_personal_details.mobile_no',
                'ben_bank_details.bank_ifsc',
                'ben_bank_details.bank_code',
                'ben_contact_details.block_ulb_name',
                'ben_contact_details.gp_ward_name',
                'ben_contact_details.village_town',
                'ben_contact_details.house_premise_no',
                'm_district.district_name'
            )
            ->get();
    }

    public function updatedFilters()
    {
        $this->loadFilteredData();
    }

    public function loadFilteredData()
    {
        $query = BenPersonalDetail::join('ben_bank_details', 'ben_personal_details.id', '=', 'ben_bank_details.ben_id')
            ->join('ben_contact_details', 'ben_personal_details.id', '=', 'ben_contact_details.ben_id')
            ->join('m_district', 'm_district.district_code', '=', 'ben_contact_details.dist_code')
            ->select(
                'ben_personal_details.ben_fname', 'ben_personal_details.ben_mname', 'ben_personal_details.ben_lname', 'ben_personal_details.mobile_no', 'ben_bank_details.bank_ifsc', 'ben_bank_details.bank_code', 'ben_contact_details.block_ulb_name', 'ben_contact_details.block_ulb_code', 'ben_contact_details.gp_ward_name', 'ben_contact_details.village_town', 'ben_contact_details.house_premise_no', 'ben_contact_details.gp_ward_code', 'm_district.district_name'
            );

        if ($this->selectedDistrict) {
            $query->where('dist_code', $this->selectedDistrict);
        }

        if ($this->selectedRuralUrban) {
            $query->where('ben_contact_details.rural_urban_id', $this->selectedRuralUrban);

            if ($this->selectedRuralUrban == 1) {
                if ($this->selectedMunicipality) {
                    $query->where('ben_contact_details.block_ulb_code', $this->selectedMunicipality);
                }
                if ($this->selectedUrbanWard) {
                    $query->where('ben_contact_details.gp_ward_code', $this->selectedUrbanWard);
                }
            } elseif ($this->selectedRuralUrban == 2) {
                if ($this->selectedBlock) {
                    $query->where('ben_contact_details.block_ulb_code', $this->selectedBlock);
                }
                if ($this->selectedGpWard) {
                    $query->where('ben_contact_details.gp_ward_code', $this->selectedGpWard);
                }
            }
        }
        // Load beneficiaries based on filters
        $this->beneficiaries = $query->get();
    }

    public function updatedSelectedDistrict()
    {
        $this->reset(['selectedRuralUrban', 'selectedBlock', 'selectedMunicipality', 'selectedGpWard']);
        $this->blocks = [];
        $this->municipalities = [];
        $this->gpwards = [];

        // Reset and reload rural/urban options
        if ($this->selectedDistrict) {
            $this->updatedFilters();
        }
    }

    public function updatedSelectedRuralUrban()
    {
        $this->reset(['selectedBlock', 'selectedMunicipality', 'selectedGpWard']);
        $this->gpwards = [];
        $this->updatedFilters();

        if ($this->selectedRuralUrban == 1) {
            // Load municipalities if "Urban" is selected
            $this->municipalities = UrbanBody::where('district_code', $this->selectedDistrict)->get();
            $this->blocks = [];
        } elseif ($this->selectedRuralUrban == 2) {
            // Load blocks if "Rural" is selected
            $this->blocks = Taluka::where('district_code', $this->selectedDistrict)->get();
            $this->municipalities = [];
        }
    }

    public function updatedSelectedBlock()
    {
        $this->updatedFilters();

        if ($this->selectedRuralUrban == 2) {
            // Load GP for rural areas
            $this->gpwards = GP::where('block_code', $this->selectedBlock)->get();

        }
    }

    public function updatedSelectedGpWard()
    {
        $this->updatedFilters();
    }

    public function updatedSelectedUrbanWard(){
        $this->updatedFilters();
    }


    public function updatedSelectedMunicipality()
    {
        $this->reset(['selectedUrbanWard', 'selectedGpWard']); // Reset both
        $this->updatedFilters();

        if ($this->selectedRuralUrban == 1) {
            // Load wards for urban areas
            $this->gpwards = Ward::where('urban_body_code', $this->selectedMunicipality)->get();
        }
    }

    public function render()
    {
        return view('livewire.report-filter', [
            'beneficiaries' => $this->beneficiaries,
        ]);
    }

    // export function
    public function downloadCsv()
    {
        // Call loadFilteredData to refresh the beneficiaries data
        $this->loadFilteredData();

        $fileName = 'beneficiaries_export.csv';
        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=\"$fileName\"",
        ];

        $columns = [
            'Beneficiary Name', 'Mobile No',
            'Bank IFSC', 'Bank Code', 'Block/Municipality',
            'Block/Municipality Code', 'GP/Ward Name', 'Village/Town',
            'House Premise No', 'GP/Ward Code', 'District'
        ];

        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($this->beneficiaries as $beneficiary) {
                fputcsv($file, [
                    $beneficiary->ben_fname.' '. $beneficiary->ben_mname.' '.$beneficiary->ben_lname,
                    $beneficiary->mobile_no,
                    $beneficiary->bank_ifsc,
                    $beneficiary->bank_code,
                    $beneficiary->block_ulb_name,
                    $beneficiary->block_ulb_code,
                    $beneficiary->gp_ward_name,
                    $beneficiary->village_town,
                    $beneficiary->house_premise_no,
                    $beneficiary->gp_ward_code,
                    $beneficiary->district_name
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
