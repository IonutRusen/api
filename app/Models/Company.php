<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $user_id
 * @property string $name
 * @property string $website
 * @property string $verified
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property string $id
 * @property string $ulid
 */
final class Company extends Model
{
    /**
     * user_id is the foreign key for the User model
     * @props ulid $user_id
     */
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
            foreignKey: 'user_id',
        );

    }

    public function addresses(): HasMany
    {
        return $this->hasMany(
            related: CompanyAddress::class,
            foreignKey: 'company_id',
        );
    }
}
