<?php

namespace App\Interface;

use App\DTO\JBPersonalDetailsDTO;

interface PersonalDtlRepositoryInterface
{
    public static function savePersonalDtl(array $data): int;
}