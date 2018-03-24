<?php

    namespace App\Controllers;

    use Core\BaseController;
    use Core\Container;
    use Core\Redirect;

    class UsersController extends BaseController
    {
        private $user;

        public function dateConvert($request){
            return date('Y-m-d',strtotime($request->post->birthdate));
        }

        public function passwordHash($request){
            $hashedPswd = password_hash($request->post->password, PASSWORD_DEFAULT);
            return $hashedPswd;
        }

        public function __construct(){
            parent::__construct();
            $this->user = Container::getModel("User");
        }

        public function index(){
            $this->setPageTitle('Users');
            $this->view->users = $this->user->all();
            $this->renderView('/users/index', 'layout');
        }

        public function show($id){
            $this->view->users = $this->user->findById($id);
            $this->setPageTitle("{$this->view->users->name}");
            $this->renderView('/users/FindById', 'layout');
        }

        public function create(){
            $this->setPageTitle('Novo Usuário');
            $this->renderView('/users/create', 'layout');
        }

        public function store($request){
            if($this->user->create("{$request->post->name}", "{$request->post->email}", "{$this->passwordHash($request)}", "{$request->post->image}", "{$this->dateConvert($request)}", "{$request->post->courses_id}")){
                Redirect::route("/users");
            }else{
                echo "Não foi possivel criar usuário!";
            }
        }
        public function edit($id){
            $this->view->user = $this->user->findById($id);
            $this->setPageTitle('Edit user - ' . $this->view->user->name);
            $this->renderView('users/edit' , 'layout');
        }

        public function update($id, $request){
            if($this->user->update("$id", "{$request->post->name}", "{$request->post->email}", "{$request->post->password}", "{$request->post->image}", "{$this->dateConvert($request)}", "{$request->post->courses_id}")){
                Redirect::route("/users");
            }else{
                echo "Não foi possivel atualizar usuário!";
            }
        }

        public function delete($id){
            if($this->user->delete($id)){
                Redirect::route('/users');
            }else{
                echo "Erro ao excluir usuário!";
            }
        }
  }
