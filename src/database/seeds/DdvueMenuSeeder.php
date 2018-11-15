<?php

use Illuminate\Database\Seeder;

class DdvueMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ddvue_menus')
          ->insert([
                       [
                           'title'      => '业务模块',
                           'type'       => 'submenu',
                           'index'      => '',
                           'icon'       => 'el-icon-menu',
                           'parent_id'  => 0,
                           'limits'      => null,
                           'created_at' => \Carbon\Carbon::now(),
                           'updated_at' => \Carbon\Carbon::now()
                       ],
                       [
                           'title'      => '管理模块',
                           'type'       => 'submenu',
                           'index'      => '',
                           'icon'       => 'el-icon-menu',
                           'parent_id'  => 0,
                           'limits'      => null,
                           'created_at' => \Carbon\Carbon::now(),
                           'updated_at' => \Carbon\Carbon::now()
                       ],
                       [
                           'title'      => '用户权限',
                           'type'       => 'group',
                           'index'      => '',
                           'icon'       => '',
                           'parent_id'  => 2,
                           'limits'      => null,
                           'created_at' => \Carbon\Carbon::now(),
                           'updated_at' => \Carbon\Carbon::now()
                       ],
                       [
                           'title'      => '用户',
                           'type'       => 'item',
                           'index'      => 'Ddvue.AdminPanel.user.index',
                           'icon'       => '',
                           'parent_id'  => 3,
                           'limits'      => '[3]',
                           'created_at' => \Carbon\Carbon::now(),
                           'updated_at' => \Carbon\Carbon::now()
                       ],
                       [
                           'title'      => '权限',
                           'type'       => 'item',
                           'index'      => 'Ddvue.AdminPanel.role.index',
                           'icon'       => '',
                           'parent_id'  => 3,
                           'limits'      => '[2]',
                           'created_at' => \Carbon\Carbon::now(),
                           'updated_at' => \Carbon\Carbon::now()
                       ],
                       [
                           'title'      => '单位',
                           'type'       => 'item',
                           'index'      => 'Ddvue.AdminPanel.department.index',
                           'icon'       => '',
                           'parent_id'  => 2,
                           'limits'      => '[4]',
                           'created_at' => \Carbon\Carbon::now(),
                           'updated_at' => \Carbon\Carbon::now()
                       ],
                       [
                           'title'      => '后台菜单',
                           'type'       => 'item',
                           'index'      => 'Ddvue.AdminPanel.menu.index',
                           'icon'       => '',
                           'parent_id'  => 2,
                           'limits'      => '[1]',
                           'created_at' => \Carbon\Carbon::now(),
                           'updated_at' => \Carbon\Carbon::now()
                       ],
                   ]);

        \DDVue\AdminPanel\app\Models\DdvueMenu::setAllClassList();
        \DDVue\AdminPanel\app\Models\DdvueMenu::setIndexAuto();
    }
}
