<?php

namespace DDVue\AdminPanel\app\Http\Controllers;

use App\Http\Controllers\Controller;


class AdminPanelController extends Controller
{

    public function getIndex()
    {
        return view('ddvue.adminpanel::index');
    }

}