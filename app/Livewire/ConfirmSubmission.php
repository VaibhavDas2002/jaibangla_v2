<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\District;
use Livewire\Attributes\On;

class ConfirmSubmission extends Component
{
    public $confirm_submit = 1;
    public $scheme_id;
    public $districts;

    #[On('show-submissions-modal')]
    public function draft($confirmSubmitId)
    {
        $this->confirm_submit = $confirmSubmitId;
    }

    public function mount($scheme_id)
    {
        $this->scheme_id = $scheme_id;
        $this->districts = District::all(); // Changed from $districts ?? District::all() to District::all()
    }

    public function render()
    {
        return view('livewire.confirm-submission', [
            'scheme_id' => $this->scheme_id,
            'confirm_submit' => $this->confirm_submit,
            'districts' => $this->districts,
        ]);
    }
}
