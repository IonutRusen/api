<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\Enum as Exception;
use Illuminate\Support\Collection;
use ReflectionClass;

final class Enum
{
    private static array $data;

    private static bool $localisation = true;

    private static bool $validatesKeys = false;

    public static function get($key)
    {
        if (static::$validatesKeys && ! self::has($key)) {
            throw Exception::keyNotFound();
        }

        return self::attributes()->get($key);
    }

    public static function has($key): bool
    {
        return self::attributes()->has($key);
    }

    public static function constants(): array
    {
        $reflection = new ReflectionClass(static::class);

        $filter = fn($constant) => is_string($constant) || is_numeric($constant);

        $valid = array_filter($reflection->getConstants(), $filter);

        $constants = array_flip($valid);

        $filter = fn($constant) => $reflection
            ->getReflectionConstant($constant)->isPublic();

        $public = array_filter($constants, $filter);

        return $public;
    }

    public static function keys(): Collection
    {
        return self::attributes()->keys();
    }

    public static function json(): string
    {
        return self::attributes()->toJson();
    }

    public static function all(): array
    {
        return self::array();
    }

    public static function array(): array
    {
        return self::attributes()->toArray();
    }

    public static function object(): object
    {
        return (object) self::array();
    }

    public static function collection(): Collection
    {
        return self::attributes();
    }

    public static function select(): Collection
    {
        return self::attributes()
            ->map(fn($value, $key) => (object) ['id' => $key, 'name' => $value])
            ->values();
    }

    public static function values(): Collection
    {
        return self::attributes()->values();
    }

    public static function localisation(bool $state = true): void
    {
        static::$localisation = $state;
    }

    private static function attributes(): Collection
    {
        return self::transAll(self::source());
    }

    private static function transAll($data): Collection
    {
        return Collection::wrap($data)->map(fn($value) => self::trans($value));
    }

    private static function trans($value)
    {
        return is_string($value) && static::$localisation
            ? __($value)
            : $value;
    }

    private static function source(): array
    {
        if ( ! empty(static::data())) {
            return static::data();
        }

        if (isset(static::$data)) {
            return static::$data;
        }

        return static::constants();
    }

    private static function data(): array
    {
        return [];
    }
}
