<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Container;

class ComponentsController extends BaseController {
    public function __construct() {
        parent::__construct();
        $this->component = Container::getModel("Component");
    }

    public function index() {
        $this->setPageTitle("Components");
        $this->view->components = $this->component->readAll();
        $this->renderView('components/index', 'layout');
    }

    public function create() {
        $this->setPageTitle("Components - Create");
        $this->renderView('components/create', 'layout');
    }
    public function store($request) {
        $this->component->create($request->post->code, $request->post->name);
        header("location: /components");
    }

    public function show($id) {
        $this->view->component = $this->component->readById($id);
        $this->setPageTitle("Component - {$this->view->component->name}");
        $this->renderView('components/show', 'layout');
    }

    public function edit($id) {
        $this->view->component = $this->component->readById($id);
        $this->setPageTitle("Edit - {$this->view->component->name}");
        $this->renderView('components/edit', 'layout');
    }
    public function update($id, $request) {
        $this->component->update($id, $request->post->code, $request->post->name);
        header("location: /component/{$id}/show");
    }

    public function delete($id) {
        $this->component->delete($id);
        header("location: /components");
    }
}
