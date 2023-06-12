<?php

    namespace Models;

use DateTime;
use Lib\BaseDatos;
    use PDO;
    use PDOException;

    class Reserva{
        private string $id;
        private string $fecha_reserva;
        private string $usuario_id;
        private string $libro_id;
        private string $comprada;

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

        public function getFechaReserva(){
            return $this->fecha_reserva;
        }
        public function setFechaReserva(string $fecha_reserva){
            $this->fecha_reserva = $fecha_reserva;
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

        public function getComprada(){
            return $this->comprada;
        }
        public function setComprada(string $comprada){
            $this->comprada = $comprada;
        }

        public static function getAllReservasFromUserBook(string $id){
            $reserva = new Reserva();
            $reservas = $reserva->db->prepara("SELECT * FROM reservas WHERE usuario_id = :usuario_id AND libro_id = :libro_id");
            $reservas->bindParam(":usuario_id", $_SESSION['identity']->id);
            $reservas->bindParam(":libro_id", $id);
            $reservas->execute();
            return $reservas;
        }

        public function getAllReservasFromBook(string $id){

            $reservas = $this->db->prepara("SELECT * FROM reservas WHERE libro_id = :libro_id AND comprada = 0");
            $reservas->bindParam(":libro_id", $id);
            $reservas->execute();
            return $reservas;
        }

        public function reservar($id_libro){

            $sel = $this->db->prepara("SELECT * FROM reservas WHERE usuario_id = :usuario_id AND libro_id = :libro_id");
            $sel->bindParam(":usuario_id", $usuario_id);
            $sel->bindParam(":libro_id", $libro_id);

            $usuario_id = $_SESSION['identity']->id;
            $libro_id = $id_libro;

            $sel->execute();
            $resultado = $sel->fetchAll();
            

            if(empty($resultado)) {
                $ins = $this->db->prepara("INSERT INTO reservas VALUES(:id, :fecha_reserva, :usuario_id, :libro_id, :comprada)");

                $ins->bindParam(":id", $id);
                $ins->bindParam(":fecha_reserva", $fecha_reserva);
                $ins->bindParam(":usuario_id", $usuario_id);
                $ins->bindParam(":libro_id", $libro_id);
                $ins->bindParam(":comprada", $comprada);

                $id = NULL;
                $fecha_reserva = date('Y-m-d G:i:s');
                $usuario_id = $_SESSION['identity']->id;
                $libro_id = $id_libro;
                $comprada = 0;

                try {
                    $ins->execute();
                    $result = true;
                }catch(PDOException $err) {
                    $result = false;
                }

                return $result;
            }

            
        }

        public function asignarReserva($libro_id){
            $upd = $this->db->prepara("UPDATE reservas
                                        SET comprada = 1
                                        WHERE id = (SELECT id
                                                    FROM reservas
                                                    WHERE libro_id = :libro_id AND comprada = 0
                                                    ORDER BY fecha_reserva ASC LIMIT 1)");

            $upd->bindParam(":libro_id", $libro_id);

            try {
                $upd->execute();
                $result = true;
            }catch(PDOException $err) {
                $result = false;
            }

            return $result;

        }

        public function getEmailReservaAsignada($libro_id){
            $email = $this->db->prepara("SELECT email
                                        FROM users
                                        WHERE id = (SELECT usuario_id
                                                    FROM reservas
                                                    WHERE libro_id = :libro_id AND comprada = 0
                                                    ORDER BY fecha_reserva ASC LIMIT 1)");
            
            
            $email->bindParam(":libro_id", $libro_id);
            $email->execute();
            return $email;
        }
    }