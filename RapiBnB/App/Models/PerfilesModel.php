<?php
    require_once("../App/Models/Orm.php");
    
    class PerfilesConexion extends Orm{
        public function __construct(mysqli $conection){
            $this->id = 'idPerfil';
            $this->table = 'perfiles';
            $this->conection = $conection;
        }


        public function getByIdUser($idUser){
            $stmt = $this->conection->prepare("SELECT * FROM $this->table WHERE idUsu = ?;");
            $stmt->bind_param("i", $idUser);
            $stmt->execute();
            $coincidencias = $stmt->get_result();
            $stmt->close();
            if($coincidencias->num_rows > 0){
                return $coincidencias->fetch_assoc();
            }else{
                return false;
            }
        }

        public function insertPerfil($idUser){
            $stmt = $this->conection->prepare("INSERT INTO $this->table (idUsu)
            VALUES (?);");
            $stmt->bind_param("i", $idUser);
            if($stmt->execute()){
                $stmt->close();
                return true;
            }else{
                $stmt->close();
                return false;
            }
        }


        public function updateImagen($idUser, $imageUrl){
            $stmt = $this->conection->prepare("UPDATE $this->table SET foto = ?, verificado='0' WHERE idUsu = ?;");
            $stmt->bind_param("si", $imageUrl, $idUser);
            if($stmt->execute()){
                $stmt->close();
                return true;
            }else{
                $stmt->close();
                return false;
            }
        }

        public function updateNombre($idUser, $nombre){
            $stmt = $this->conection->prepare("UPDATE $this->table SET nombre = ?, verificado='0' WHERE idUsu = ?;");
            $stmt->bind_param("si", $nombre, $idUser);
            if($stmt->execute()){
                $stmt->close();
                return true;
            }else{
                $stmt->close();
                return false;
            }
        }
    
        public function updateApellido($idUser, $apellido){
            $stmt = $this->conection->prepare("UPDATE $this->table SET apellido = ?, verificado='0' WHERE idUsu = ?;");
            $stmt->bind_param("si", $apellido, $idUser);
            if($stmt->execute()){
                $stmt->close();
                return true;
            }else{
                $stmt->close();
                return false;
            }
        }

        public function updateTipoDoc($idUser, $tipoDoc){
            $stmt = $this->conection->prepare("UPDATE $this->table SET tipoDoc = ?, verificado='0' WHERE idUsu = ?;");
            $stmt->bind_param("si", $tipoDoc, $idUser);
            if($stmt->execute()){
                $stmt->close();
                return true;
            }else{
                $stmt->close();
                return false;
            }
        }

        public function updateNumDoc($idUser, $numDoc){
            $stmt = $this->conection->prepare("UPDATE $this->table SET numDoc = ?, verificado='0' WHERE idUsu = ?;");
            $stmt->bind_param("si", $numDoc, $idUser);
            if($stmt->execute()){
                $stmt->close();
                return true;
            }else{
                $stmt->close();
                return false;
            }
        }

        public function updateIntereses($idUser, $intereses){
            $stmt = $this->conection->prepare("UPDATE $this->table SET intereses = ?, verificado='0' WHERE idUsu = ?;");
            $stmt->bind_param("si", $intereses, $idUser);
            if($stmt->execute()){
                $stmt->close();
                return true;
            }else{
                $stmt->close();
                return false;
            }
        }

        public function updateVerificado($idPerfil, $verificado){
            $stmt = $this->conection->prepare("UPDATE $this->table SET verificado = ? WHERE idPerfil = ?;");
            $stmt->bind_param("ii", $verificado, $idPerfil);
            if($stmt->execute()){
                $stmt->close();
                return true;
            }else{
                $stmt->close();
                return false;
            }
        }
    

        public function getNombreApellidoById($idPerfil){
            $stmt = $this->conection->prepare("SELECT nombre,apellido FROM $this->table WHERE idPerfil = ?;");
            $stmt->bind_param("i", $idPerfil);
            $stmt->execute();
            $coincidencias = $stmt->get_result();
            $stmt->close();
            if($coincidencias->num_rows > 0){
                return $coincidencias->fetch_assoc();
            }else{
                return false;
            }
        }
    }
?>