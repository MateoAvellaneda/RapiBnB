<?php
    class Perfil{
        private $nombre;
        private $apellido;
        private $tipoDoc;
        private $numDoc;
        private $foto;
        private $intereses;

        public function __construct($nombre = NULL, $apellido = NULL, $tipoDoc = NULL, $numDoc = NULL, $foto = NULL, $intereses = NULL){
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->tipoDoc = $tipoDoc;
            $this->numDoc = $numDoc;
            $this->foto = $foto;
            $this->intereses = $intereses;
        }

        public function __get($dato){
            return $this->$dato;
        }

        public function __set($dato, $valor){
            $this->$dato = $valor;
        }

    }


?>