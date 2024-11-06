<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Scheme;
use App\Models\Report;

class ReportView extends Component
{
    public $schemeId;
    public $reportId;
    public $viewMode = 'list'; // default view mode is 'list'
    public $users = [];
    public $fields = ['username', 'email', 'mobile_no'];

    public $schemeDetails;
    public $reportDetails;

    public function mount($schemeId, $reportId)
    {
        $this->schemeId = $schemeId;
        $this->reportId = $reportId;

        // Fetch and assign scheme and report details
        $this->schemeDetails = Scheme::find($this->schemeId);
        $this->reportDetails = Report::find($this->reportId);

        // Fetch users based on scheme and report type (e.g., verified status)
        $this->users = User::where('is_active', '1')->select($this->fields)->get();

    }

    // Function to toggle between views (list or count)
    public function setViewMode($mode)
    {
        $this->viewMode = $mode;
        $this->users = User::where('is_active', '1')->select($this->fields)->get();
    }

    public function render()
    {
        return view('livewire.report-view', [
            'scheme' => $this->schemeDetails,
            'report' => $this->reportDetails,
            'users' => $this->users,
            'viewMode' => $this->viewMode,
            'fields' => $this->fields,
        ]);
    }
}
