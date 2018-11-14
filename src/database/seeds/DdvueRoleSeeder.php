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
        $guard = \Spatie\Permission\Guard::getDefaultName(config('ddvue.adminpanel.auth.user_model'));
        app()['cache']->forget('spatie.permission.cache');


//        $guard = config('ddvue.adminpanel.auth.admin_auth_middleware');
//        if(count(explode(':',$guard))==1){
//            $guard = config('auth.defaults.guard');
//        }else{
//            $guard = explode(':',$guard)[1];
//        }


        \DDVue\AdminPanel\app\Models\DdvPermission::create(['name' => '编辑 后台菜单','guard_name'=>$guard]);
        \DDVue\AdminPanel\app\Models\DdvPermission::create(['name' => '编辑 权限角色','guard_name'=>$guard]);


        $role = \DDVue\AdminPanel\app\Models\DdvRole::create(['name' => '超级管理员','guard_name'=>$guard]);
        $role->givePermissionTo('编辑 后台菜单');
        $role->givePermissionTo('编辑 权限角色');

        $role = \DDVue\AdminPanel\app\Models\DdvRole::create(['name' => '管理员']);

        $user = \DDVue\AdminPanel\app\Models\DdvUser::where('email', 'liqiang150.slyt')->first();
        $user->assignRole('超级管理员');

    }
}
