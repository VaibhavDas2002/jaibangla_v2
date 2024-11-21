<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Scheme;
use App\Models\Workflow;
use App\Models\Step;
use App\Models\Designation;

class WorkingFlow extends Component
{
    public $scheme_id;
    public $designations = [];
    public $stepsData = [];

    public $newStep = ['step_id' => '', 'designation_id' => ''];
    public $temporarySteps = [];

    public function mount($designations, $stepsData, $scheme_id)
    {
        $this->scheme_id = $scheme_id;
        $this->designations = $designations;
        $this->stepsData = $stepsData;
    }

    public function addStep()
    {
        if ($this->newStep['step_id'] && $this->newStep['designation_id']) {
            $this->temporarySteps[] = $this->newStep;
            // Reset the input fields to show "Select Step" and "Select Role"
            $this->newStep = ['step_id' => '', 'designation_id' => ''];
        }
    }

    public function removeTemporaryStep($index)
    {
        unset($this->temporarySteps[$index]);
        $this->temporarySteps = array_values($this->temporarySteps); // Re-index the array
    }

    public function submit()
    {
        // Prevent submission if there are no steps in the workflow
        if (empty($this->temporarySteps)) {
            session()->flash('error', 'Please add at least one step to the workflow before submitting.');
            return;
        }
        // Loop through the steps and insert them into the Workflow table
        foreach ($this->temporarySteps as $index => $step) {
            Workflow::create([
                'step_id' => $step['step_id'],
                'designation_id' => $step['designation_id'],
                'scheme_id' => $this->scheme_id,
                'is_last' => ($index === array_key_last($this->temporarySteps)) ? true : false, // Set is_last to true for the last step
                'is_first' => ($index === array_key_first($this->temporarySteps)) ? true : false, // Set is_first to true for the first step
            ]);
        }

        // Optionally reset temporary steps and provide feedback
        $this->temporarySteps = [];
        session()->flash('message', 'Workflow saved successfully!');
    }


    public function getStepName($stepId)
    {
        $step = $this->stepsData->firstWhere('id', $stepId);
        return $step ? $step->step_name : 'N/A';
    }

    public function getDesignationName($designationId)
    {
        $designation = $this->designations->firstWhere('id', $designationId);
        return $designation ? $designation->name : 'N/A';
    }

    public function getFilteredSteps()
    {
        // Get the highest rank_id from the already added steps
        $maxStepRank = 0;
        foreach ($this->temporarySteps as $step) {
            $stepDetails = Step::find($step['step_id']);
            if ($stepDetails && $stepDetails->rank_id > $maxStepRank) {
                $maxStepRank = $stepDetails->rank_id;
            }
        }

        // Filter steps that have rank_id greater than the maxStepRank
        return Step::where('rank_id', '>', $maxStepRank)->get();
    }

    public function getFilteredDesignations()
    {
        // Get the highest rank_id from the already added designations
        $maxDesignationRank = 0;
        foreach ($this->temporarySteps as $step) {
            $designationDetails = Designation::find($step['designation_id']);
            if ($designationDetails && $designationDetails->rank_id > $maxDesignationRank) {
                $maxDesignationRank = $designationDetails->rank_id;
            }
        }

        // Filter designations that have rank_id greater than the maxDesignationRank
        return Designation::where('rank_id', '>', $maxDesignationRank)->get();
    }

    public function render()
    {
        $scheme = Scheme::find($this->scheme_id);
        $filteredSteps = $this->getFilteredSteps(); // Get the filtered steps
        $filteredDesignations = $this->getFilteredDesignations(); // Get the filtered designations

        return view('livewire.working-flow', [
            'scheme' => $scheme,
            'filteredSteps' => $filteredSteps,
            'filteredDesignations' => $filteredDesignations,
        ]);
    }
}
