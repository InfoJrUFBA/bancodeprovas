<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Container;
use Core\Session;

class HomeController extends BaseController {

    public function index() {
        if($this->getSession()) {
            $this->view->login = Session::get('login');
        }
        if(Session::get('success')){
            $this->view->success = Session::get('success');
            Session::destroy('success');
        }
        if(Session::get('errors')){
            $this->view->errors = Session::get('errors');
            Session::destroy('errors');
        }
        $this->area = Container::getModel("Area");
        $this->view->areas = $this->area->all();

        $this->setPageTitle("Home");
        $this->renderView('home/index', 'layout');
    }
    public function forbiden() {
        return Redirect::route('/');
    }
}
