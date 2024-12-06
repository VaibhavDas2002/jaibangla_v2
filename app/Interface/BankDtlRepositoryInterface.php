<?php

namespace App\Interface;

interface BankDtlRepositoryInterface
{
    public static function saveBankDtl(array $data, $benId);
}
