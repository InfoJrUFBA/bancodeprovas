<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Container;

class HomeController extends BaseController {

    public function index() {
        $this->area = Container::getModel("Area");
        $this->view->areas = $this->area->all();

        $this->setPageTitle("Home");
        $this->renderView('home/index', 'layout');
    }
}