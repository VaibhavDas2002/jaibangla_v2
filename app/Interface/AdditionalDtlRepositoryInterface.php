<?php

namespace App\Interface;

interface AdditionalDtlRepositoryInterface
{
    public static function saveAdditionalDtl(array $data, $benId);
}
