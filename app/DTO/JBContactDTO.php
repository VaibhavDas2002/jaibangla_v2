<?php

namespace App\DTO;

readonly class JBContactDTO
{
    public function __construct(
 

        public string $state,
        public string $district,
        public string $asmb_cons,
        public string $urban_code,
        public string $block_urbanBody,
        public string $gp_ward,
        public string $village,
        public ?string $house,
        public string $post_office,
        public string $pin_code,
        public string $police_station,
        public string $cur_per_same,
        public string $state_cur,
        public string $district_cur,
        public string $asmb_cons_cur,
        public string $urban_code_cur,
        public string $block_cur,
        public string $gp_ward_cur,
        public string $village_cur,
        public ?string $house_cur,
        public string $post_office_cur,
        public string $pin_code_cur,
        public string $police_station_cur,
    ) {
    }
}