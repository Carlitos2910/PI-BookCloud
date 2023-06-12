<?php

    namespace Models;
    use Lib\BaseDatos;
    use PDO;
    use PDOException;

    class Autor{
        private string $id;
        private string $nombre;
        private string $apellidos;
        private string $biografia;
        private string $nacionalidad;
        private string $fecha_nacimiento;
        private string $fecha_fallecimiento;


        private BaseDatos $db;

        public function __construct() {
            $this->db = new BaseDatos();
        }


        public function getId(): string{
            return $this->id;
        }

        public function setId(string $id){
            $this->id = $id;
        }

        public function getNombre(): string{
            return $this->nombre;
        }

        public function setNombre(string $nombre){
            $this->nombre = $nombre;
        }

        public function getApellidos(): string{
            return $this->apellidos;
        }

        public function setApellidos(string $apellidos){
            $this->apellidos = $apellidos;
        }

        public function getBiografia(): string{
            return $this->biografia;
        }

        public function setBiografia(string $biografia){
            $this->biografia = $biografia;
        }

        public function getNacionalidad(): string{
            return $this->nacionalidad;
        }

        public function setNacionalidad(string $nacionalidad){
            $this->nacionalidad = $nacionalidad;
        }

        public function getFecha_nacimiento(): string{
            return $this->fecha_nacimiento;
        }

        public function setFecha_nacimiento(string $fecha_nacimiento){
            $this->fecha_nacimiento = $fecha_nacimiento;
        }

        public function getFecha_fallecimiento(): string{
            return $this->fecha_fallecimiento;
        }

        public function setFecha_fallecimiento(string $fecha_fallecimiento){
            $this->fecha_fallecimiento = $fecha_fallecimiento;
        }

        public static function getAllAutores(){
            $autor = new Autor();
            $autores = $autor->db->prepara("SELECT * FROM autor");
            $autores->execute();
            return $autores;
        }

        public static function getAllAutoresWithName($nombre){
            $autor = new Autor();
            $autores = $autor->db->prepara("SELECT * FROM autor WHERE LOWER(nombre) LIKE LOWER('%$nombre%') ");
            // $autores->bindParam(":nombre", $nombre);
            $autores->execute();
            return $autores;
        }

        public static function getAutorIdFromId($id){
            $autor = new Autor();
            $autores = $autor->db->prepara("SELECT * FROM autor WHERE id = :id");
            $autores->bindParam(":id", $id);
            $autores->execute();
            return $autores;
        }


        public function save($data): bool {

            $ins = $this->db->prepara("INSERT INTO autor VALUES(:id, :nombre, :apellidos, :biografia, :nacionalidad, :fecha_nacimiento, :fecha_fallecimiento)");

            $ins->bindParam(":id", $id);
            $ins->bindParam(":nombre", $nombre);
            $ins->bindParam(":apellidos", $apellidos);
            $ins->bindParam(":biografia", $biografia);
            $ins->bindParam(":nacionalidad", $nacionalidad);
            $ins->bindParam(":fecha_nacimiento", $fecha_nacimiento);
            $ins->bindParam(":fecha_fallecimiento", $fecha_fallecimiento);

            $id = NULL;
            $nombre = $data['nombre'];
            $apellidos = $data['apellidos'];
            $biografia = $data['biografia'];
            $nacionalidad = $data['nacionalidad'];
            $fecha_nacimiento = $data['fecha_nacimiento'];
            $fecha_fallecimiento = $data['fecha_fallecimiento'];

            try {
                $ins->execute();
                $result = true;
            }catch(PDOException $err) {
                $result = false;
            }

            return $result;

        }

        public function delete($id): bool{
            $del = $this->db->prepara("DELETE FROM autor WHERE id=:id");
            $del->bindParam(":id", $id);

            try {
                $del->execute();
                $result = true;
            }catch(PDOException $err) {
                $result = false;
            }
            return $result;
        }

        public function edit($data): bool{ 

            $edit = $this->db->prepara("UPDATE autor SET nombre=:nombre, apellido=:apellidos, biografia=:biografia, nacionalidad=:nacionalidad, fecha_nacimiento=:fecha_nacimiento, fecha_fallecimiento=:fecha_fallecimiento WHERE id=:id");

            $edit->bindParam(":id", $data['id']);
            $edit->bindParam(":nombre", $data['nombre']);
            $edit->bindParam(":apellidos", $data['apellidos']);
            $edit->bindParam(":biografia", $data['biografia']);
            $edit->bindParam(":nacionalidad", $data['nacionalidad']);
            $edit->bindParam(":fecha_nacimiento", $data['fecha_nacimiento']);
            $edit->bindParam(":fecha_fallecimiento", $data['fecha_fallecimiento']);

            try {
                $edit->execute();
                $result = true;
            }catch(PDOException $err) {
                $result = false;
            }

            return $result;

        }
    }