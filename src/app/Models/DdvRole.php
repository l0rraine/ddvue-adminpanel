<?php

namespace DDVue\AdminPanel\app\Models;

use Carbon\Carbon;
use DDVue\Crud\ModelTraits\BaseModelTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Contracts\Role as RoleContract;
use Spatie\Permission\Exceptions\GuardDoesNotMatch;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class DdvRole extends Role
{
    use BaseModelTrait;

    public $with = ['permissions'];

    public $fillable = ['name', 'guard_name','updated_at'];

    /**
     * A role may be given various permissions.
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            config('permission.models.permission'),
            config('permission.table_names.role_has_permissions'),
            'role_id', 'permission_id'
        );
    }

//    public static function findByName(string $name, $guardName = null): RoleContract
//    {
//        $guardName = $guardName ?? Guard::getDefaultName(static::class);
//
//        $role = static::where('name', $name)->where('guard_name', 'like', '%,' . $guardName . ',%')->first();
//
//        if (!$role) {
//            throw RoleDoesNotExist::named($name);
//        }
//
//        return $role;
//    }
//
//    public static function findById(int $id, $guardName = null): RoleContract
//    {
//        $guardName = $guardName ?? Guard::getDefaultName(static::class);
//
//        $role = static::where('id', $id)->where('guard_name', 'like', '%,' . $guardName . ',%')->first();
//
//        if (!$role) {
//            throw RoleDoesNotExist::withId($id);
//        }
//
//        return $role;
//    }
    public function doAfterCU($data = [])
    {
        $this->update(['updated_at' => Carbon::now()]);
        $old_permissions = $this->permissions()->pluck('id')->values();
        $permissions     = collect($data['permissions'])->values();
        $minus           = $old_permissions->diff($permissions);
        $add             = $permissions->diff($old_permissions);
        $permission      = new DdvPermission();
        foreach ($minus as $p) {
            $this->revokePermissionTo($permission->find($p));
        }

        if (count($add))
            $this->givePermissionTo($permission->whereIn('id', $add)->pluck('name'));


    }


}
