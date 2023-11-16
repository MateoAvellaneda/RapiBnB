<?php
    class Database{
        private $conection;


        public function __construct(){
            try{
                $this->conection = new mysqli('localhost','root','','rapibnb');
                if($this->conection->connect_errno){
                    throw new Exception("Fallo al conectar a MySQL: (" . $this->conection->connect_errno . ")" .  $this->conection->connect_error);
                }    

            }catch(Exception $e){
                echo $e->getMessage();
            }
        }

        public function getConection(){
            return $this->conection;
        }

        public function closeConection(){
            $this->conection->close();
        }
    }


?>