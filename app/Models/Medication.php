<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medication extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
    'name',
    'generic_name',
    'brand_name',
    'description',
    'quantity',
    'expiry',
    ];

    public function purchased(): MorphTo
    {
        return $this->morphTo();
    }

}
