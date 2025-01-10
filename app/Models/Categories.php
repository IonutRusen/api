<?php

declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['title', 'alias', 'parent_id'];
}
