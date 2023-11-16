<?php
    class Orm{

        protected $id;
        protected $table;
        protected $conection;

        public function __construct($id, $table, $conection){
            $this->id = $id;
            $this->table = $table;
            $this->conection = $conection;		
        }

        public function getAll(){
            $stmt = $this->conection->prepare("SELECT * FROM $this->table ;");
            $stmt->execute();
            $resultado = $stmt->get_result();
            $stmt->close();
            if($resultado->num_rows > 0){
                $datos = [];
                while($row = $resultado->fetch_assoc()){
                    $datos[] = $row;
                }
                return $datos;
            }else{
                return false;
            }
        }

        public function getById($id){
            $stmt = $this->conection->prepare("SELECT * FROM $this->table WHERE $this->id = ?;");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $stmt->close();
            if($resultado->num_rows > 0){
                return $resultado->fetch_assoc();
            }else{
                return false;
            }
        }

        public function getNow(){
           return $this->conection->query("SELECT NOW();");
        }
        
        
    
    }


?>