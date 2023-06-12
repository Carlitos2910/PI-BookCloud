<?php

    namespace Controllers;
    use Models\Autor;
    use Lib\Pages;
    use Utils\Utils;
    use PDO;

    class AutorController {
        private Pages $pages;


        public function __construct() {
            $this->pages = new Pages();
        }

        public function admin_autor(){
            Utils::isAdmin();

            if($_SERVER['REQUEST_METHOD'] === 'GET') {

                $this->pages->render('Autor/admin_autor');

            }
        }

        public function autor_create() {
            Utils::isAdmin();

            if($_SERVER['REQUEST_METHOD'] === 'GET') {

                $this->pages->render('Autor/autor_crear');

            }else if($_SERVER['REQUEST_METHOD'] === 'POST') {

                $data_autor = $_POST['data'];
                
                $autor = new Autor();
                $guardado = $autor->save($data_autor);

                if($guardado) {
                    $this->pages->render('Autor/admin_autor');
                }else{
                    $this->pages->render('Autor/autor_crear', ['error' => "El Autor no ha sido Creado."]);
                }

            }
        }

        public function autor_delete($id = null) {
            Utils::isAdmin();

            if($_SERVER['REQUEST_METHOD'] === 'GET') {

                $autor = new Autor();
                $eliminado = $autor->delete($id);

                if ($eliminado) {
                    header('Location: ' . $_ENV['BASE_URL']."admin_autor");
                }else {
                    $_SESSION['error'] = "El autor ".$id." no ha sido eliminado.";
                    header('Location: ' . $_ENV['BASE_URL']."admin_autor");
                }   
            }
        }

        public function autor_edit($id = null) {
            Utils::isAdmin();

            if($_SERVER['REQUEST_METHOD'] === 'GET') {

                $this->pages->render('Autor/autor_edit', ['id' => $id]);

            }else if($_SERVER['REQUEST_METHOD'] === 'POST') {

                $data_autor = $_POST['data'];

                $autor = new Autor();
                $editado = $autor->edit($data_autor);

                if($editado) {
                    header('Location: '. $_ENV['BASE_URL']."admin_autor");
                }else{
                    $_SESSION['error'] = "El autor ".$id." no ha sido editado.";
                    header('Location: '. $_ENV['BASE_URL']."admin_autor");
                }

            }
        }

        public function autores() {

            if($_SERVER['REQUEST_METHOD'] === 'GET') {
                $this->pages->render('Autor/ver_autores');
            } else if($_SERVER['REQUEST_METHOD'] === 'POST') {
                // $this->pages->render('Autor/ver_autores');
                
                // Prueba de AJAX para la recarga.
                $autor = new Autor();
                $autores = $autor->getAllAutoresWithName($_POST['buscar']);
                $autor_comprobar = $autor->getAllAutoresWithName($_POST['buscar']);
                $comprobar = $autor_comprobar->fetch(PDO::FETCH_OBJ);

                $data = '';
                if($comprobar !== false) {
                    $data = '<div class="grid-container">';
                    while($autor = $autores->fetch(PDO::FETCH_OBJ)) {
                        $nombre_imagen = $autor->nombre;
                        $nombre_imagen = str_replace(" ", "", $nombre_imagen);
                        $imagen =  './Images/Autores/'.$nombre_imagen.'.png';
                        if(!file_exists($imagen)) {
                            $imagen = './Images/Error404/ImgNotFound.png';
                        }
                        $data .= '<div class="container" style="background-image: url('.$imagen.')">'
                            .'<a href="'.$_ENV['BASE_URL'].'autor/'.$autor->id.'">'
                            . '<div class="overlay">'
                                . '<div class="items"></div>'
                                . '<div class="items head">'
                                    . '<p class="nombre">'.$autor->nombre.'</p>'
                                    . '<p class="apellidos">'.$autor->apellidos.'</p>'
                                    . '<hr>'
                                . '</div>'
                                . '<div class="items price">'
                                    . '<p>'.$autor->fecha_nacimiento.'</p>'
                                    . '<p>'.$autor->fecha_fallecimiento.'</p>'
                                . '</div>'
                                // . '<div class="items cart">'
                                //     . '<i class="fa fa-shopping-cart"></i>'
                                //     . '<span>ADD TO CART</span>'
                                // . '</div>'
                            . '</div>'
                            .'</a>'
                        . '</div>';
                    }
                    $data .= '</div>';
                    echo $data;
                }else{
                    $data = "<div class='not_found'>No hay datos disponibles.</div>";
                    echo $data;
                }
                
            }

        }

        public function autor($id) {

            if($_SERVER['REQUEST_METHOD'] === 'GET') {
                $this->pages->render('Autor/ver_autor', ['id' => $id]);
            }

        }

    }