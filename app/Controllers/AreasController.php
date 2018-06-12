<?php
namespace App\Controllers;

use Core\BaseController;
use Core\Container;
use Core\Redirect;
use Core\Session;

class AreasController extends BaseController {
    public function __construct() {
        parent::__construct();
        $this->area = Container::getModel("Area");
    }

    public function index () {
        $this->getSession();
        $this->setPageTitle("Areas");
        $this->view->areas = $this->area->all();
        return $this->renderView('areas/index', 'layout');
    }

    public function show($id) {
        $this->courses = Container::getModel("Course");
        $this->view->courses = $this->courses->findByArea($id);
        $this->view->areas = $this->area->findById($id);
        if($this->view->areas){
            $this->setPageTitle("Area - {$this->view->area->name}");
            return $this->renderView('areas/show', 'layout');
        }else{
            return $this->renderView('404');
        }
    }

    public function create() {
        $this->setPageTitle('New Area');
        return $this->renderView('areas/create', 'layout');
    }

    public function store($request) {
        if($this->area->create($request->post->name)){
            return Redirect::route("/areas", [
                'success' => ['Sucesso em acrescentar área']
            ]);
        }else {
            return Redirect::route("/areas", [
                'errors' => ['Erro ao inserir nova área no banco de dados.']
            ]);
        }
    }

    public function edit($id) {
        $this->view->area = $this->area->findById($id);
        $this->setPageTitle("Edite Area - {$this->view->area->name}");
        return $this->renderView('areas/edit', 'layout');
    }

    public function update($id, $request) {
        if($this->area->update($id, $request->post->name)){
            return Redirect::route("/area/{$id}/show", [
                'success' => ['Área atualizada com sucesso.']
            ]);
        }else {
            return Redirect::route("/areas", [
                'errors' => ['Erro ao atualizar.']
            ]);
        }
    }

    public function delete($id) {
        if($this->area->delete($id)){
            return Redirect::route("/areas");
        }else {
            return Redirect::route("/areas", [
                'errors' => ['Erro ao excluir.']
            ]);
        }
    }
     public function forbiden()
    {
        return Redirect::route('/');
    }
}
