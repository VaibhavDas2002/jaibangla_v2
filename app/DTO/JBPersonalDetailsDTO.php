<?php

namespace App\DTO;

readonly class JBPersonalDetailsDTO
{
    public function __construct(
        public string $entry_type,
        public string $scheme_id,
        public ?string $ds_registration_no,
        public ?string $ds_date,
        public ?string $ds_phase,
        public string $first_name,
        public ?string $middle_name, // Nullable middle name
        public string $last_name,
        public string $gender,
        public string $dob,
        public string $father_first_name,
        public ?string $father_middle_name, // Nullable father middle name
        public string $father_last_name,
        public string $mother_first_name,
        public ?string $mother_middle_name, // Nullable mother middle name
        public string $mother_last_name,
        public string $caste_category,
        public ?string $caste_certificate_no,
        public string $marital_status,
        public float $monthly_income, // Nullable float for income
        public ?string $spouse_first_name, // Nullable spouse name
        public ?string $spouse_middle_name,
        public ?string $spouse_last_name, // Nullable spouse middle name
        public ?string $residency_period,
        public string $mobile,
        public ?string $email // Nullable email
    ) {
    }
}
