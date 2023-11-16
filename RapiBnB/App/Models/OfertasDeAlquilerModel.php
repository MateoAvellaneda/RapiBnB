<?php
    require_once("../App/Models/Orm.php");
    class OfertasDeAlquilerModel extends Orm{
        
        public function __construct(mysqli $conection){
            $this->id = 'idOferta';
            $this->table = 'ofertasdealquiler';
            $this->conection = $conection;
        }

        public function checkByIdPerfil($idAlq, $idPerfil){
            $stmt = $this->conection->prepare("SELECT * FROM $this->table WHERE idAlq = ? AND idPerfil = ? AND estado='pendiente';");
            $stmt->bind_param("ii", $idAlq, $idPerfil);
            $stmt->execute();
            $coincidencias = $stmt->get_result();
            $stmt->close();
            if($coincidencias->num_rows == 0){
                return true;
            }else{
                return false;
            }
        }


        public function insertOferta($idAlq, $idPerfil, $fechaIni, $fechaFin, $cantPersonas, $nombre ,$telefono, $email){
            $stmt = $this->conection->prepare("INSERT INTO $this->table (idAlq, idPerfil, nombre, telefono,
            email, cantPersonas, fechaIni, fechaFin) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iisssiss", $idAlq, $idPerfil, $nombre, $telefono, $email, $cantPersonas
            , $fechaIni, $fechaFin);
            if($stmt->execute()){
                $stmt->close();
                return true;
            }else{
                $stmt->close();
                return false;
            }
        }

        public function getPendientesByIdAlq($idAlq){
            $stmt = $this->conection->prepare("SELECT * FROM $this->table WHERE idAlq = ? AND estado ='pendiente';");
            $stmt->bind_param("i", $idAlq);
            $stmt->execute();
            $coincidencias = $stmt->get_result();
            $stmt->close();
            if($coincidencias->num_rows > 0){
                $resultados = array();
                while($fila = $coincidencias->fetch_assoc()){
                    $resultados[] = $fila;
                }
                return $resultados;
            }else{
                return false;
            }
        }

        public function getAllByIdPerfil($idPerfil){
            $stmt = $this->conection->prepare("SELECT * FROM $this->table WHERE idPerfil = ?;");
            $stmt->bind_param("i", $idPerfil);
            $stmt->execute();
            $coincidencias = $stmt->get_result();
            $stmt->close();
            if($coincidencias->num_rows > 0){
                $resultados = array();
                while($fila = $coincidencias->fetch_assoc()){
                    $resultados[] = $fila;
                }
                return $resultados;
            }else{
                return false;
            }
        }
        


        public function updateEstadoAceptada($idOferta){
            $stmt = $this->conection->prepare("UPDATE $this->table SET estado = 'aceptada' WHERE idOferta = $idOferta");
            $stmt->execute();
            $stmt->close();
        }

        public function updateEstadoRechazada($idOferta){
            $stmt = $this->conection->prepare("UPDATE $this->table SET estado = 'rechazada' WHERE idOferta = $idOferta");
            $stmt->execute();
            $stmt->close();
        }
    }

?>