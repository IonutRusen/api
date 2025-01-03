<?php

declare(strict_types=1);

namespace App\Exceptions;

use InvalidArgumentException;

final class Enum extends InvalidArgumentException
{
    public static function keyNotFound(): static
    {
        return new static(__('Key not found'));
    }
}
