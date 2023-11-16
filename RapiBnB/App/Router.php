<?php
    class Router{
        private $controller;
        private $method;
        
        public function __construct(){
            $this->matchRoute();
        }

        public function matchRoute(){
            //var_dump(URL);
            $url = explode('/', URL);
            //var_dump($url);

            // Si el parametro de controlador viene vacio colocamos por defecto el cotrolador de Home
            if(!empty($url[1])){
                $this->controller = $url[1];
            }else{
                $this->controller = 'Home';
            }
            // Si el parametro de metodo viene vacio colocamos por defecto el metodo de index
            if(!empty($url[2])){
                $this->method = $url[2];
            }else{
                $this->method = 'index';
            }
            
            $this->controller = $this->controller . 'Controller';
            if(file_exists("../App/Controllers/$this->controller.php")){
                require_once("../App/Controllers/".$this->controller.".php");
            }else{
                require_once("../App/Controllers/HomeController.php");   
            }

        }

        public function run(){
            $controller = new $this->controller();
            $method = $this->method;
            $controller->$method();
        }

    }
?>