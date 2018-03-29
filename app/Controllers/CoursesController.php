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

		if(Session::get('login')){
            $this->view->login=Session::get('login');
        }
		if(Session::get('success')){
			$this->view->success = Session::get('success');
			Session::destroy('success');
		}
		if(Session::get('errors')){
			$this->view->errors = Session::get('errors');
			Session::destroy('errors');
		}
		$this->setPageTitle("Courses");
		$this->view->courses = $this->course->all();
		return $this->renderView('courses/index', 'layout');
	}

	public function show($id) {
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
