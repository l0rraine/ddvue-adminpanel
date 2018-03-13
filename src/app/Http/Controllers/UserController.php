<?php

namespace DDVue\AdminPanel\app\Http\Controllers;

use DDVue\AdminPanel\app\Models\DdvDepartment;
use DDVue\AdminPanel\app\Models\DdvRole;
use DDVue\Crud\Controllers\CrudController;
use DDVue\DepCRUD\app\Models\Department;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;


class UserController extends CrudController
{
    /**
     * @var Role
     */
    private $role;

    /**
     * @var Department
     */
    private $department;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $roleModelName = config('ddvue.adminpanel.page_settings.role.model');
        $this->role    = new $roleModelName();

        $departmentModelName = config('ddvue.adminpanel.page_settings.department.model');
        $this->department    = new $departmentModelName();

    }

    public function setup()
    {
        $this->crud->route = 'Ddvue.AdminPanel.user';
//        $this->crud->permissionName = 'department';
        $this->crud->indexRecursive = true;
        $this->crud->title          = '用户';
        $this->crud->viewName       = config('ddvue.adminpanel.page_settings.user.view');
        $this->crud->setModel(config('ddvue.adminpanel.page_settings.user.model'));

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
        $this->data['roles'] = $this->role->get()->toArray();

        $this->data['departments'] = $this->department->getSelectArrayByParentId(0);

        return parent::getAdd();
    }

    public function postAdd(Request $request)
    {
        return parent::storeCrud($request);
    }

    public function getEdit($id)
    {
        $this->data['roles']       = $this->role->get()->toArray();
        $this->data['data']        = $this->crud->model->find($id)->toArray();
        $this->data['departments'] = $this->department->getSelectArrayByParentId(0);

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


    public function changePassword($id)
    {
        $data = $this->crud->model->find($id);

        return view($this->crud->viewName . '.changePassword', compact('data'));
    }

    public function doChange(Request $request)
    {
        $this->doAfterCrudData = $request->all();

        return parent::updateCrud($request);
    }

}