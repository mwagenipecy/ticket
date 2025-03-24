<?php

namespace App\Enums;

enum ServiceTypeEnum : string
{
    case Share = 'SHA';
    case Deposit = 'DEP';
    case Loan = 'LOA';
    case Savings = 'SAV';

    public static function getCode(string $service): ?string
    {
        return match($service) {
            'Share' => self::Share->value,
            'Deposit' => self::Deposit->value,
            'Loan' => self::Loan->value,
            'Savings' => self::Savings->value,
            default => null,
        };
    }
}
