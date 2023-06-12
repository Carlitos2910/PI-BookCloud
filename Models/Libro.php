<?php

    namespace Models;
    use Lib\BaseDatos;
    use PDO;
    use PDOException;

    class Libro{
        private string $id;
        private string $titulo;
        private string $descripcion;
        private string $stock;
        private string $stock_reserva;
        private string $categoria_id;
        private string $autor_id;
        private string $fecha_publicacion;

        private BaseDatos $db;

        public function __construct(){
            $this->db = new BaseDatos();
        }

        public function getId(): string{
            return $this->id;
        }

        public function setId(string $id){
            $this->id = $id;
        }

        public function getTitulo(): string{
            return $this->titulo;
        }

        public function setTitulo(string $titulo){
            $this->titulo = $titulo;
        }
        
        public function getDescripcion(): string{
            return $this->descripcion;
        }
        
        public function setDescripcion(string $descripcion){
            $this->descripcion = $descripcion;
        }
        
        public function getStock(): string{
            return $this->stock;
        }

        public function setStock(string $stock){
            $this->stock = $stock;
        }
        
        public function getStock_reserva(): string{
            return $this->stock_reserva;
        }
        
        public function setStock_reserva(string $stock_reserva){
            $this->stock_reserva = $stock_reserva;
        }
        
        public function getCategoria_id(): string{
            return $this->categoria_id;
        }
        
        public function setCategoria_id(string $categoria_id){
            $this->categoria_id = $categoria_id;
        }
        
        public function getAutor_id(): string{
            return $this->autor_id;
        }
        
        public function setAutor_id(string $autor_id){
            $this->autor_id = $autor_id;
        }
        
        public function getFecha_publicacion(): string{
            return $this->fecha_publicacion;
        }
        
        public function setFecha_publicacion(string $fecha_publicacion){
            $this->fecha_publicacion = $fecha_publicacion;
        }

        public static function getAllLibros() {
            $libro = new Libro();
            $libros = $libro->db->prepara("SELECT * FROM libros");
            $libros->execute();
            return $libros;
        }

        public static function getLibrosRandom() {
            $libro = new Libro();
            $libros = $libro->db->prepara("SELECT * FROM libros ORDER BY RAND() LIMIT 10");
            $libros->execute();
            return $libros;
        }

        public static function getAllLibrosWithTitle($titulo) {
            $libro = new Libro();
            $libros = $libro->db->prepara("SELECT * FROM libros WHERE LOWER(titulo) LIKE LOWER('%$titulo%') ");
            // $libros->bindParam(":titulo", $titulo);
            $libros->execute();
            return $libros;
        }

        public static function getCantidadLibrosFromAutor($autor_id) {
            $libro = new Libro();
            $libros = $libro->db->prepara("SELECT COUNT(*) FROM libros WHERE autor_id = :autor_id ");
            $libros->bindParam(":autor_id", $autor_id);
            $libros->execute();
            return $libros;
        }

        public static function getAllLibrosFromAutor($autor_id) {
            $libro = new Libro();
            $libros = $libro->db->prepara("SELECT * FROM libros WHERE autor_id = :autor_id ");
            $libros->bindParam(":autor_id", $autor_id);
            $libros->execute();
            return $libros;
        }

        public static function getAllLibrosFromId($id) {
            $libro = new Libro();
            $libros = $libro->db->prepara("SELECT * FROM libros WHERE id = :id ");
            $libros->bindParam(":id", $id);
            $libros->execute();
            return $libros;
        }

        public function save($data): bool {
            
            $ins = $this->db->prepara("INSERT INTO libros VALUES(:id, :titulo, :descripcion, :stock, :stock_reserva, :categoria_id, :autor_id, :fecha_publicacion)");

            $ins->bindParam(":id", $id);
            $ins->bindParam(":titulo", $data['titulo'], PDO::PARAM_STR);
            $ins->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
            $ins->bindParam(":stock", $data['stock'], PDO::PARAM_STR);
            $ins->bindParam(":stock_reserva", $data['stock_reserva'], PDO::PARAM_STR);
            $ins->bindParam(":categoria_id", $data['categoria_id'], PDO::PARAM_STR);
            $ins->bindParam(":autor_id", $data['autor_id'], PDO::PARAM_STR);
            $ins->bindParam(":fecha_publicacion", $data['fecha_publicacion']);

            $id = NULL;
            
            try{
                $ins->execute();
                $result = true;
            }catch(PDOException $e){
                $result = false;
            }
            
            return $result;

        }

        public function delete($id): bool{

            $del = $this->db->prepara("DELETE FROM libros WHERE id=:id");

            $del->bindParam(":id", $id);

            try{
                $del->execute();
                $result = true;
            }catch(PDOException $e){
                $result = false;
            }

            return $result;

        }

        public function edit($data): bool{

            $edit = $this->db->prepara("UPDATE libros SET titulo=:titulo, descripcion=:descripcion, stock=:stock, stock_reserva=:stock_reserva, categoria_id=:categoria_id, autor_id=:autor_id, fecha_publicacion=:fecha_publicacion WHERE id=:id");

            $edit->bindParam(":id", $data['id']);
            $edit->bindParam(":titulo", $data['titulo'], PDO::PARAM_STR);
            $edit->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
            $edit->bindParam(":stock", $data['stock'], PDO::PARAM_STR);
            $edit->bindParam(":stock_reserva", $data['stock_reserva'], PDO::PARAM_STR);
            $edit->bindParam(":categoria_id", $data['categoria_id'], PDO::PARAM_STR);
            $edit->bindParam(":autor_id", $data['autor_id'], PDO::PARAM_STR);
            $edit->bindParam(":fecha_publicacion", $data['fecha_publicacion']);

            try{
                $edit->execute();
                $result = true;
            }catch (PDOException $err){
                $result = false;
            }

            return $result;

        }

        public function sumar_stock($id): bool{

            $edit = $this->db->prepara("UPDATE libros SET stock = (SELECT stock+1 FROM libros WHERE id = :id) WHERE id = :id");

            $edit->bindParam(":id", $id);

            try{
                $edit->execute();
                $result = true;
            }catch (PDOException $err){
                $result = false;
            }

            return $result;

        }
        public function restar_stock($id): bool{
            
            $edit = $this->db->prepara("UPDATE libros SET stock = (SELECT stock-1 FROM libros WHERE id = :id) WHERE id = :id");

            $edit->bindParam(":id", $id);

            try{
                $edit->execute();
                $result = true;
            }catch (PDOException $err){
                $result = false;
            }

            return $result;

        }
        public function sumar_stock_reserva($id): bool{

            $edit = $this->db->prepara("UPDATE libros SET stock_reserva = (SELECT stock_reserva+1 FROM libros WHERE id = :id) WHERE id = :id");

            $edit->bindParam(":id", $id);

            try{
                $edit->execute();
                $result = true;
            }catch (PDOException $err){
                $result = false;
            }

            return $result;

        }
        public function restar_stock_reserva($id): bool{
            
            $edit = $this->db->prepara("UPDATE libros SET stock_reserva = (SELECT stock_reserva-1 FROM libros WHERE id = :id) WHERE id = :id");

            $edit->bindParam(":id", $id);

            try{
                $edit->execute();
                $result = true;
            }catch (PDOException $err){
                $result = false;
            }

            return $result;

        }


    }