<?php

namespace App\Enums;

use App\Services\Enum;

class PayRollCycles extends Enum
{
    public const WEEKLY = 1;
    public const BIWEEKLY = 2;
    public const TWICE_A_MONTH = 3;
    public const MONTHLY = 4;
    //

    protected static array $data = [
        self::MONTHLY => 'Monthly',
        self::TWICE_A_MONTH => 'Twice a Month',
        self::BIWEEKLY => 'Bi-Weekly',
        self::WEEKLY => 'Weekly',
    ];

    public static function getKey($value): int
    {
        return array_search($value, self::$data);
    }

    public static function getName($value): string
    {
        return self::$data[$value];
    }
}

