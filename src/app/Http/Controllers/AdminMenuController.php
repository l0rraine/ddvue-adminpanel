<?php

namespace DDVue\AdminPanel\app\Http\Controllers;

use DDVue\AdminPanel\app\Models\DdvueMenu;
use DDVue\Crud\Controllers\CrudController;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class AdminMenuController extends CrudController
{
    /**
     * @var DdvueMenu
     */
    private $menu;
    /**
     * @var Role
     */
    private $role;

    /**
     * AdminMenuController constructor.
     *
     * @param DdvueMenu $ddvueMenu
     * @param Role      $role
     */
    public function __construct(DdvueMenu $ddvueMenu)
    {
        parent::__construct();
        $this->menu = $ddvueMenu;

        $roleModelName = config('ddvue.adminpanel.page_settings.role.model');
        $this->role    = new $roleModelName();
    }

    public function setup()
    {
        $this->crud->route = 'Ddvue.AdminPanel.menu';
//        $this->crud->permissionName = 'department';
        $this->crud->indexRecursive = true;
        $this->crud->title          = '后台菜单';
        $this->crud->viewName       = 'ddvue.adminpanel::pages.menu';
        $this->crud->setModel(DdvueMenu::class);

//        $this->crud->setPermissionName('list.department');

        parent::setup();

    }

    public function getIndex()
    {
        $this->data['roles'] = $this->role->get()->toArray();

        return parent::getIndex();
    }


    public function indexJson()
    {
        $r = $this->menu->getAllByParentId();

        return json_encode($r);
    }

    public function getAdd()
    {
        $this->data['menus'] = $this->menu->getSelectArrayByParentId(0, true);
        $this->data['roles'] = $this->role->get()->toArray();
        $this->data['title'] = '增加' . $this->crud->title;

        return parent::getAdd();
    }

    public function postAdd(Request $request)
    {
        return parent::storeCrud($request);
    }

    public function getEdit($id)
    {
        $this->data['menus'] = $this->menu->getSelectArrayByParentId(0, true);
        $this->data['roles'] = $this->role->get()->toArray();
        $this->data['title'] = '编辑' . $this->crud->title;
        $this->data['data']  = $this->menu->find($id)->toArray();

        return parent::getEdit($id);
    }

    public function postEdit(Request $request)
    {
        return parent::updateCrud($request);
    }


    public function del(Request $request)
    {
        return parent::del($request);
    }


    public function assignRole(Request $request)
    {
        $data = $request->all();
        $role = $data['role_id'];
        foreach ($data['selections'] as $selection) {

            $menu = $this->menu->find($selection['id']);

            $owners = $selection['owners'] ?? [];
            if (!collect($owners)->has($role)) {
                array_push($owners, $role);
                $menu->update(['owners' => $owners]);
            }
        }
    }


}