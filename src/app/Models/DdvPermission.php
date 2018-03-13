<?php

namespace DDVue\AdminPanel\app\Models;

use DDVue\Crud\ModelTraits\BaseModelTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Contracts\Permission as PermissionContract;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Permission;

class DdvPermission extends Permission
{
    use BaseModelTrait;

    protected $table='permissions';

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            config('permission.models.role'),
            config('permission.table_names.role_has_permissions'),
            'permission_id','role_id'
        );
    }

}
