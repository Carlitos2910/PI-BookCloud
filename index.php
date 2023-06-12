<?php


    session_start();
    if(isset($_SESSION['register'])){
        unset($_SESSION['register']);
    }
    if(isset($_SESSION['error_login'])){
        unset($_SESSION['error_login']);
    }

    require_once __DIR__.'/vendor/autoload.php';


    use Controllers\EmailController;
    use Controllers\UserController;
    use Controllers\CategoriaController;
    use Controllers\AutorController;
    use Controllers\LibroController;

    
    use Lib\Router;
    use Utils\Utils;

    use Dotenv\Dotenv;

 


    // Añadir Dotenv.
    $dotenv = Dotenv::createImmutable(__DIR__); // Para acceder al contenido del archivo .env
    $dotenv->safeLoad(); // Si no existe nos marca error.

   
    


    // Página Principal & Error.
    Router::add('GET', '/', function(){
        require './Views/Layout/header.php';
        require './Views/Home/home.php';
        require './Views/Layout/footer.php';
    });
    Router::add('GET', 'home', function(){
        require './Views/Layout/header.php';
        require './Views/Home/home.php';
        require './Views/Layout/footer.php';
    });
    // Página Error.
    Router::add('GET', 'error', function(){
        require './Views/Layout/header.php';
        require './Views/Home/error.php';
        require './Views/Layout/footer.php';
    });
    // Term & Conditions.
    Router::add('GET', 'term_conditions', function(){
        require './Views/Layout/header.php';
        require './Views/Term_Conditions/index.php';
        require './Views/Layout/footer.php';
    });

    Router::add('POST', 'send_email', function(){
        (new EmailController())->sendEmail();
    });

    // Pagina Autores.
    Router::add('GET', 'autores', function(){
        (new AutorController())->autores();
    });
    Router::add('POST', 'buscador_autor', function(){
        (new AutorController())->autores();
    });

    Router::add('GET', 'autor/:id', function(string $id){
        (new AutorController())->autor($id);
    });


    // Pagina Libros.
    Router::add('GET', 'mis_libros', function(){
        (new LibroController())->mis_libros();
    });
    Router::add('POST', 'mi_libro', function(){
        (new LibroController())->mi_libro();
    });
    Router::add('POST', 'download_pdf', function(){
        (new LibroController())->download_pdf();
    });
    Router::add('GET', 'libros', function(){
        (new LibroController())->libros();
    });
    Router::add('POST', 'buscador_libros', function(){
        (new LibroController())->libros();
    });
    Router::add('GET', 'libro/:id', function(string $id){
        (new LibroController())->libro($id);
    });
    Router::add('GET', 'libro_sumar_stock/:id', function(string $id){
        (new LibroController())->libro_sumar_stock($id);
    });
    Router::add('GET', 'libro_restar_stock/:id', function(string $id){
        (new LibroController())->libro_restar_stock($id);
    });
    Router::add('GET', 'libro_sumar_stock_reserva/:id', function(string $id){
        (new LibroController())->libro_sumar_stock_reserva($id);
    });
    Router::add('GET', 'libro_restar_stock_reserva/:id', function(string $id){
        (new LibroController())->libro_restar_stock_reserva($id);
    });

    Router::add('GET', 'libro_reservar/:id', function(string $id){
        (new LibroController())->reservar($id);
    });
    Router::add('GET', 'libro_comprar/:id', function(string $id){
        (new LibroController())->comprar($id);
    });
    Router::add('GET', 'libro_comprar_reserva/:id', function(string $id){
        (new LibroController())->comprar_reserva($id);
    });
    Router::add('GET', 'libro_devolver/:id', function(string $id){
        (new LibroController())->devolver($id);
    });

    Router::add('POST', 'valorar', function(){
        (new LibroController())->valorar();
    });


    // REGISTRO/LOGIN/LOGOUT DE USUARIOS
    Router::add('GET', 'user_login', function(){
        (new UserController())->login();
    });
    Router::add('GET', 'user_signin', function(){
        (new UserController())->signin();
    });
    Router::add('POST', 'user_login', function(){
        (new UserController())->login();
    });
    Router::add('POST', 'user_signin', function(){
        (new UserController())->signin();
    });
    Router::add('GET', 'user_logout', function(){
        (new UserController())->logout();
    });


/*=============================================
=            SECTION ADMINISTRATOR            =
=============================================*/

    // ADMINISTRADOR USUARIOS
    Router::add('GET', 'admin_users', function(){
        (new UserController())->admin_users();
    });
    Router::add('GET', 'user_delete/:id', function(string $id){
        (new UserController())->user_delete($id);
    });
    Router::add('GET', 'user_edit/:id', function(string $id){
        (new UserController())->user_edit($id);
    });
    Router::add('POST', 'user_edit', function(){
        (new UserController())->user_edit();
    });

    // ADMINISTRADOR CATEGORIAS.
    Router::add('GET', 'admin_categoria', function(){
        (new CategoriaController())->admin_categoria();
    });
    Router::add('GET', 'categoria_create', function(){
        (new CategoriaController())->categoria_create();
    });
    Router::add('POST', 'categoria_create', function(){
        (new CategoriaController())->categoria_create();
    });
    Router::add('GET', 'categoria_delete/:id', function(string $id){
        (new CategoriaController())->categoria_delete($id);
    });
    Router::add('GET', 'categoria_edit/:id', function(string $id){
        (new CategoriaController())->categoria_edit($id);
    });
    Router::add('POST', 'categoria_edit', function(){
        (new CategoriaController())->categoria_edit();
    });

    // ADMINISTRADOR AUTORES.
    Router::add('GET', 'admin_autor', function(){
        (new AutorController())->admin_autor();
    });
    Router::add('GET', 'autor_create', function(){
        (new AutorController())->autor_create();
    });
    Router::add('POST', 'autor_create', function(){
        (new AutorController())->autor_create();
    });
    Router::add('GET', 'autor_delete/:id', function(string $id){
        (new AutorController())->autor_delete($id);
    });
    Router::add('GET', 'autor_edit/:id', function(string $id){
        (new AutorController())->autor_edit($id);
    });
    Router::add('POST', 'autor_edit', function(){
        (new AutorController())->autor_edit();
    });

    // ADMINISTRADOR LIBROS.
    Router::add('GET', 'admin_libro', function(){
        (new LibroController())->admin_libro();
    });
    Router::add('GET', 'libro_create', function(){
        (new LibroController())->libro_create();
    });
    Router::add('POST', 'libro_create', function(){
        (new LibroController())->libro_create();
    });
    Router::add('GET', 'libro_delete/:id', function(string $id){
        (new LibroController())->libro_delete($id);
    });
    Router::add('GET', 'libro_edit/:id', function(string $id){
        (new LibroController())->libro_edit($id);
    });
    Router::add('POST', 'libro_edit', function(){
        (new LibroController())->libro_edit();
    });

    Router::dispatch();
    

    // require_once ('../Views/Layout/header.php');
    // require_once ('../Views/Layout/footer.php');

?>