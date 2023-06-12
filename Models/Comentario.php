<?php


    namespace Models;
    use Lib\BaseDatos;
    use PDO;
    use PDOException;


    class Comentario{
        private string $id;
        private string $fecha_publicacion;
        private string $texto;
        private string $usuario_id;
        private string $libro_id;

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
        
        public function getFecha_publicacion(): string{
            return $this->fecha_publicacion;
        }
        public function setFecha_publicacion(string $fecha_publicacion){
            $this->fecha_publicacion = $fecha_publicacion;
        }

        public function getText(): string{
            return $this->texto;
        }
        public function setTexto(string $texto){
            $this->texto = $texto;
        }

        public function getUsuarioId(): string{
            return $this->usuario_id;
        }
        public function setUsuarioId(string $usuario_id){
            $this->usuario_id = $usuario_id;
        }

        public function getLibroId(): string{
            return $this->libro_id;
        }
        public function setLibroId(string $libro_id){
            $this->libro_id = $libro_id;
        }

        public function save($data): bool {

            $ins = $this->db->prepara("INSERT INTO comentarios VALUES(:id, :fecha_publicacion, :texto, :usuario_id, :libro_id)");

            $ins->bindParam(":id", $id);
            $ins->bindParam(":fecha_publicacion", $fecha_publicacion);
            $ins->bindParam(":texto", $texto);
            $ins->bindParam(":usuario_id", $usuario_id);
            $ins->bindParam(":libro_id", $libro_id);

            $id = NULL;
            $fecha_publicacion = date('Y-m-d');
            $texto = addslashes($data['texto']);
            $usuario_id = $data['user_id'];
            $libro_id = $data['libro_id'];

            try {
                $ins->execute();
                $result = true;
            }catch(PDOException $err) {
                $result = false;
            }

            return $result;

        }

        public static function getRandomComentarios($libro_id){

            $comentario = new Comentario();
            $comentarios = $comentario->db->prepara("SELECT * FROM comentarios WHERE libro_id = :libro_id ORDER BY RAND() LIMIT 5"); 

            $comentarios->bindParam(":libro_id", $libro_id);
            $comentarios->execute();

            return $comentarios;

        }


    }