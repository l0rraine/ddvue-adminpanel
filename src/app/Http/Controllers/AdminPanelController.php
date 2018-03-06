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
            'auth'                 => Auth::user(),
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
    }

}