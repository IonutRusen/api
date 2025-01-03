<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class CompanyAddress extends Model
{
    use HasFactory, HasUlids, HasSpatial;

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
        'location' => Point::class
    ];

}
