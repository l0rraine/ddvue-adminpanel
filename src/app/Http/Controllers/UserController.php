<?php

namespace DDVue\AdminPanel\app\Http\Controllers;

use DDVue\Crud\Controllers\CrudController;
use DDVue\DepCRUD\app\Models\Department;
use Illuminate\Http\Request;
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

        $this->crud->permissionName = '编辑 用户';

        $roleModelName = config('ddvue.adminpanel.page_settings.role.model');
        $this->role    = new $roleModelName();

        $departmentModelName = config('ddvue.adminpanel.page_settings.department.model');
        $this->department    = new $departmentModelName();

    }

    public function setup()
    {
        $this->crud->route          = 'Ddvue.AdminPanel.user';
        $this->crud->indexRecursive = true;
        $this->crud->title          = '用户';
        $this->crud->viewName       = config('ddvue.adminpanel.page_settings.user.view');
        $this->crud->setModel(config('ddvue.adminpanel.page_settings.user.model'));

        $this->crud->setPermissionName('编辑 用户');

        $this->crud->addQueryParam('用户', ['displayname', 'email'], ['value' => 'displayname||email']);

        $this->crud->addQueryParam('单位', ['title', 'pinyin'], ['value' => 'title'], 'department', 'dep_id');

        parent::setup();

    }

    public function getIndex()
    {
        return parent::getIndex();
    }


    public function indexJson()
    {
        return parent::makeIndexJson(true);
    }

    public function query(Request $request)
    {
        return parent::query($request);
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