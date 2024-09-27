<?php

namespace App\DTO;

readonly class JBBankDetailsDTO
{
    public function __construct(
        public string $bank_ifsc_code,
        public string $name_of_bank,
        public string $bank_branch,
        public string $bank_account_number,     

    ) {
    }
}