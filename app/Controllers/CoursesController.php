<?php
namespace App\Controllers;

use Core\BaseController;
use Core\DataBase;
use App\Models\Course;
use Core\Container;

class CoursesController extends BaseController 
{
	
	public function index ()
	{
		$this->setPageTitle("Courses");
		$model = Container::getModel("Course");
		$this->view->courses = $model->all();
		$this->renderView('courses/index', 'layout');
	
	}

	public function show($id) {
		$model = Container::getModel("Course");
		$this->view->course= $model->findById($id);
		$this->setPageTitle("{$this->view->course->name}");
		$this->renderView('courses/show', 'layout');
	}

	public function create() 
	{
		$this->setPageTitle('New Course');
		$this->renderView('courses/create', 'layout');
	}

	public function store($request)
	{
		
		$model = Container::getModel("Course");
		$model->create($request->post->name, $request->post->type, 2);
		$this->renderView('courses/index', 'layout');
		
	}

	public function edit($id)
	{	
		$model = Container::getModel("Course");
		$this->view->course= $model->findById($id);
		$this->setPageTitle("Edite Course - {$this->view->course->name}");
		$this->renderView('courses/edit', 'layout');
	}

	public function update($id, $request) 
	{
		$model = Container::getModel("Course");
		$this->view->course=$model->update($id, $request->post->name, $request->post->type,2);
		header("location:/course/{$id}/show");
	}

	public function delete ($id) 
	{
		$model = Container::getModel("Course");
		$this->view->course=$model->delete($id);
		$this->renderView('courses/index', 'layout');
	}




}

