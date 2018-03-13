<?php

namespace DDVue\AdminPanel\app\Http\Controllers;

use DDVue\AdminPanel\app\Models\DdvueMenu;
use DDVue\Crud\Controllers\CrudController;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class DepartmentController extends CrudController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function setup()
    {
        $this->crud->route = 'Ddvue.AdminPanel.department';
//        $this->crud->permissionName = 'department';
        $this->crud->indexRecursive = true;
        $this->crud->title          = '单位';
        $this->crud->viewName       = config('ddvue.adminpanel.page_settings.department.view');
        $this->crud->setModel(config('ddvue.adminpanel.page_settings.department.model'));
//        $this->crud->setPermissionName('list.department');

        parent::setup();

    }

    public function getIndex()
    {
        return parent::getIndex();
    }


    public function indexJson()
    {
        $r = $this->crud->model->getAllByParentId();

        return json_encode($r);
    }

    public function getAdd()
    {

        return parent::getAdd();
    }

    public function postAdd(Request $request)
    {
        return parent::storeCrud($request);
    }

    public function getEdit($id)
    {
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