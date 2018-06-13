<?php

    namespace App\Controllers;

    use Core\BaseController;
    use Core\Container;
    use Core\Redirect;
    use Core\Session;
    use Core\Auth;

    class ExamsController extends BaseController{

        public function __construct(){
            parent::__construct();
            $this->exam = Container::getModel("Exam");
            $this->user = Container::getModel("User");
        }

        public function getComponents(){
            $obj = new ComponentsController;
            $this->obj = $obj->component->all();
        }

        public function dataVerify($request){
            if( !empty($request->post->professor) && !empty($request->post->period) && !empty($request->post->components_id) && !empty($request->post->unit) ){
                return true;
            }else {
                return false;
            }
        }

        public function imageRedirect() {
            $file = $_FILES['image'];
            $fileName = $_FILES['image']['name'];
            //local atual do arquivo
            $fileTmpName = $_FILES['image']['tmp_name'];
            $fileSize = $_FILES['image']['size'];
            $fileError = $_FILES['image']['error'];
            $fileType = $_FILES['image']['type'];
            $fileExt= explode('.',$fileName);
            $fileActualExt= strtolower(end($fileExt));
            $allowed = array('jpg','jpeg','png','pdf');

            if(in_array($fileActualExt, $allowed)){
                if($fileError===0){
                    if($fileSize<(3*1024*1024)){

                        $fileNameNew= uniqid('',true).".".$fileActualExt;
                        $this->fileDestination = 'uploads/'.$fileNameNew;
                        move_uploaded_file( $fileTmpName,$this->fileDestination);
                        return true;

                    }else{
                        Session::set('errors', [
                            'Tamanho permitido excedido'
                        ]);
                        return false;
                    }
                }else{
                      Session::set('errors', [
                            'Falha no upload do arquivo'
                        ]);
                        return false;
                }
            }else{
                Session::set('errors', [
                            'Formato inválido'
                        ]);
                        return false;
            }
        }

        public function index(){
            $this->getSession();
            $this->setPageTitle('Provas');
            $this->view->exams = $this->exam->all();
            return $this->renderView('exams/index', 'layout');

        }

        public function show($id){
            $this->view->exam = $this->exam->readSingle($id);
            $this->setPageTitle('Prova');
            if ($this->view->exam->id){
                return $this->renderView('exams/show', 'layout');
            } else {
                return $this->renderView('404');
            }
        }

        public function create(){
            $this->getComponents();
            $this->setPageTitle('Nova Prova');
            return $this->renderView('exams/create', 'layout');
        }

        public function store($request){
            date_default_timezone_set("America/Bahia");

            if($this->dataVerify($request)){
                if($this->imageRedirect()){
                //if($img==1){
                    if( $this->exam->create("{$request->post->professor}", "{$request->post->period}", date('Y-m-d'), "{$request->post->components_id}", "{$request->post->unit}", Auth::id() ,"{$this->fileDestination}") ){
                        return Redirect::route("/exams", [
                            'success' => ['Prova enviada para moderação.']
                        ]);
                    } else {
                        return Redirect::route("/exams", [
                            'errors' => ['Erro ao inserir prova no banco de dados.']
                        ]);
                    }
                }else {
                Session::get('errors');
                return Redirect::route("/exams");
                }
            }else {
                return Redirect::route("/exams", [
                    'errors' => ['Há campos vazios.']
                ]);
            }
        }

        public function edit($id){
            $this->getComponents();
            $this->view->exam = $this->exam->readSingle($id);
            $this->periods = array("20111", "20112", "20121", "20122", "20131", "20132", "20141", "20142", "20151", "20152", "20161", "20162", "20171", "20172");
            $this->units = array("1ª Prova", "2ª Prova", "3ª Prova", "4ª Prova", "Segunda chamada da 1ª Prova", "Segunda chamada da 2ª Prova", "Segunda chamada da 3ª Prova", "Segunda chamada da 4ª Prova");
            $this->status = array("Pendente", "Aprovado");
            $this->setPageTitle('Edição de prova');
            Session::set('currentTestImage', $this->view->exam->image);
            return $this->renderView('exams/edit', 'layout');
        }

        public function update($id, $request){
            if($this->imageRedirect()){
                $testImage = $this->fileDestination;
            }else {
                $testImage = Session::get('currentTestImage');
            }
            Session::destroy('currentTestImage');

            if($this->dataVerify($request)){
                    if ($this->exam->update("{$id}", "{$request->post->professor}", "{$request->post->period}", "{$request->post->components_id}","{$request->post->status}","{$request->post->unit}","{$testImage}") ){
                        if($request->post->status > 1){
                            $this->points($id);
                        }
                        return Redirect::route("/exams", [
                            'success' => ['Prova atualizada com sucesso.']
                        ]);
                    }else {
                        return Redirect::route("/exams", [
                            'errors' => ['Erro ao atualizar.']
                        ]);
                    }
            }else {
                return Redirect::route("/exam/{$id}/edit", [
                    'errors' => ['Há campos vazios.']
                ]);
            }
        }

        public function points($id){
            $userId = $this->exam->readSingle($id)->creator_id;
            $this->user->updatePointsExam($userId);
        }

        public function delete($id){
            if($this->exam->deleteExam($id)){
                return Redirect::route("/exams");
            }else {
                return Redirect::route("/exams", [
                    'errors' => ['Erro ao deletar.']
                ]);
            }
        }

        public function forbiden(){
            return Redirect::route('/');
        }
    }
