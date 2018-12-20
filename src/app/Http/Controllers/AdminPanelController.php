<?php

namespace DDVue\AdminPanel\app\Http\Controllers;

use App\Http\Controllers\Controller;
use DDVue\AdminPanel\app\Models\DdvueMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;


class AdminPanelController extends Controller
{
    /**
     * @var mixed
     */
    private $ddvueMenu;

    /**
     * AdminPanelController constructor.
     *
     */
    public function __construct()
    {

        $this->setMenuModel();
    }

    private function setMenuModel()
    {
        $model = config('ddvue.adminpanel.menu_model');
        if ($model instanceof Model) {
            $this->ddvueMenu     = $model;
        } else {
            if (!class_exists($model)) {
                $model = "\\App\\Models\\" . $model;
                if (!class_exists($model)) {
                    throw new \Exception('This model does not exist.', 404);
                }
            }
            $this->ddvueMenu     = new $model();
        }


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
            'menu_data'            => $this->getMenus(),
            'login_type'           => $this->getLoginType()
        ];

        return json_encode($config);
    }

    function getLoginType()
    {
        if (config('ddvue.adminpanel.auth.type') == 'mix') {
            return 'mix';
        } else if (config('ddvue.adminpanel.auth.type') == 'ldap') {
            return 'ldapOnly';
        } else if (config('ddvue.adminpanel.auth.type') == 'db') {
            return 'nameOnly';
        } else if (config('ddvue.adminpanel.auth.type') == 'mix' || config('ddvue.adminpanel.auth.type') == 'db') {
            return 'name';
        } else if (config('ddvue.adminpanel.auth.type') == 'mix' || config('ddvue.adminpanel.auth.type') == 'ldap') {
            return 'ldap';
        }

        return 'unknown';
    }

    public function changePassword()
    {
        $data = Auth::user();

        return view('ddvue.adminpanel::auth.changePassword', compact('data'));
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