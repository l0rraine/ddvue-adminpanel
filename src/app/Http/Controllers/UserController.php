<?php

namespace DDVue\AdminPanel\app\Http\Controllers;

use App\Http\Controllers\Controller;
use DDVue\AdminPanel\app\Models\DdvueMenu;
use DDVue\Crud\Controllers\CrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kodeine\Acl\Models\Eloquent\Role;


class UserController extends CrudController
{
    /**
     * @var Role
     */
    private $role;

    /**
     * UserController constructor.
     *
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        parent::__construct();
        $this->role = $role;
    }

    public function setup()
    {
        $this->crud->route = 'Ddvue.AdminPanel.user';
//        $this->crud->permissionName = 'department';
        $this->crud->indexRecursive = true;
        $this->crud->title          = '用户';
        $this->crud->viewName       = 'ddvue.adminpanel::pages.user';
        $this->crud->setModel(config('ddvue.adminpanel.page_settings.user.model'));

//        $this->crud->setPermissionName('list.department');

        parent::setup();

    }

    public function getIndex()
    {
        return parent::getIndex(); // TODO: Change the autogenerated stub
    }


    public function indexJson()
    {
        $this->data = $this->crud->model->get();

        return parent::makeIndexJson(true);
    }

    public function getAdd()
    {
        $this->data['roles'] = $this->role->get()->toArray();

        return parent::getAdd(); // TODO: Change the autogenerated stub
    }

    public function postAdd(Request $request)
    {
        return parent::storeCrud($request); // TODO: Change the autogenerated stub
    }

    public function getEdit($id)
    {
        $this->data['roles'] = $this->role->get()->toArray();
        $this->data['data'] = $this->crud->model->find($id)->toArray();
        return parent::getEdit($id); // TODO: Change the autogenerated stub
    }

    public function postEdit(Request $request)
    {
        return parent::updateCrud($request); // TODO: Change the autogenerated stub
    }


    public function del(Request $request)
    {
        return parent::del($request); // TODO: Change the autogenerated stub
    }

}