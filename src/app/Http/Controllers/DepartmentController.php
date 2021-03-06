<?php

namespace DDVue\AdminPanel\app\Http\Controllers;

use DDVue\Crud\Controllers\CrudController;
use Illuminate\Http\Request;


class DepartmentController extends CrudController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function setup()
    {
        $this->crud->route          = 'Ddvue.AdminPanel.department';
        $this->crud->indexRecursive = true;
        $this->crud->title          = '单位';
        $this->crud->viewName       = config('ddvue.adminpanel.page_settings.department.view');
        $this->crud->setModel(config('ddvue.adminpanel.page_settings.department.model'));
        $this->crud->setPermissionName('编辑 单位');

        $this->crud->addQueryParam('', ['title', 'pinyin'], ['value' => 'title']);
        parent::setup();

    }

    public function getIndex()
    {
        return parent::getIndex();
    }


    public function indexJson()
    {
        $this->data =  $this->crud->model->getAllByParentId(0);

        return parent::makeIndexJson();
    }

    public function getAdd()
    {
        $this->data['departments'] = $this->crud->model->getSelectArrayByParentId(0, true);

        return parent::getAdd();
    }

    public function postAdd(Request $request)
    {
        return parent::storeCrud($request);
    }

    public function getEdit($id)
    {
        $this->data['departments'] = $this->crud->model->getSelectArrayByParentId(0, true);
        $this->data['data']        = $this->crud->model->find($id);

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