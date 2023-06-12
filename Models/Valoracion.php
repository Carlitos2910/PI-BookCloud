<?php


    namespace Models;
    use Models\Libro;
    use Lib\BaseDatos;
    use PDO;
    use PDOException;


    class Valoracion{
        private string $id;
        private string $valoraciones;
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
        
        public function getValoraciones(): string{
            return $this->valoraciones;
        }
        public function setValoraciones(string $valoraciones){
            $this->valoraciones = $valoraciones;
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

            $ins = $this->db->prepara("INSERT INTO valoraciones VALUES(:id, :valoraciones, :usuario_id, :libro_id)");

            $ins->bindParam(":id", $id);
            $ins->bindParam(":valoraciones", $valoraciones);
            $ins->bindParam(":usuario_id", $usuario_id);
            $ins->bindParam(":libro_id", $libro_id);

            $id = NULL;
            $valoraciones = $data['estrellas'];
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

        public static function getAllValoracionesFromUserBook($user_id, $libro_id){
            $valoracion = new Valoracion();
            $valoraciones = $valoracion->db->prepara("SELECT COUNT(*) FROM valoraciones WHERE usuario_id = :usuario_id AND libro_id = :libro_id");

            $valoraciones->bindParam(":usuario_id", $user_id);
            $valoraciones->bindParam(":libro_id", $libro_id);
            $valoraciones->execute();

            return $valoraciones;
        }

        public static function getAllValoracionesFromLibroId($id){
            $valoracion = new Valoracion();
            $valoraciones = $valoracion->db->prepara("SELECT COUNT(*) FROM valoraciones WHERE libro_id = :libro_id");

            $valoraciones->bindParam(":libro_id", $id);
            $valoraciones->execute();

            return $valoraciones;
        }


        public static function getLibrosMejorValorados(){
            $valoracion = new Valoracion();
            $valoraciones = $valoracion->db->prepara("SELECT l.*, ROUND(SUM(v.valoraciones)/COUNT(v.valoraciones),1) AS suma_valoraciones
                                                    FROM libros l
                                                    JOIN valoraciones v ON l.id = v.libro_id
                                                    GROUP BY l.id
                                                    ORDER BY suma_valoraciones DESC
                                                    LIMIT 10");
            $valoraciones->execute();
            return $valoraciones;
        }

    }