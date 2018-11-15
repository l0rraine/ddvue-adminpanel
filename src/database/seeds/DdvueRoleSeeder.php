<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DdvueRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');


//        $guard = config('ddvue.adminpanel.auth.admin_auth_middleware');
//        if(count(explode(':',$guard))==1){
//            $guard = config('auth.defaults.guard');
//        }else{
//            $guard = explode(':',$guard)[1];
//        }

        $permission_class = config('ddvue.adminpanel.page_settings.permission.model');
        $p = new $permission_class;

        $p::create(['name' => '编辑 后台菜单']);
        $p::create(['name' => '编辑 权限角色']);
        $p::create(['name' => '编辑 用户']);
        $p::create(['name' => '编辑 单位']);


        $role_class = config('ddvue.adminpanel.page_settings.role.model');

        $r = new $role_class;

        $role = $r::create(['name' => '超级管理员']);

        $role->givePermissionTo('编辑 后台菜单');
        $role->givePermissionTo('编辑 权限角色');
        $role->givePermissionTo('编辑 用户');
        $role->givePermissionTo('编辑 单位');

        $r::create(['name' => '管理员']);

        $user_class = config('ddvue.adminpanel.auth.user_model');
        $u = new $user_class;
        $user = $u::where('email', 'liqiang150.slyt')->first();
        $user->assignRole($role);

    }
}
