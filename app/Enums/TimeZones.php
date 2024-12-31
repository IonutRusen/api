<?php

namespace App\Enums;

use App\Services\Enum;

class TimeZones extends Enum
{
    public const Eastern = 1;
    public const Central = 2;
    public const Mountain = 3;
    public const Pacific = 4;
    public const Alaska = 5;
    public const Pacific_Honolulu = 6;
    public const Romania = 7;

    protected static array $data = [
        self::Eastern => 'Eastern',
        self::Central => 'Central',
        self::Mountain => 'Mountain',
        self::Pacific => 'Pacific',
        self::Alaska => 'Alaska',
        self::Pacific_Honolulu => 'Pacific/Honolulu',
        self::Romania => 'Romania',
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
