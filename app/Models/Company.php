<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'name',
        'website',
        'verified',
        'description',
        'user_id',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id'
        );

    }
}
