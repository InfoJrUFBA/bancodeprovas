<?php

    namespace App\Controllers;

    include "../vendor/autoload.php";

    use Core\BaseController;
    use Core\Container;
    use Core\Redirect;
    use Core\Session;
    use Core\Email;
    use Core\Auth;

    class UsersController extends BaseController
    {
        private $user;

        public function dateConvert($request){
            return date('Y-m-d',strtotime($request->post->birthdate));
        }

        public function passwordHash($pswd){
            $hashedPswd = password_hash($pswd, PASSWORD_DEFAULT);
            return $hashedPswd;
        }

        public function __construct(){
            parent::__construct();
            $this->user = Container::getModel("User");
        }

        public function getCourses(){
            $obj = new CoursesController;
            $this->obj = $obj->course->all();
        }

        public function updateVerify($id, $request){
            $this->info = $this->user->findById($id);
            if( !($request->post->name == $this->info->name) || !($request->post->email == $this->info->email) || !($request->post->image == $this->info->image) || !($this->dateConvert($request) == $this->info->birthdate) || !($request->post->courses_id == $this->info->courses_id)){
                return true;
            }else {
                return false;
            }
        }

        public function newEmailVerify($request, $id=null){
            $this->information = $this->user->all();
            $newEmail = 1;

            if( filter_var($request->post->email, FILTER_VALIDATE_EMAIL) ){
                foreach ($this->information as $allUsers) {
                    if( $allUsers->id == $id ){
                        continue;
                    }
                    if($allUsers->email == $request->post->email){
                        $newEmail = 0;
                    }
                }
            }else {
                return Session::set('errors', [
                    'O campo email não é válido.'
                ]);
            }

            if($newEmail){
                return true;
            }else {
                return false;
            }
        }

        public function dataInsertionVerify($request){
            if( !empty($request->post->name) && !empty($request->post->email) && !empty($request->post->birthdate) && !empty($request->post->courses_id) && !empty($request->post->password) ){
                return true;
            }else {
                return false;
            }
        }

        public function index(){
            if(Session::get('success')){
                $this->view->success = Session::get('success');
                Session::destroy('success');
            }
            if(Session::get('errors')){
                $this->view->errors = Session::get('errors');
                Session::destroy('errors');
            }
            $this->setPageTitle('Users');
            $this->view->users = $this->user->all();
            return $this->renderView('/users/index', 'layout');
        }

        public function show($id){
            $this->view->users = $this->user->findById($id);
            $this->setPageTitle("{$this->view->users->name}");
            return $this->renderView('/users/FindById', 'layout');
        }

        public function create(){
            if(Session::get('errors')){
                $this->view->errors = Session::get('errors');
                Session::destroy('errors');
            }
            $this->getCourses();
            $this->setPageTitle('Novo Usuário');
            return $this->renderView('/users/create', 'layout');
        }

        public function store($request){

            if ($this->dataInsertionVerify($request)){
                if( (strlen($request->post->password) >= 5) && (strlen($request->post->password) <=10 ) ){
                    if ($this->newEmailVerify($request)) {
                        if ($request->post->password == $request->post->password_confirmation) {
                            if($this->user->create("{$request->post->name}", "{$request->post->email}", "{$this->passwordHash($request->post->password)}", "{$request->post->image}", "{$this->dateConvert($request)}", "{$request->post->courses_id}")){
                                return Redirect::route("/users", [
                                    'success' => ['Novo usuário cadastrado, por favor cheque sua caixa de email para a verificação de sua conta.']
                                ]);
                                Email::send("{$request->post->name}","{$request->post->email}");
                            }else {
                                return Redirect::route("/users", [
                                    'errors' => ['Erro ao criar novo usuário.']
                                ]);
                            }
                        }else {
                            return Redirect::route("/user/create", [
                                'errors' => ['Senhas inseridas apresentam discordância.']
                            ]);
                        }
                    }else {
                        if(Session::get('errors')){
                            return Redirect::route("/user/create", ['errors']);
                        }else{
                            return Redirect::route("/user/create", [
                                'errors' => ['Email já cadastrado, por favor insira outro email válido.']
                            ]);
                        }
                    }
                }else{
                    return Redirect::route("/user/create", [
                        'errors' => ['Sua senha deve conter entre 5 e 10 caracteres.']
                    ]);
                }
            }else{
                return Redirect::route("/user/create", [
                    'errors' => ['Há campos vazios.']
                ]);
            }
        }
        public function edit($id){
            if(Session::get('errors')){
                $this->view->errors = Session::get('errors');
                Session::destroy('errors');
            }
            $this->getCourses();
            $this->view->user = $this->user->findById($id);
            $this->setPageTitle('Edit user - ' . $this->view->user->name);
            return $this->renderView('users/edit' , 'layout');
        }

        public function update($id, $request){

            $this->info = $this->user->findById($id);

            if ($this->dataInsertionVerify($request)){
                if( password_verify ($request->post->password, $this->info->password) ){
                    if($this->newEmailVerify($request, $id)){
                        if( isset($request->post->new_password) ){
                            if( (strlen($request->post->new_password) >= 5) && (strlen($request->post->new_password) <=10 ) ){
                                if($request->post->new_password == $request->post->new_password_confirmation){
                                    if( $this->user->update("{$id}", "{$request->post->name}", "{$request->post->email}", "{$this->passwordHash($request->post->new_password)}", "{$request->post->image}", "{$this->dateConvert($request)}", "{$request->post->courses_id}") ){
                                        return Redirect::route("/user/{$id}/show", [
                                            'success' => ['Informações atualizadas com sucesso.']
                                        ]);
                                    }else {
                                        return Redirect::route("/users", [
                                            'errors' => ['Erro ao alterar usuário.']
                                        ]);
                                    }
                                }else {
                                    return Redirect::route("/users", [
                                        'errors' => ['Senhas inseridas discordantes.']
                                    ]);
                                }
                            }else{
                                return Redirect::route("/user/create", [
                                    'errors' => ['Sua nova senha deve conter entre 5 e 10 caracteres.']
                                ]);
                            }
                        }else{
                            if($this->updateVerify($id,$request)){
                                if( $this->user->update("{$id}", "{$request->post->name}", "{$request->post->email}", "{$this->passwordHash($request->post->password)}", "{$request->post->image}", "{$this->dateConvert($request)}", "{$request->post->courses_id}") ){
                                    return Redirect::route("/user/{$id}/show", [
                                        'success' => ['Informações atualizadas com sucesso.']
                                    ]);
                                }else{
                                    return Redirect::route("/users", [
                                        'errors' => ['Erro ao alterar usuário.']
                                    ]);
                                }
                            }
                        }
                    }else {
                        if(Session::get('errors')){
                            return Redirect::route("/user/{$id}/edit", ['errors']);
                        }else{
                            return Redirect::route("/user/create", [
                                'errors' => ['Email já cadastrado, por favor insira outro email válido.']
                            ]);
                        }
                    }
                }else {
                    return Redirect::route("/users", [
                        'errors' => ['Senha incorreta.']
                    ]);
                }
            }else{
                return Redirect::route("/user/create", [
                    'errors' => ['Há campos vazios.']
                ]);
            }
        }


        public function auth($request)
        {
            if(!empty($request->post->email) && !empty($request->post->password)){

                    $result= $this->user->where($request->post->email);

                    if($result && password_verify($request->post->password, $result->password)){
                        $login = [
                            'id' => $result->id,
                            'name' => $result->name,
                            'email' => $result->email,
                            'level'=>$result->level
                        ];

                        Session::destroy('errors');
                        Session::set('login', $login);

                        return Redirect::route('/users');

                    }

                }else{

                return Redirect::route('/users', [
                     'errors' => ['Os Campos devem ser preenchidos']
                    ]);
            }

        }


        public function logout()
        {
            Session::destroy('login');
            return Redirect::route('/');
        }


        public function delete($id){
            if($this->user->delete($id)){
                return Redirect::route('/users');
            }else{
                return Redirect::route("/users", [
                    'errors' => ['Erro ao excluir usuário.']
                ]);
            }
        }

        public function forbiden()
        {
        return Redirect::route('/');
        }
  }
