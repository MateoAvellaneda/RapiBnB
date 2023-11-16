<?php
    require_once("../App/Models/Orm.php");

    class OfertasAceptadasModel extends Orm{

        public function __construct(mysqli $conection){
            $this->id = 'id';
            $this->table = 'ofertasaceptadas';
            $this->conection = $conection;
        }

        public function getByIdAlq($idAlq){
            $stmt = $this->conection->prepare("SELECT * FROM $this->table WHERE idAlq = ?;");
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

        public function fechaDisponible($idAlq, $fechaIni, $fechaFin){
            $stmt = $this->conection->prepare("SELECT * FROM $this->table 
                WHERE (idAlq = ?) AND 
                (
                    (fechaIni BETWEEN ? AND ?) OR 
                    (fechaFin BETWEEN ? AND ?) OR 
                    (fechaIni <= ? AND fechaFin >= ?)
                )");
            $stmt->bind_param("issssss", $idAlq, $fechaIni, $fechaFin, $fechaIni, $fechaFin, $fechaIni, $fechaFin);
            $stmt->execute();
            $coincidencias = $stmt->get_result();
            $stmt->close();
            
            if($coincidencias->num_rows == 0){
                return true;
            } else {
                return false;
            }
        }
        

        public function getEnProcesoByIdAlq($idAlq){
            $stmt = $this->conection->prepare("SELECT * FROM $this->table WHERE idAlq = ? AND fechaFin >= DATE(NOW());");
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

        public function getFinalizadasByIdAlq($idAlq){
            $stmt = $this->conection->prepare("SELECT * FROM $this->table WHERE idAlq = ? AND fechaFin < DATE(NOW());");
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

    }
?>