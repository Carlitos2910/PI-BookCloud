<?php

    namespace Models;
    use Lib\BaseDatos;
    use PDO;
    use PDOException;

    class Categoria{
        private string $id;
        private string $nombre;
        private string $descripcion;

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

        public function getDescripcion(): string{
            return $this->descripcion;
        }

        public function setDescripcion(string $descripcion){
            $this->descripcion = $descripcion;
        }

        public static function getAllCategoria(){
            $categoria = new Categoria();
            $categorias = $categoria->db->prepara("SELECT * FROM categoria");
            $categorias->execute();
            return $categorias;
        }

        public static function getAllCategoriaFromId($id){
            $categoria = new Categoria();
            $categorias = $categoria->db->prepara("SELECT * FROM categoria WHERE id='$id'");
            $categorias->execute();
            return $categorias;
        }

        public function save($data): bool {

            $ins = $this->db->prepara("INSERT INTO categoria (id, nombre, descripcion) VALUES (:id, :nombre, :descripcion)");

            $ins->bindParam(":id", $id);
            $ins->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $ins->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);

            $id = NULL;
            $nombre = $data['nombre'];
            $descripcion = $data['descripcion'];

            try {
                $ins->execute();
                $result = true;
            }catch(PDOException $err){
                $result = false;
            }

            return $result;
        }

        public function delete($id): bool{

            $del = $this->db->prepara("DELETE FROM categoria WHERE id = :id");

            $del->bindParam(":id", $id);

            try {
                $del->execute();
                $result = true;
            }catch(PDOException $err){
                $result = false;
            }
            
            return $result;

        }

        public function edit($data): bool{

            $edit = $this->db->prepara("UPDATE categoria SET nombre = :nombre, descripcion = :descripcion WHERE id = :id");

            $edit->bindParam(":id", $data['id']);
            $edit->bindParam(":nombre", $data['nombre']);
            $edit->bindParam(":descripcion", $data['descripcion']);

            try{
                $edit->execute();
                $result = true;
            }catch(PDOException $err){
                $result = false;
            }

            return $result;

        }


    }