<?php
    require_once("../App/Models/Orm.php");


    class RespuestaReseniasModel extends Orm{

        public function __construct(mysqli $conection){
            $this->id = 'idRespuesta';
            $this->table = 'respuestasresenias';
            $this->conection = $conection;
        }

        public function checkRespuestaExistente($idResenia){
            $stmt = $this->conection->prepare("SELECT idRespuesta FROM $this->table WHERE idResenia = ?");
            $stmt->bind_param("i", $idResenia);
            $stmt->execute();
            $coincidencias = $stmt->get_result();
            $stmt->close();
            if($coincidencias->num_rows > 0){
                return true;
            }else{
                return false;
            }
        }

        public function insertRespuesta($idResenia, $texto){
            $stmt = $this->conection->prepare("INSERT INTO $this->table (idResenia, texto)
            VALUES (?, ?);");
            $stmt->bind_param("is", $idResenia, $texto);
            if($stmt->execute()){
                $stmt->close();
                return true;
            }else{
                $stmt->close();
                return false;
            }
            
        }

        public function getRespuestaByIdResenia($idResenia){
            $stmt = $this->conection->prepare("SELECT * FROM $this->table WHERE idResenia = ?");
            $stmt->bind_param("i", $idResenia);
            $stmt->execute();
            $coincidencias = $stmt->get_result();
            $stmt->close();
            if($coincidencias->num_rows > 0){
                $respuesta = $coincidencias->fetch_assoc();
                return $respuesta;
            }else{
                return false;
            }
        }
        
    }
?>