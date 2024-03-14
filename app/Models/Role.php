<?php

namespace Spatie\Permission\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    public function __construct(array $attributes = [])
    {

    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany();
    }

    public function users(): BelongsToMany
    {
        return $this->morphedByMany();
    }

}
