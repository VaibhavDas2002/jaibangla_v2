<?php

namespace App\Interface;

interface PersonalIdRepositoryInterface
{
    // Define your methods here
    public static function savePersonalId(array $data , int $benId): int;
}
