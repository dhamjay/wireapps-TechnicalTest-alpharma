<?php

namespace Spatie\Permission\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Contracts\Permission as PermissionContract;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Guard;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Traits\HasRoles;

class Permission extends Model
{
    use HasRoles;

    public function __construct(array $attributes = [])
    {

    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany();
    }

    public function users(): BelongsToMany
    {
        return $this->morphedByMany();
    }

}
