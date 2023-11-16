<?php
    require_once("../App/Models/Orm.php");

    class SolicitudesDeVerificacionModel extends Orm{

        public function __construct(mysqli $conection){
            $this->id = 'id';
            $this->table = 'solicitudesdeverificacion';
            $this->conection = $conection;
        }

        public function insertSolicitud($idPerfil, $fotoFrente, $fotoDorso){
            $stmt = $this->conection->prepare("INSERT INTO $this->table (idPerfil, documentoFrente, documentoDorso)
            VALUES (?, ?, ?);");
            $stmt->bind_param("iss", $idPerfil, $fotoFrente, $fotoDorso);
            if($stmt->execute()){
                $stmt->close();
                return true;
            }else{
                $stmt->close();
                return false;
            }
        }

        public function getByIdPerfil($idPerfil){
            $stmt = $this->conection->prepare("SELECT * FROM $this->table WHERE idPerfil = ?;");
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

        public function deleteSolicitud($idSolicitud){
            $stmt = $this->conection->prepare("DELETE FROM $this->table WHERE id= ?");
            $stmt->bind_param("i", $idSolicitud);
            $stmt->execute();
            $coincidencias = $stmt->get_result();
            $stmt->close();
        }

    }
?>