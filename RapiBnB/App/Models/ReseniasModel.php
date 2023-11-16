<?php
    require_once("../App/Models/Orm.php");


    class ReseñasModel extends Orm{

        public function __construct(mysqli $conection){
            $this->id = 'idReseña';
            $this->table = 'reseñas';
            $this->conection = $conection;
        }

        public function checkReseñaExistente($idOferta){
            $stmt = $this->conection->prepare("SELECT idOferta FROM $this->table WHERE idOferta = ?");
            $stmt->bind_param("i", $idOferta);
            $stmt->execute();
            $coincidencias = $stmt->get_result();
            $stmt->close();
            if($coincidencias->num_rows > 0){
                return true;
            }else{
                return false;
            }
        }

        public function insertReseña($idOferta, $puntuacion, $texto){
            $stmt = $this->conection->prepare("INSERT INTO $this->table (idOferta, puntuacion, texto)
            VALUES (?, ?, ?);");
            $stmt->bind_param("iis", $idOferta, $puntuacion, $texto);
            if($stmt->execute()){
                $stmt->close();
                return true;
            }else{
                $stmt->close();
                return false;
            }
            
        }

        public function extraerReseniasByIdAlq($idAlq){
            $stmt = $this->conection->prepare("SELECT r.*, oa.idPerfil FROM $this->table r
            INNER JOIN ofertasaceptadas oa ON r.idOferta = oa.id
            WHERE oa.idAlq = ?");
            $stmt->bind_param("i", $idAlq);
            $stmt->execute();
            $coincidencias = $stmt->get_result();
            $stmt->close();
            if($coincidencias->num_rows > 0){
                $resenias = array();
                while($fila = $coincidencias->fetch_assoc()){
                    $resenias[] = $fila;
                }
                return $resenias;
            }else{
                return false;
            }
        }
        
    }
?>