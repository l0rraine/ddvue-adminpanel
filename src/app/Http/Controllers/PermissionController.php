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


class PermissionController extends CrudController
{

    /**
     * UserController constructor.
     *
     * @internal param Role $role
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function setup()
    {
        $this->crud->route = 'Ddvue.AdminPanel.permission';
//        $this->crud->permissionName = 'department';
        $this->crud->indexRecursive = true;
        $this->crud->title          = '权限';
        $this->crud->viewName       = config('ddvue.adminpanel.page_settings.permission.view');
        $this->crud->setModel(config('ddvue.adminpanel.page_settings.permission.model'));

//        $this->crud->setPermissionName('list.department');

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
        $this->data['guards']  = collect(config('auth.guards'))->keys();

        return parent::getAdd();
    }

    public function postAdd(Request $request)
    {
        return parent::storeCrud($request);
    }

    public function getEdit($id)
    {
        $this->data['data']  = $this->crud->model->find($id)->toArray();
        $this->data['guards']  = collect(config('auth.guards'))->keys();

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

}