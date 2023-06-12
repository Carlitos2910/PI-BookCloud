<?php
    
    namespace Controllers;
    use Models\Libro;
    use Models\Autor;
    use Models\Valoracion;
    use Models\Comentario;
    use Models\BookPDF;
    use Models\Reserva;
    use Models\Compra;

    use Controllers\EmailController;

    use Lib\Pages;
    use Utils\Utils;
    use PDO;

    class LibroController {
        private Pages $pages;

        public function __construct() {
            $this->pages = new Pages();
        }

        public function admin_libro(){
            Utils::isAdmin();

            if($_SERVER['REQUEST_METHOD'] == 'GET') {
                $this->pages->render('Libro/admin_libro');
            }

        }

        public function libro_create(){
            Utils::isAdmin();

            if($_SERVER['REQUEST_METHOD'] == 'GET') {
                $this->pages->render('Libro/libro_crear');
            }else if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $data_libro = $_POST['data'];

                $libro = new Libro();

                $guardado = $libro->save($data_libro);

                if($guardado) {
                    $this->pages->render('Libro/admin_libro');
                }else{
                    $this->pages->render('Libro/admin_libro', ['error' => "El libro no ha sido creado."]);
                }
            }
        }

        public function libro_delete($id){
            Utils::isAdmin();

            if($_SERVER['REQUEST_METHOD'] == 'GET') {

                $libro = new Libro();
                $eliminado = $libro->delete($id);

                if ($eliminado){
                    header('Location: ' . $_ENV['BASE_URL']. "admin_libro");
                }else{
                    $_SESSION['error'] = "El libro ".$id." no ha sido eliminada.";
                    header('Location:'. $_ENV['BASE_URL']."admin_libro");
                }
            }
        }

        public function libro_edit($id = null){
            Utils::isAdmin();

            if($_SERVER['REQUEST_METHOD'] == 'GET')  {

                $this->pages->render('Libro/libro_editar', ['id' => $id]);

            }else if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $data_libro = $_POST['data'];

                $libro = new Libro();
                $editado = $libro->edit($data_libro);

                if($editado) {
                    header('Location: '. $_ENV['BASE_URL']."admin_libro");
                }else{
                    $_SESSION['error'] = "El libro ".$id." no ha sido editada.";
                    header('Location: '. $_ENV['BASE_URL']."admin_libro");
                }

            }

        }

        public function libro_sumar_stock($id){
            Utils::isAdmin();
            
            if($_SERVER['REQUEST_METHOD'] == 'GET') {

                $libro = new Libro();
                $reserva = new Reserva();
                $comprobar_reserva = $reserva->getAllReservasFromBook($id);
                $comprobar_reserva = $comprobar_reserva->fetchAll();

                // Mirar Stock Reserva.
                if(!empty($comprobar_reserva)){
                    // Comprobar si hay tanto stock reserva como Reservas.
                    // Si hay más stock reserva se añade stock normal.
                    $stock_reserva = $libro->getAllLibrosFromId($id);
                    $stock_reserva = $stock_reserva->fetchObject();
                    if($stock_reserva->stock_reserva >= count($comprobar_reserva)){
                        $libro->sumar_stock($id);
                    }else{
                        // Se añade un stock de reserva.
                        $libro->sumar_stock_reserva($id);
                        // Obtenemos el Email de la reserva Asignada.
                        $email = $reserva->getEmailReservaAsignada($id);
                        $email = $email->fetchObject();
                        
                        // Obtenemos los datos del libro de la reserva Asignada.
                        $datos_libro  = Libro::getAllLibrosFromId($id);
                        $datos_libro = $datos_libro->fetchObject();

                        // Se pone true el campo comprada, de la reserva al usuarios que más pronto reservó.
                        $reserva->asignarReserva($id);

                        // En la variable Email tenemos el email del usuario al que se le asigna la reserva.
                        // En la variable datos_libro tenemos el título del libro de la reserva.
                        // Ahora tendríamos que enviarle un email diciéndole que el libro que reservó ya lo tiene disponible.
                        $emailReserva = new EmailController();
                        $emailReserva = $emailReserva->sendEmailReserva($email->email, $datos_libro->titulo);

                        
                    }
                }else{
                    $libro->sumar_stock($id);
                }

                header('Location: '. $_ENV['BASE_URL']."admin_libro");
                
            }
        }
        public function libro_restar_stock($id){
            Utils::isAdmin();
            
            if($_SERVER['REQUEST_METHOD'] == 'GET') {
                $libro = new Libro();
                $sumar_stock = $libro->restar_stock($id);

                header('Location: '. $_ENV['BASE_URL']."admin_libro");
                
            }
        }
        public function libro_sumar_stock_reserva($id){
            Utils::isAdmin();
            
            if($_SERVER['REQUEST_METHOD'] == 'GET') {
                // Se añade un stock de reserva.
                $libro = new Libro();
                $libro->sumar_stock_reserva($id);
                // También se le pondrá el campo comprada, de la reserva al usuario que más pronto reservó,
                // dándole la opción para que pueda recojer el libro.
                $reserva = new Reserva();
                $reserva->asignarReserva($id);



                header('Location: '. $_ENV['BASE_URL']."admin_libro");
                
            }
        }
        public function libro_restar_stock_reserva($id){
            Utils::isAdmin();
            
            if($_SERVER['REQUEST_METHOD'] == 'GET') {
                $libro = new Libro();
                $sumar_stock = $libro->restar_stock_reserva($id);

                header('Location: '. $_ENV['BASE_URL']."admin_libro");
                
            }
        }

        public function libros() {
            
            if($_SERVER['REQUEST_METHOD'] === 'GET') {
                $this->pages->render('Libro/ver_libros');
            } else if($_SERVER['REQUEST_METHOD'] === 'POST') {
                // AJAX para la recarga de datos.

                $libro = new Libro();
                $libros = $libro->getAllLibrosWithTitle($_POST['buscar']);
                $libro_comprobar = $libro->getAllLibrosWithTitle($_POST['buscar']);
                $comprobar = $libro_comprobar->fetch(PDO::FETCH_OBJ);

                $data = '';
                if($comprobar !== false) {
                    $data = '<div class="grid-container">';
                    while($libro = $libros->fetch(PDO::FETCH_OBJ)) {
                        $autor = Autor::getAutorIdFromId($libro->autor_id);
                        $autor = $autor->fetchAll();
                        $nombre_imagen = $libro->titulo;
                        $nombre_imagen = str_replace(" ", "", $nombre_imagen);
                        $imagen =  './Images/Libros/'.$nombre_imagen.'.png';
                        if(!file_exists($imagen)) {
                            $imagen = './Images/Error404/ImgNotFound.png';
                        }
                        $data .= '<div class="container" style="background-image: url('.$imagen.'">'
                            .'<a href="'.$_ENV['BASE_URL'].'libro/'.$libro->id.'">'
                            . '<div class="overlay">'
                                . '<div class="items"></div>'
                                . '<div class="items head">'
                                    . '<p class="titulo">'.$libro->titulo.'</p>'
                                    . '<hr>'
                                . '</div>'
                                . '<div class="items price">'
                                    . '<p class="nombre_autor">'.$autor[0]["nombre"] . ' '. $autor[0]["apellidos"].'</p>'
                                    . '<p>'.$libro->fecha_publicacion.'</p>'
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
        
        public function libro($id) {

            if($_SERVER['REQUEST_METHOD'] === 'GET') {
                $this->pages->render('Libro/ver_libro', ['id' => $id]);
            }

        }

        public function mis_libros() {
            Utils::isIdentity();
            
            if($_SERVER['REQUEST_METHOD'] == 'GET') {
                $this->pages->render('Libro/mis_libros');
            }
        }
        public function mi_libro() {
            Utils::isIdentity();
            $id = $_POST['id'];
            
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $this->pages->render('Libro/mi_libro', ['id' => $id]);
            }
        }
        public function download_pdf() {
            Utils::isIdentity();
            
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $pdf = new BookPDF();

                

                // Agrega páginas y contenido al PDF
                $pdf->AddPage();
                $pdf->SetFont('Arial', 'B', 14);
                
                $pdf->Cell(0, 10, $_POST['titulo'], 0, 1, 'C');
                $pdf->ChapterTitle(utf8_decode('Capítulo 1'));
                $pdf->ChapterContent($_POST['descripcion']);
                $pdf->ChapterContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vitae mi vitae nisi luctus tristique. Nunc sem ipsum, molestie sit amet sem id, bibendum posuere quam. In in ultricies magna. Duis ac mollis dui. Mauris rhoncus metus vehicula ipsum auctor facilisis. Curabitur vulputate, magna et aliquet ornare, lacus nisl interdum magna, eget tempus arcu sapien blandit urna. Duis tincidunt, diam ut viverra egestas, nisi augue pellentesque dolor, et facilisis diam magna nec quam. Phasellus ligula felis, rhoncus in malesuada in, porttitor vel mauris. Integer sagittis vel orci a pellentesque.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vitae mi vitae nisi luctus tristique. Nunc sem ipsum, molestie sit amet sem id, bibendum posuere quam. In in ultricies magna. Duis ac mollis dui. Mauris rhoncus metus vehicula ipsum auctor facilisis. Curabitur vulputate, magna et aliquet ornare, lacus nisl interdum magna, eget tempus arcu sapien blandit urna. Duis tincidunt, diam ut viverra egestas, nisi augue pellentesque dolor, et facilisis diam magna nec quam. Phasellus ligula felis, rhoncus in malesuada in, porttitor vel mauris. Integer sagittis vel orci a pellentesque.');

                // Capítulo 2
                $pdf->AddPage();
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(0, 10, $_POST['titulo'], 0, 1, 'C');
                $pdf->ChapterTitle(utf8_decode('Capítulo 2'));
                $pdf->ChapterContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vitae mi vitae nisi luctus tristique. Nunc sem ipsum, molestie sit amet sem id, bibendum posuere quam. In in ultricies magna. Duis ac mollis dui. Mauris rhoncus metus vehicula ipsum auctor facilisis. Curabitur vulputate, magna et aliquet ornare, lacus nisl interdum magna, eget tempus arcu sapien blandit urna. Duis tincidunt, diam ut viverra egestas, nisi augue pellentesque dolor, et facilisis diam magna nec quam. Phasellus ligula felis, rhoncus in malesuada in, porttitor vel mauris. Integer sagittis vel orci a pellentesque.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vitae mi vitae nisi luctus tristique. Nunc sem ipsum, molestie sit amet sem id, bibendum posuere quam. In in ultricies magna. Duis ac mollis dui. Mauris rhoncus metus vehicula ipsum auctor facilisis. Curabitur vulputate, magna et aliquet ornare, lacus nisl interdum magna, eget tempus arcu sapien blandit urna. Duis tincidunt, diam ut viverra egestas, nisi augue pellentesque dolor, et facilisis diam magna nec quam. Phasellus ligula felis, rhoncus in malesuada in, porttitor vel mauris. Integer sagittis vel orci a pellentesque.');

                // Capítulo 3
                $pdf->AddPage();
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(0, 10, $_POST['titulo'], 0, 1, 'C');
                $pdf->ChapterTitle(utf8_decode('Capítulo 3'));
                $pdf->ChapterContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vitae mi vitae nisi luctus tristique. Nunc sem ipsum, molestie sit amet sem id, bibendum posuere quam. In in ultricies magna. Duis ac mollis dui. Mauris rhoncus metus vehicula ipsum auctor facilisis. Curabitur vulputate, magna et aliquet ornare, lacus nisl interdum magna, eget tempus arcu sapien blandit urna. Duis tincidunt, diam ut viverra egestas, nisi augue pellentesque dolor, et facilisis diam magna nec quam. Phasellus ligula felis, rhoncus in malesuada in, porttitor vel mauris. Integer sagittis vel orci a pellentesque.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vitae mi vitae nisi luctus tristique. Nunc sem ipsum, molestie sit amet sem id, bibendum posuere quam. In in ultricies magna. Duis ac mollis dui. Mauris rhoncus metus vehicula ipsum auctor facilisis. Curabitur vulputate, magna et aliquet ornare, lacus nisl interdum magna, eget tempus arcu sapien blandit urna. Duis tincidunt, diam ut viverra egestas, nisi augue pellentesque dolor, et facilisis diam magna nec quam. Phasellus ligula felis, rhoncus in malesuada in, porttitor vel mauris. Integer sagittis vel orci a pellentesque.');

                // Genera el PDF
                // $pdf->Output('ruta/del/archivo.pdf', 'F');
                $pdf->Output($_POST['titulo'].'.pdf', 'D');
                // $pdf->Output();
            }
        }

        public function valorar() {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                $data_valoracion = $_POST['data'];
                
                $comentario = new Comentario();
                $valoracion = new Valoracion();
                

                $comentario_guardado = $comentario->save($data_valoracion);
                $valoracion_guardado = $valoracion->save($data_valoracion);

                if($comentario_guardado && $valoracion_guardado){

                    $this->pages->render("Libro/ver_libros", ['correct_response_valoration' => 'Datos Enviados.']);
                }else if(!$comentario_guardado ||  !$valoracion_guardado){
                    $this->pages->render("Libro/ver_libros", ['bad_response_valoration' => 'Error de Envío.']);
                }  

            }
        }

        public function reservar($id){
            Utils::isIdentity();

            if($_SERVER['REQUEST_METHOD'] === 'GET'){
                
                $reserva = new Reserva();
                $reserva->reservar($id);

                header('Location: '.$_ENV['BASE_URL']);
            }
        }
        public function comprar($id){
            Utils::isIdentity();

            if($_SERVER['REQUEST_METHOD'] === 'GET'){
                
                $compra = new Compra();
                $comprado = $compra->comprar($id);

                if($comprado){
                    $libro = new Libro();
                    $libro->restar_stock($id);
                }

                // $this->pages->render("Libro/mis_libros");
                header('Location: '.$_ENV['BASE_URL']."mis_libros");
            }
        }
        public function comprar_reserva($id){
            Utils::isIdentity();

            if($_SERVER['REQUEST_METHOD'] === 'GET'){
                
                $compra = new Compra();
                $comprado = $compra->comprar($id);

                if($comprado){
                    $libro = new Libro();
                    $libro->restar_stock_reserva($id);
                }

                // $this->pages->render("Libro/mis_libros");
                header('Location: '.$_ENV['BASE_URL']."mis_libros");
            }
        }

        public function devolver($id){
            Utils::isIdentity();

            if($_SERVER['REQUEST_METHOD'] === 'GET'){
                
                $compra = new Compra();
                $devuelto = $compra->devolver($id);
                
                if($devuelto){
                    $libro = new Libro();
                    $libro->sumar_stock($id);
                }

                header('Location: '.$_ENV['BASE_URL']."mis_libros");
            }

        }


    }