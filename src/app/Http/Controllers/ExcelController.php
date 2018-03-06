<?php

namespace DDVue\AdminPanel\app\Http\Controllers;

use App\Http\Controllers\Controller;
use DDVue\AdminPanel\app\Models\DdvueMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ExcelController extends Controller
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
        return view('ddvue.adminpanel::pages.excel.upload');
    }

}