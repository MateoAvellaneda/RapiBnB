<?php
    require_once("../App/Models/Orm.php");

    class UsuariosModel extends Orm{

        public function __construct(mysqli $conection){
            $this->id = 'idUsu';
            $this->table = 'usuarios';
            $this->conection = $conection;

        }

        public function checkByNamePassw($username, $password){
            $stmt = $this->conection->prepare("SELECT * FROM $this->table WHERE nombreUsu =? AND passw =?");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $coincidencias = $stmt->get_result();
            $stmt->close();
            if($coincidencias->num_rows > 0){
                return true;
            }else{
                return false;
            }
        }

        public function getByName($username){
            $stmt = $this->conection->prepare("SELECT * FROM $this->table WHERE nombreUsu = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $coincidencias = $stmt->get_result();
            $stmt->close();
            if($coincidencias->num_rows > 0){
                return $coincidencias->fetch_assoc();
            }else{
                return false;
            }
        }

        public function getByNamePassw($username, $password){
            $stmt = $this->conection->prepare("SELECT * FROM $this->table WHERE nombreUsu = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $coincidencias = $stmt->get_result();
            $stmt->close();
            if($coincidencias->num_rows > 0){
                $usuario = $coincidencias->fetch_assoc();
                if(password_verify($password, $usuario['passw'])){
                    return $usuario;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }


        public function insertUser($username, $password, $email){
            $stmt = $this->conection->prepare("INSERT INTO $this->table (nombreUsu, passw, gmail)
            VALUES (?, ?, ?);");
            $stmt->bind_param("sss", $username, $password, $email);
            if($stmt->execute()){
                $stmt->close();
                return true;
            }else{
                $stmt->close();
                return false;
            }
        }

        public function deleteUser($username){
            $stmt = $this->conection->prepare("DELETE FROM $this->table WHERE nombreUsu=?;");
            $stmt->bind_param("s", $username);
            if($stmt->execute()){
                $stmt->close();
                return true;
            }else{
                $stmt->close();
                return false;
            }
        }
        

        public function checkInsertUsername($username){
            $stmt = $this->conection->prepare("SELECT * FROM $this->table WHERE nombreUsu=?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $coincidencias = $stmt->get_result();
            $stmt->close();
            if($coincidencias->num_rows == 0){
                return true;
            }else{
                return false;
            }
        }

        public function checkInsertEmail($email){
            $stmt = $this->conection->prepare("SELECT * FROM $this->table WHERE gmail=?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $coincidencias = $stmt->get_result();
            $stmt->close();
            if($coincidencias->num_rows == 0){
                return true;
            }else{
                return false;
            }
        }

        
    }
?>