<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Container;
use Core\Redirect;
use Core\Session;

class ComponentsController extends BaseController {
    public function __construct() {
        parent::__construct();
        $this->component = Container::getModel("Component");
    }

    public function index() {
        $this->getSession();
        $this->setPageTitle("Components");
        $this->view->components = $this->component->all();
        return $this->renderView('components/index', 'layout');
    }

    public function create() {
        $this->setPageTitle("Components - Create");
        return $this->renderView('components/create', 'layout');
    }
    public function store($request) {
        if($this->component->create($request->post->code, $request->post->name)){
            return Redirect::route("/components", [
                'success' => ['Disciplina criada com sucesso.']
            ]);
        } else {
            return Redirect::route("/components", [
                'errors' => ['Erro ao inserir disciplina no banco de dados.']
            ]);
        }
    }

    public function show($id) {
        $exam = Container::getModel("Exam");
        $this->view->exam = $exam->readByComponent($id);

        $this->view->component = $this->component->readById($id);
        $this->setPageTitle("Component - {$this->view->component->name}");
        return $this->renderView('components/show', 'layout');
    }

    public function edit($id) {
        $this->view->component = $this->component->readById($id);
        $this->setPageTitle("Edit - {$this->view->component->name}");
        return $this->renderView('components/edit', 'layout');
    }
    public function update($id, $request) {
        if($this->component->update($id, $request->post->code, $request->post->name)){
            return Redirect::route("/component/{$id}/show", [
                'success' => ['Disciplina atualizada com sucesso.']
            ]);
        }else {
            return Redirect::route("/components", [
                'errors' => ['Falha ao atualizar disciplina.']
            ]);
        }
    }

    public function delete($id) {
        if($this->component->delete($id)){
            return Redirect::route("/components");
        }else {
            return Redirect::route("/components", [
                'errors' => ['Falha ao deletar disciplina.']
            ]);
        }
    }
    public function forbiden()
    {
        return Redirect::route('/');
    }

    public function search($request){
        $this->view->components = $this->component->search($request->post->search);
        switch (count($this->view->components)) {
            case 1:
                return Redirect::route("/component/{$this->view->components[0]->id}/show");
                break;

            default:
                $this->setPageTitle("Busca - {$request->post->search}");
                return $this->renderView('components/search', 'layout');
                break;
        }
    }
}
