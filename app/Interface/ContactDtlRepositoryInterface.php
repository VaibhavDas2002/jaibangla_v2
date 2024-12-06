<?php

namespace App\Interface;

interface ContactDtlRepositoryInterface
{
    public static function saveConatctDtl(array $data, $benId);
}
