<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BankDetails;

class BankDetailss extends Component
{
    public $bankIfsc;
    public $bankName;
    public $bankBranch;
    public $errorMessage;

    // Method to be called when 'bankIfsc' is updated
    public function updatedBankIfsc($value)
    {
        // Clear previous errors
        $this->errorMessage = null;

        // Validate IFSC length
        if (strlen($value) == 11) {
            // Fetch the bank details based on IFSC
            $bankDetails = BankDetails::where('ifsc', $value)->first();
            
            if ($bankDetails) {
                // Set the bank name and branch
                $this->bankName = $bankDetails->bank;
                $this->bankBranch = $bankDetails->branch;
            } else {
                // Set error message if IFSC is not found
                $this->errorMessage = 'Bank details not found for this IFSC code';
                $this->bankName = null;
                $this->bankBranch = null;
            }
        } else {
            // Clear fields and set error message if IFSC length is not 11 characters
            $this->errorMessage = 'Invalid IFSC code';
            $this->bankName = null;
            $this->bankBranch = null;
        }
    }

    public function render()
    {
        return view('livewire.bank-detailss');
    }
}
