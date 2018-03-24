<?php

    namespace App\Controllers;

    use Core\BaseController;
    use Core\Container;
    use Core\Redirect;

    class ExamsController extends BaseController{

        public function __construct(){
            parent::__construct();
            $this->exam = Container::getModel("Exam");
        }

        public function getComponents(){
            $obj = new ComponentsController;
            $this->obj = $obj->component->all();
        }

        public function index(){
            $this->setPageTitle('Provas');
            $this->view->exams = $this->exam->all();
            $this->renderView('exams/index', 'layout');
        }

        public function show($id){
            $this->view->exam = $this->exam->readSingle($id);
            $this->setPageTitle('Prova');
            if ($this->view->exam->id){
                $this->renderView('exams/show', 'layout');
            } else {
                $this->renderView('404');
            }
        }

        public function create(){
            $this->getComponents();
            $this->setPageTitle('Nova Prova');
            $this->renderView('exams/create', 'layout');
        }

        public function store($request){
            date_default_timezone_set("America/Bahia");
            $this->exam->createExam("{$request->post->professor}", "{$request->post->period}", date('Y-m-d'), "{$request->post->components_id}", "{$request->post->unit}");
            Redirect::route("/exams");
        }

        public function edit($id){
            $this->getComponents();
            $this->view->exam = $this->exam->readSingle($id);
            $this->setPageTitle('Edição de prova');
            $this->renderView('exams/edit', 'layout');
        }

        public function update($id, $request){
            $this->exam->update("{$id}", "{$request->post->professor}", "{$request->post->period}", "{$request->post->components_id}","{$request->post->unit}");
            Redirect::route("/exam/{$id}/show");
        }

        public function delete($id){
            $this->exam->deleteExam($id);
            Redirect::route("/exams");
        }
    }
