<?php

    namespace Models;
    use Lib\BaseDatos;
    use PDO;
    use PDOException;

    class Compra{
        private string $id;
        private string $usuario_id;
        private string $libro_id;

        private BaseDatos $db;

        public function __construct(){
            $this->db = new BaseDatos();
        }

        public function getId(){
            return $this->id;
        }
        public function setId(string $id){
            $this->id = $id;
        }

        public function getUsuarioId(){
            return $this->usuario_id;
        }
        public function setUsuarioId(string $usuario_id){
            $this->usuario_id = $usuario_id;
        }

        public function getLibroId(){
            return $this->libro_id;
        }
        public function setLibroId(string $libro_id){
            $this->libro_id = $libro_id;
        }

        public static function getAllComprasFromUser(string $id){
            $compra = new Compra();
            $compras = $compra->db->prepara("SELECT * FROM compras WHERE usuario_id = :usuario_id");
            $compras->bindParam(":usuario_id", $id);
            $compras->execute();
            return $compras;
        }

        public static function getAllComprasFromUserBook(string $id){
            $compra = new Compra();
            $compras = $compra->db->prepara("SELECT * FROM compras WHERE usuario_id = :usuario_id AND libro_id = :libro_id");
            $compras->bindParam(":usuario_id", $_SESSION['identity']->id);
            $compras->bindParam(":libro_id", $id);
            $compras->execute();
            return $compras;
        }

        public function comprar(string $id_libro) {

            $ins = $this->db->prepara("INSERT INTO compras VALUES(:id, :usuario_id, :libro_id)");

            $ins->bindParam(":id", $id);
            $ins->bindParam(":usuario_id", $usuario_id);
            $ins->bindParam(":libro_id", $libro_id);

            $id = NULL;
            $usuario_id = $_SESSION['identity']->id;
            $libro_id = $id_libro;

            try {
                $ins->execute();
                $result = true;
            }catch(PDOException $err) {
                $result = false;
            }

            return $result;

        }

        public function devolver(string $id_libro) {

            $del_c = $this->db->prepara("DELETE FROM compras WHERE usuario_id = :usuario_id AND libro_id = :libro_id");
            $del_r = $this->db->prepara("DELETE FROM reservas WHERE usuario_id = :usuario_id AND libro_id = :libro_id");

            $del_c->bindParam(":usuario_id", $_SESSION['identity']->id);
            $del_c->bindParam(":libro_id", $id_libro);
            $del_r->bindParam(":usuario_id", $_SESSION['identity']->id);
            $del_r->bindParam(":libro_id", $id_libro);

            try {
                $del_c->execute();
                $del_r->execute();
                $result = true;
            }catch(PDOException $err) {
                $result = false;
            }

            return $result;

        }
    }