<?php

namespace App\DTO;

readonly class JBAdditionalDetailsDTO
{
    public function __construct(
       public string $app_phase,
       public string $temple_type,
    ) {
    }
}