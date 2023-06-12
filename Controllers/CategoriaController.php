<?php

    namespace Controllers;
    use Models\Categoria;
    use Lib\Pages;
    use Utils\Utils;

    class CategoriaController {
        private Pages $pages;


        public function __construct() {
            $this->pages = new Pages();
        }

        public function admin_categoria(){
            Utils::isAdmin();

            if($_SERVER['REQUEST_METHOD'] === 'GET'){

                // $categoria = new Categoria();
                // $categorias = $categoria->getAll();
                // $this->pages->render('Categoria/admin_categoria', ['categorias' => $categorias]);
                $this->pages->render('Categoria/admin_categoria');

            }
        }

        public function categoria_create(){
            Utils::isAdmin();

            if($_SERVER['REQUEST_METHOD'] === 'GET') {

                $this->pages->render('Categoria/categoria_crear');

            }elseif($_SERVER['REQUEST_METHOD'] === 'POST') {

                $data_categoria = $_POST['data'];

                $categoria = new Categoria();

                $guardado = $categoria->save($data_categoria);

                if ($guardado) {
                    // $categoria = new Categoria();
                    // $categorias = $categoria->getAll();
        
                    // $this->pages->render('Categoria/admin_categoria', ['categorias' => $categorias]);
        
                    $this->pages->render('Categoria/admin_categoria');
                }else{
                    $this->pages->render('Categoria/categoria_crear', ['error' => "La Categoria no ha sido Creada."]);
                }
            }
        }
    
        public function categoria_delete($id){
            Utils::isAdmin();

            if($_SERVER['REQUEST_METHOD'] === 'GET') {

                $categoria = new Categoria();
                $eliminado = $categoria->delete($id);

                if ($eliminado){
                    header('Location: ' . $_ENV['BASE_URL']. "admin_categoria");
                }else{
                    $_SESSION['error'] = "La categoria ".$id." no ha sido eliminada.";
                    header('Location:'. $_ENV['BASE_URL']."admin_categoria");
                }                
            }
        }

        public function categoria_edit($id = null){
            Utils::isAdmin();

            if($_SERVER['REQUEST_METHOD'] === 'GET') {

                $this->pages->render('Categoria/categoria_editar', ['id' => $id]);

            }elseif($_SERVER['REQUEST_METHOD'] === 'POST'){

                $data_categoria = $_POST['data'];
                
                $categoria = new Categoria();
                $editado = $categoria->edit($data_categoria);

                if($editado) {
                    header('Location: '. $_ENV['BASE_URL']."admin_categoria");
                }else{
                    $_SESSION['error'] = "La categoria ".$id." no ha sido editada.";
                    header('Location: '. $_ENV['BASE_URL']."admin_categoria");
                }

            }
        }

    }