<?php

namespace DDVue\AdminPanel\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use DDVue\AdminPanel\app\Models\DdvPermission;
use DDVue\AdminPanel\app\Models\DdvueMenu;
use DDVue\Crud\Controllers\CrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;


class RoleController extends CrudController
{
    /**
     * @var DdvPermission
     */
    private $permission;

    /**
     * UserController constructor.
     *
     * @internal param Role $role
     */
    public function __construct()
    {
        parent::__construct();

        $permissionModelName = config('ddvue.adminpanel.page_settings.permission.model');
        $this->permission = new $permissionModelName();
    }

    public function setup()
    {
        $this->crud->route = 'Ddvue.AdminPanel.role';
//        $this->crud->permissionName = 'department';
        $this->crud->indexRecursive = true;
        $this->crud->title          = '角色';
        $this->crud->viewName       = config('ddvue.adminpanel.page_settings.role.view');
        $this->crud->setModel(config('ddvue.adminpanel.page_settings.role.model'));

        $this->crud->setPermissionName('编辑 权限角色');

        parent::setup();

    }

    public function getIndex()
    {
        return parent::getIndex();
    }


    public function indexJson()
    {
        $this->data = $this->crud->model->get();

        return parent::makeIndexJson(true);
    }

    public function getAdd()
    {
        $this->data['permissions'] = $this->permission->get()->toArray();
        $this->data['guards']  = collect(config('auth.guards'))->keys();

        return parent::getAdd();
    }

    public function postAdd(Request $request)
    {
        return parent::storeCrud($request);
    }

    public function getEdit($id)
    {
        $this->data['permissions'] = $this->permission->get()->toArray();
        $this->data['data']  = $this->crud->model->find($id)->toArray();
        $this->data['guards']  = collect(config('auth.guards'))->keys();

        return parent::getEdit($id);
    }

    public function postEdit(Request $request)
    {
        $this->doAfterCrudData = $request->all();
        return parent::updateCrud($request);
    }


    public function del(Request $request)
    {
        return parent::del($request);
    }

}