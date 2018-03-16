<?php

    namespace App\Controllers;

    use Core\BaseController;
    use Core\Container;

    class ExamsController extends BaseController{

        public function __construct(){
            parent::__construct();
            $this->exam = Container::getModel("Exam");
        }

        public function index(){
            $this->setPageTitle('Provas');
            $this->view->exams = $this->exam->readAll();
            $this->renderView('/exams/index.phtml', 'layout.phtml');
        }

        public function show($id){
            $this->view->exam = $this->exam->readSingle($id);
            $this->setPageTitle('Prova');
            if ($this->view->exam->id){
                $this->renderView('/exams/show.phtml', 'layout.phtml');
            }else{
                $this->renderView('404.phtml');
            }
        }

        public function create(){
            $this->setPageTitle('Nova Prova');
            $this->renderView('exams/create.phtml', 'layout.phtml');
        }

        public function store($request){
            $this->exam->createExam("{$request->post->professor}", "{$request->post->period}", date('Y-m-d'), 1, "{$request->post->unit}");
            header("location: /exams");
        }

        public function edit($id){
            $this->view->exam = $this->exam->readSingle($id);
            $this->setPageTitle('Edição de prova');
            $this->renderView('exams/edit.phtml', 'layout.phtml');
        }

        public function update($id, $request){
            $this->exam->update("{$id}", "{$request->post->professor}", "{$request->post->period}", '1',"{$request->post->unit}");
            header("location: /exam/{$id}/show");
        }

        public function delete($id){
            $this->exam->deleteExam($id);
            header("location: /exams");
        }
    }
