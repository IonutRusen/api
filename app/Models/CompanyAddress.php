<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

final class CompanyAddress extends Model
{
    use HasFactory;
    use HasSpatial;
    use HasUlids;

    protected $fillable = [
        'company_id',
        'address',
        'city',
        'state',
        'zip',
        'country',
        'phone',
        'email',
        'website',
        'location',
    ];

    protected $casts = [
        'location' => Point::class,
    ];

}
