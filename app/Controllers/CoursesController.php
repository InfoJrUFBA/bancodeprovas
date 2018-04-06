<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Container;
use Core\Redirect;
use Core\Session;

class CoursesController extends BaseController {

	public function __construct() {
		parent::__construct();
		$this->course = Container::getModel("Course");
	}

	public function getAreas(){
		$obj = new AreasController;
		$this->obj = $obj->area->all();
	}

	public function index () {
		$this->getSession();
		$this->setPageTitle("Courses");
		$this->view->courses = $this->course->all();
		return $this->renderView('courses/index', 'layout');
	}

	public function show($id) {
		$components = Container::getModel("Component");
		$this->view->components = $components->readByCourse($id);

		$this->view->course = $this->course->findById($id);
		$this->setPageTitle("{$this->view->course->name}");
		return $this->renderView('courses/show', 'layout');
	}

	public function create() {
		$this->getAreas();
		$this->setPageTitle('New Course');
		return $this->renderView('courses/create', 'layout');
	}

	public function store($request) {
		if($this->course->create($request->post->name, $request->post->type, $request->post->areas_id)){
			return Redirect::route("/courses", [
				'success' => ['Curso adicionado com sucesso.']
			]);
		}else {
			return Redirect::route("/courses", [
				'errors' => ['Erro ao inserir curso no banco de dados.']
			]);
		}
	}

	public function edit($id) {
		$this->getAreas();
		$this->view->course = $this->course->findById($id);
		$this->setPageTitle("Edit Course - {$this->view->course->name}");
		return $this->renderView('courses/edit', 'layout');
	}

	public function update($id, $request) {
		if( $this->view->course = $this->course->update($id, $request->post->name, $request->post->type, $request->post->areas_id) ){
			return Redirect::route("/course/{$id}/show", [
				'success' => ['Curso alterado com sucesso.']
			]);
		}else {
			return Redirect::route("/courses", [
				'errors' => ['Erro ao editar curso no banco de dados.']
			]);
		}
	}

	public function delete ($id) {
		if($this->view->course = $this->course->delete($id)){
			return Redirect::route("/courses");
		}else {
			return Redirect::route("/courses", [
				'errors' => ['Erro ao deletar.']
			]);
		}
	}
	public function forbiden()
    {
        return Redirect::route('/');
    }
}
