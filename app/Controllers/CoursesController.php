<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Container;

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
		$this->setPageTitle("Courses");
		$this->view->courses = $this->course->all();
		$this->renderView('courses/index', 'layout');
	}

	public function show($id) {
		$this->view->course = $this->course->findById($id);
		$this->setPageTitle("{$this->view->course->name}");
		$this->renderView('courses/show', 'layout');
	}

	public function create() {
		$this->getAreas();
		$this->setPageTitle('New Course');
		$this->renderView('courses/create', 'layout');
	}

	public function store($request) {
		$this->course->create($request->post->name, $request->post->type, $request->post->areas_id);
		Redirect::route("/courses");
	}

	public function edit($id) {
		$this->getAreas();
		$this->view->course = $this->course->findById($id);
		$this->setPageTitle("Edit Course - {$this->view->course->name}");
		$this->renderView('courses/edit', 'layout');
	}

	public function update($id, $request) {
		$this->view->course = $this->course->update($id, $request->post->name, $request->post->type, $request->post->areas_id);
		Redirect::route("/course/{$id}/show");
	}

	public function delete ($id) {
		$this->view->course = $this->course->delete($id);
		Redirect::route("/courses");
	}
}
