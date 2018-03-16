<?php

namespace DDVue\AdminPanel\app\Http\Controllers;

use DDVue\AdminPanel\app\Models\DdvueMenu;
use DDVue\Crud\app\Models\QueryParam;
use DDVue\Crud\Controllers\CrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    private $permission;

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

        $permissionModelName = config('ddvue.adminpanel.page_settings.permission.model');
        $this->permission    = new $permissionModelName();
    }

    public function setup()
    {
        $this->crud->route = 'Ddvue.AdminPanel.menu';

        $this->crud->indexRecursive = true;
        $this->crud->title          = '后台菜单';
        $this->crud->viewName       = 'ddvue.adminpanel::pages.menu';
        $this->crud->setModel(DdvueMenu::class);

        $this->crud->setPermissionName('编辑 后台菜单');
        $this->crud->addQueryParam(new QueryParam('', '', '',
                                                  [
                                                      'title', 'index'
                                                  ],
                                                  [
                                                      'value' => 'title'
                                                  ]
                                   ));

        parent::setup();

    }

    public function getIndex()
    {
        $this->data['permissions'] = $this->permission->get()->toArray();

        return parent::getIndex();
    }


    public function indexJson()
    {
        $this->data = $this->crud->model->getAllByParentId();
        return parent::makeIndexJson();
    }

    public function getAdd()
    {
        $this->data['menus']       = $this->menu->getSelectArrayByParentId(0, true);
        $this->data['permissions'] = $this->permission->get()->toArray();
        $this->data['title']       = '增加' . $this->crud->title;

        return parent::getAdd();
    }

    public function postAdd(Request $request)
    {
        return parent::storeCrud($request);
    }

    public function getEdit($id)
    {
        $this->data['menus']       = $this->menu->getSelectArrayByParentId(0, true);
        $this->data['permissions'] = $this->permission->get()->toArray();
        $this->data['title']       = '编辑' . $this->crud->title;
        $this->data['data']        = $this->menu->find($id)->toArray();

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


    public function assignPermission(Request $request)
    {
        $data = $request->all();
        $role = $data['permission_id'];
        foreach ($data['selections'] as $selection) {

            $menu = $this->menu->find($selection['id']);

            $limits = $selection['limits'] ?? [];
            if (is_bool(collect($limits)->search($role))) {
                array_push($limits, $role);
                $menu->update(['limits' => $limits]);
            }
        }
    }


}