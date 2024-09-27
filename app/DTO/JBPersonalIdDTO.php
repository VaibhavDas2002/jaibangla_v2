<?php

namespace App\DTO;

readonly class JBPersonalIdDTO
{
    public function __construct(
        public string $ration_card_no,
        public string $ration_card_cat,
        public string $epic_vot_id,
        public string $aadhar_no,
        public ?string $pan_no,

    ) {
    }
}