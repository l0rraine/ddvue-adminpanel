<?php

namespace DDVue\AdminPanel\app\Http\Controllers;

use DDVue\AdminPanel\app\Models\DdvueMenu;
use DDVue\Crud\Controllers\CrudController;
use Illuminate\Database\Eloquent\Model;
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
        $this->crud->route          = 'Ddvue.AdminPanel.department';
        $this->crud->indexRecursive = true;
        $this->crud->title          = '单位';
        $this->crud->viewName       = config('ddvue.adminpanel.page_settings.department.view');
        $this->crud->setModel(config('ddvue.adminpanel.page_settings.department.model'));
        $this->crud->setPermissionName('编辑 单位');

        parent::setup();

    }

    public function getIndex()
    {
        return parent::getIndex();
    }


    public function indexJson()
    {

        return parent::makeIndexJson();
    }

    public function makeQueryParam()
    {
        $this->crud->queryParams = [
            'model'  => config('ddvue.adminpanel.page_settings.department.model'),
            'groups' => [
                [
                    'title'   => '',
                    'join'    => '',
                    'columns' => [
                        'title', 'pinyin', 'center_code'
                    ],
                    'maps'    => [
                        'value' => 'title'
                    ]

                ]
            ]

        ];
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