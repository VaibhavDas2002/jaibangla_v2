<?php

namespace App\DTO;

readonly class JBLandDetailsDTO
{
    public function __construct(
        public string $mouza_name,
        public string $land_ljno,
        public string $khatian_no,
        public string $plot_no,
        public string $land_area,
        public string $land_holdername,
        ) {
    }
}