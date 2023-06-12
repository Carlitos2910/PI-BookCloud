<?php

    namespace Models;
    use Lib\BaseDatos;
    use PDO;
    use PDOException;

    class User{
        private string $id;
        private string $nombre;
        private string $apellidos;
        private string $email;
        private string $phone;
        private string $password;
        private string $rol;

        private BaseDatos $db;


        public function __construct(string $id, string $nombre, string $apellidos, string $email, string $phone, string $password, string $rol){
            $this->db = new BaseDatos();
            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->email = $email;
            $this->phone = $phone;
            $this->password = $password;
            $this->rol = $rol;
        }
        // public function __construct(){
        //     $this->db = new BaseDatos();
        // }

        // Functions Getters & Setters.
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

        public function getEmail(): string{
            return $this->email;
        }

        public function setEmail(string $email){
            $this->email = $email;
        }

        public function getPhone(): string{
            return $this->phone;
        }

        public function setPhone(string $phone){
            $this->phone = $phone;
        }

        public function getPassword(): string{
            return $this->password;
        }

        public function setPassword(string $password){
            $this->password = $password;
        }

        public function getRol(): string{
            return $this->rol;
        }

        public function setRol(string $rol){
            $this->rol = $rol;
        }


        // Function that returns an object from the data given.
        public static function fromArray(array $data): User{
            return new User(
                $data['id'] ?? '',
                $data['nombre'] ?? '',
                $data['apellidos'] ?? '',
                $data['email'] ?? '',
                $data['phone'] ?? '',
                $data['password'] ?? '',
                $data['rol'] ?? '',
            );
        }


        // Function that checks if the email exists and allows the user to login the app.
        public function login(): bool|object{
            
            $result = false;
            $email = $this->email;
            $password = $this->password;

            // Check out if the email exists.
            $usuario = $this->buscaEmail($email);

            if ($usuario !== false){

                // Verify Password.
                $verify = password_verify($password, $usuario->password);

                if($verify){
                    $result = $usuario;
                }
            }

            return $result;
        }


        // Function that insert the new user inside the database.
        public function signin(): bool{
            $insert = $this->db->prepara("INSERT INTO users VALUES(:id,:nombre,:apellidos,:email,:phone,:password,:rol)");

            $insert->bindParam('id', $id);
            $insert->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $insert->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
            $insert->bindParam(':email', $email, PDO::PARAM_STR);
            $insert->bindParam(':phone', $phone, PDO::PARAM_STR);
            $insert->bindParam(':password', $password, PDO::PARAM_STR);
            $insert->bindParam(':rol', $rol, PDO::PARAM_STR);

            $id = NULL;
            $nombre = $this->getNombre();
            $apellidos=$this->getApellidos();
            $email=$this->getEmail();
            $phone=$this->getPhone();
            $password=$this->getPassword();
            $rol = 'user'; 


            try{
                $insert->execute();
                $result = true;
            }catch(PDOException $err){
                $result = false;
            }

            return $result;
        }


        // Function that check if Email Exists in the database,
        public function buscaEmail($email): bool|object{

            $result = false;
            $con = $this->db->prepara("SELECT * FROM users WHERE email = :email");
            $con->bindParam(':email', $email, PDO::PARAM_STR);

            try {
                $con->execute();
                // Check if the email exists in the database;
                if($con && $con->rowCount() == 1){
                    // Return the query object.
                    $result = $con->fetch(PDO::FETCH_OBJ);
                }

            } catch(PDOException $err){
                $result = false;
            }

            return $result;
        }

        public static function getAllUsers(){
            $user = new User('','','','','','','');
            $users = $user->db->prepara("SELECT * FROM users");
            $users->execute();
            return $users;
        }



        public function delete($id): bool{

            $del = $this->db->prepara("DELETE FROM users WHERE id = :id");

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

            $edit = $this->db->prepara("UPDATE users SET nombre = :nombre, apellidos = :apellidos, email = :email, phone = :phone, rol = :rol WHERE id = :id");
            
            $edit->bindParam(":id", $data['id']);
            $edit->bindParam(":nombre", $data['nombre']);
            $edit->bindParam(":apellidos", $data['apellidos']);
            $edit->bindParam(":email", $data['email']);
            $edit->bindParam(":phone", $data['phone']);
            $edit->bindParam(":rol", $data['rol']);

            try{
                $edit->execute();
                $result = true;
            }catch(PDOException $err){
                $result = false;
            }

            return $result;

        }



    }