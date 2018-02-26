<?php

namespace DDVue\AdminPanel\app\Http\Controllers;

use App\Http\Controllers\Controller;
use DDVue\AdminPanel\app\Models\DdvueMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminPanelController extends Controller
{
    /**
     * @var DdvueMenu
     */
    private $ddvueMenu;

    /**
     * AdminPanelController constructor.
     *
     * @param DdvueMenu $ddvueMenu
     */
    public function __construct(DdvueMenu $ddvueMenu)
    {
        $this->ddvueMenu = $ddvueMenu;
    }

    public function getIndex()
    {
        return view('ddvue.adminpanel::index');
    }

    public function getSettingsJson()
    {
        $config = [
            'dashboard_name'       => config('ddvue.adminpanel.dashboard_name'),
            'dashboard_url_prefix' => config('ddvue.adminpanel.url_prefix'),
            'auth'                 => (new \App\Models\User())->find(1), //Auth::check()? Auth::user():null,
            'menu_data'            => $this->getMenus()
        ];

        return json_encode($config);
    }

    public function logout(Request $request)
    {
        Auth::guard($this->get_guard())->logout();
        $request->session()->invalidate();
    }

    function get_guard()
    {
        if (Auth::guard('ddvue_db')->check()) {
            return "ddvue_db";
        } else if (Auth::guard('ddvue_ldap')->check()) {
            return "ddvue_ldap";
        } else {
            return "";
        }
    }

    private function getMenus()
    {
        $menu = $this->ddvueMenu->getSelectArrayByParentId();

        return $menu;
//            [
//                [
//                    'title'    => '业务模块',
//                    'type'     => 'submenu',
//                    'icon'     => 'el-icon-menu',
//                    'index'    => '1',
//                    'children' => [
//                        [
//                            'title'    => '文章管理',
//                            'type'     => 'group',
//                            'index'    => '1-1',
//                            'children' => [
//                                [
//                                    'title' => '分类1',
//                                    'index' => '/test',
//                                    'type'  => 'item'
//                                ],
//                                [
//                                    'title' => '分类2',
//                                    'index' => 'yyy',
//                                    'type'  => 'item'
//                                ]
//                            ]
//                        ],
//                        [
//                            'title'    => '业务模块2',
//                            'type'     => 'submenu',
//                            'icon'     => 'el-icon-menu',
//                            'index'    => '3',
//                            'children' => [
//                                [
//                                    'title' => '分类3',
//                                    'index' => 'zzz',
//                                    'type'  => 'item'
//                                ]
//                            ]
//                        ]
//                    ]
//                ],
//                [
//                    'title'    => '管理模块',
//                    'type'     => 'submenu',
//                    'icon'     => 'el-icon-setting',
//                    'index'    => '2',
//                    'children' => [
//                        [
//                            'title'    => '用户权限',
//                            'type'     => 'group',
//                            'index'    => '2-1',
//                            'children' => [
//                                [
//                                    'title' => '用户管理',
//                                    'index' => 'xxxx',
//                                    'type'  => 'item'
//                                ],
//                                [
//                                    'title' => '权限管理',
//                                    'index' => 'yyy',
//                                    'type'  => 'item'
//                                ]
//                            ]
//                        ]
//                    ]
//                ]
//
//
//            ];
    }

}