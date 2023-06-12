<?php

    namespace Controllers;
    use Models\User;
    use Lib\Pages;
    use Utils\Utils;

    class UserController{
        private Pages $pages;


        public function __construct(){
            $this->pages = new Pages();
        }


        public function login(){
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                if($_POST['data']){
                    $datos_base = $_POST['data'];

                    $datos = array();

                    foreach($datos_base as $clave => $valor) {
                        $datos[$clave] = filter_var($valor, FILTER_SANITIZE_STRING);
                    }

                    $usuario = User::fromArray($datos);

                    $login = $usuario->login();

                    // Session Created For User.
                    if($login && is_object($login)){
                        $_SESSION['identity'] = $login;

                        if($login->rol == 'admin'){
                            $_SESSION['admin'] = true;
                        }
                        if(isset($_SESSION['error_login'])){
                            unset($_SESSION['error_login']);
                        }
                        
                        header("Location:" . $_ENV['BASE_URL'].'home');
                    }else{
                        $_SESSION['error_login'] = 'Identificación Fallida';
                    }
                }
            }else if($_SERVER['REQUEST_METHOD'] === 'GET'){
                $this->pages->render('Usuario/formulario_login');
            }
            
        }

        public function signin(){
            if($_SERVER['REQUEST_METHOD'] === 'GET'){

                $this->pages->render('Usuario/formulario_signin');

            } else if($_SERVER['REQUEST_METHOD'] === 'POST'){
                if ($_POST['data']){
                    // The variable $register has all the data from the user of the register.
                    $register_base = $_POST['data'];

                    $register = array();

                    foreach($register_base as $clave => $valor) {
                        $register[$clave] = filter_var($valor, FILTER_SANITIZE_STRING);
                    }

                    // Encrypt the password to put it inside de BBDD
                    $register['password'] = password_hash($register['password'], PASSWORD_BCRYPT, ['cost'=>4]);

                    $usuario = User::fromArray($register);

                    $signin = $usuario->signin();

                    if($signin){
                        $_SESSION['register'] = "complete";
                        $this->pages->render('Usuario/formulario_login');
                    } else{
                        $_SESSION['register'] = "failed";
                        $this->pages->render('Usuario/formulario_signin');
                    }
                }else{
                    $_SESSION['register'] = "failed";
                    $this->pages->render('Usuario/formulario_signin');
                }
            }
            

        }

        public function logout(){
            if($_SERVER['REQUEST_METHOD'] === 'GET'){
                if(isset($_SESSION['identity'])){
                    unset($_SESSION['identity']);
                }
    
                if(isset($_SESSION['admin'])){
                    unset($_SESSION['admin']);
                }
                
            }
            header("Location: ".$_ENV['BASE_URL']);
        }


        public function admin_users(){
            Utils::isAdmin();

            if($_SERVER['REQUEST_METHOD'] === 'GET'){
                $this->pages->render('Usuario/admin_users');
            }
        }


        public function user_delete($id){
            Utils::isAdmin();

            if($_SERVER['REQUEST_METHOD'] === 'GET') {

                $user = new User('','','','','','','');
                
                $eliminado = $user->delete($id);
				
				if($eliminado){
					$this->pages->render('Usuario/admin_users');
				}else{
					$this->pages->render('Usuario/admin_users', ["error" => "No se ha podido eliminar el usuario."]);
				}


                $this->pages->render('Usuario/admin_users');
                // header('Location:'. $_ENV['BASE_URL']."admin_users");
                
            }
        }

        public function user_edit($id = null) {
            Utils::isAdmin();
            
            if($_SERVER['REQUEST_METHOD'] === 'GET') {

                $this->pages->render('Usuario/user_edit', ['id' => $id]);

            }else if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
                $data_user = $_POST['data'];

                $user = new User('','','','','','','');
                $edit = $user->edit($data_user);

                if(!$edit) {
                    $this->pages->render('Usuario/admin_users', ["error" => "No se ha podido editar el usuario."]);
                }else{
                    header('Location:'.$_ENV['BASE_URL'].'admin_users');
                }
            }
        }



    }




