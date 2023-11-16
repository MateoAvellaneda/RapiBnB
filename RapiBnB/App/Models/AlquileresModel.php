<?php
    require_once("../App/Models/Orm.php");
    require_once("../App/Classes/Alquiler.php");

    class AlquileresModel extends Orm{

        public function __construct(mysqli $conection){
            $this->id = 'idAlq';
            $this->table = 'alquileres';
            $this->conection = $conection;
        }

        public function insertAlquiler(Alquiler $alquiler, $fechaEspera = null){
            $stmt = $this->conection->prepare("INSERT INTO $this->table (idUsu, titulo, descripcion, provincia,
            ciudad, coordenadas, etiquetas, fotos, servicios, costoDia, minTiempo, maxTiempo, cupo, fechaIni, fechaFin, fechaEspera)
            VALUES (? ,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
            $stmt->bind_param("issssssssdiiisss", $alquiler->idUsu, $alquiler->titulo, $alquiler->descripcion,
                                $alquiler->provincia, $alquiler->ciudad, $alquiler->coordenadas, $alquiler->etiquetas,
                                $alquiler->fotos, $alquiler->servicios, $alquiler->costoDia, $alquiler->minTiempo,
                                $alquiler->maxTiempo, $alquiler->cupo, $alquiler->fechaIni, $alquiler->fechaFin, $fechaEspera);
            if($stmt->execute()){
                $stmt->close();
                return true;
            }else{
                $stmt->close();
                return false;
            }
        }

        public function getByIdUser($idUser){
            $stmt = $this->conection->prepare("SELECT * FROM $this->table WHERE idUsu = ?;");
            $stmt->bind_param("i", $idUser);
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

        public function getByIdUserActivas($idUser){
            $stmt = $this->conection->prepare("SELECT * FROM $this->table WHERE idUsu = ? AND activo = 1;");
            $stmt->bind_param("i", $idUser);
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

        public function getByIdUserDesactivadas($idUser){
            $stmt = $this->conection->prepare("SELECT * FROM $this->table WHERE idUsu = ? AND activo = 0;");
            $stmt->bind_param("i", $idUser);
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

        public function checkByIdUser($idAlq, $idUser){
            $stmt = $this->conection->prepare("SELECT * FROM $this->table WHERE idAlq = ? AND idUsu = ?;");
            $stmt->bind_param("ii", $idAlq, $idUser);
            $stmt->execute();
            $coincidencias = $stmt->get_result();
            $stmt->close();
            if($coincidencias->num_rows > 0){
                return true;
            }else{
                return false;
            }

        }
        
        public function getCant(){
            $stmt = $this->conection->prepare("SELECT COUNT(*) FROM $this->table WHERE activo=true");
            $stmt->execute();
            $cantidad;
            $stmt->bind_result($cantidad);
            $stmt->fetch();
            $stmt->close();
            return $cantidad;
        }

        public function getLimitOffsetAll($limit, $offset){
            $stmt = $this->conection->prepare("SELECT idAlq,fotos,costoDia,provincia,ciudad,idUsu FROM $this->table WHERE activo=true LIMIT ? OFFSET ?");
            $stmt->bind_param("ii", $limit, $offset);
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
        

        public function getCantForm($titulo, $etiquetas, $provincia){
            $titulo = "%" . $titulo . "%";
            $provincia = "%" . $provincia . "%";
            $etiquetas = explode(",", $etiquetas); 
            $query = "SELECT COUNT(*) FROM $this->table
            WHERE (titulo LIKE ?) AND  (provincia LIKE ?) AND activo=true AND";
            for ($i=0; $i<count($etiquetas) ; $i++){
                if($etiquetas[$i] == ""){
                    unset($etiquetas[$i]);
                    continue;
                }
                $query .= " FIND_IN_SET(?,etiquetas) AND "; 
            }
            $query = rtrim($query, " AND ");
            $stmt = $this->conection->prepare($query);
            $stmt->bind_param(str_repeat("s", count($etiquetas) + 2), $titulo, $provincia, ...$etiquetas);
            $stmt->execute();
            $cantidad;
            $stmt->bind_result($cantidad);
            $stmt->fetch();
            $stmt->close();
            return $cantidad;
        }

        public function getLimitOffsetForm($limit, $offset, $titulo, $etiquetas, $provincia){
            $titulo = "%" . $titulo . "%";
            $provincia = "%" . $provincia . "%";
            $etiquetas = explode(",", $etiquetas); 
            $query = "SELECT idAlq,fotos,costoDia,provincia,ciudad,idUsu FROM $this->table
            WHERE (titulo LIKE ?) AND (provincia LIKE ?) AND activo=true AND";
            for ($i=0; $i<count($etiquetas) ; $i++){
                if($etiquetas[$i] == ""){
                    unset($etiquetas[$i]);
                    continue;
                }
                $query .= " FIND_IN_SET(?,etiquetas) AND "; 
            }
            $query = rtrim($query, " AND ");
            $query .= " LIMIT ? OFFSET ?";
            $stmt = $this->conection->prepare($query);
            $tiposBindParams = str_repeat("s", count($etiquetas) + 2) . "ii";
            $parametrosBindParams = array_merge([$tiposBindParams],[$titulo, $provincia],$etiquetas,[$limit, $offset]);
            $nivelOriginalError = error_reporting();
            error_reporting($nivelOriginalError & ~E_WARNING);
            call_user_func_array(array($stmt, 'bind_param'), $parametrosBindParams);
            $stmt->execute();
            error_reporting($nivelOriginalError);
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


        public function getRecomendados($limit, $offset, $intereses){
            $query = "SELECT * FROM $this->table WHERE ";
            for($i=0; $i<count($intereses); $i++){
                $interes = $intereses[$i];
                $query .= 'FIND_IN_SET('."'".$interes."'".',etiquetas) > 0 OR ';
            }
            $query = rtrim($query, " OR ");
            $query .= " AND activo=true ORDER BY RAND() LIMIT $limit";
            $resultados = $this->conection->query($query);
            if($resultados){
                if($resultados->num_rows > 0){
                    $publicaciones = array();
                    while($fila = $resultados->fetch_assoc()){
                        $publicaciones[] = $fila;
                    }
                    return $publicaciones;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }


        public function activarAlquilerById($idAlq){
            $stmt = $this->conection->prepare("UPDATE $this->table SET activo = 1 WHERE idAlq = $idAlq");
            $stmt->execute();
            $stmt->close();
        }

        public function desactivarAlquilerById($idAlq){
            $stmt = $this->conection->prepare("UPDATE $this->table SET activo = 0 WHERE idAlq = $idAlq");
            $stmt->execute();
            $stmt->close();
        }
    }


?>