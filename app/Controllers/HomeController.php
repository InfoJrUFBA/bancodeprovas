<?php

namespace App\Controllers;

use Core\BaseController;

class HomeController extends BaseController {

    public function index() {
    	if(Session::get('login')){
            $this->view->login=Session::get('login');
        }
        $this->setPageTitle("Home");
        $this->renderView('home/index', 'layout');
    }
    public function forbiden()
    {
        return Redirect::route('/');
    }
}