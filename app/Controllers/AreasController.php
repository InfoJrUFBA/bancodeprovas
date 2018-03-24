<?php
namespace App\Controllers;

use Core\BaseController;
use Core\Container;
use Core\Redirect;

class AreasController extends BaseController {
    public function __construct() {
        parent::__construct();
        $this->area = Container::getModel("Area");
    }

    public function index () {
        $this->setPageTitle("Areas");
        $this->view->areas = $this->area->all();
        $this->renderView('areas/index', 'layout');
    
    }

    public function show($id) {
        $this->view->area = $this->area->findById($id);
        $this->setPageTitle("Area - {$this->view->area->name}");
        $this->renderView('areas/show', 'layout');
    }

    public function create() {
        $this->setPageTitle('New Area');
        $this->renderView('areas/create', 'layout');
    }

    public function store($request) {
        $this->area->create($request->post->name);
        Redirect::route("/areas");
    }

    public function edit($id) {
        $this->view->area = $this->area->findById($id);
        $this->setPageTitle("Edite Area - {$this->view->area->name}");
        $this->renderView('areas/edit', 'layout');
    }

    public function update($id, $request) {
        $this->area->update($id, $request->post->name);
        Redirect::route("/area/{$id}/show");
    }

    public function delete ($id) {
        $this->area->delete($id);
        Redirect::route("/areas");
    }
}