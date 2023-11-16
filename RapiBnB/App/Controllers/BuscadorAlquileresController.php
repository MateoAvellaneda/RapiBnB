<?php
    require_once("../App/Models/PerfilesModel.php");
    require_once("../App/Models/UsuariosModel.php");
    require_once("../App/Models/AlquileresModel.php");
    require_once("../App/Controllers/BaseController.php");
    require_once("../App/Models/Database.php");
    require_once("../App/Classes/Alquiler.php");

    class BuscadorAlquileresController extends BaseController{
        private $alquilerModel;
        private $perfilModel;

        public function __construct(){
            $conection = new Database();
            $this->alquilerModel = new AlquileresModel($conection->getConection());
            $this->perfilModel = new PerfilesConexion($conection->getConection());
        }

        public function index(){
            if($this->checkSession()){
                require_once("../App/Views/BuscarAlquileresView/BuscarAlquileresViewUser.php");
            }else{
                require_once("../App/Views/BuscarAlquileresView/BuscarAlquileresViewAnonymous.php");
            }
        }

        public function extraerAlquileres(){
            if($_SERVER["REQUEST_METHOD"] == "GET"){
                if(!isset($_GET['limit'])){
                    $json = json_encode(array('success'=>false, 'message'=>"La variable limit no esta seteada"));
                }elseif(!isset($_GET['page'])){
                    $json = json_encode(array('success'=>false, 'message'=>"La variable page no esta seteada"));
                }else{
                    $limit = $_GET['limit'];
                    $page = $_GET['page'];
                    if($limit < 0 || $page < 0){
                        $json = json_encode(array('success'=>false, 'message'=>"Los valores de limit o page no son validos"));
                    }else{
                        $publicaciones = $this->alquilerModel->getLimitOffsetAll($limit, ($limit * ($page - 1)));
                        if($publicaciones === false){
                            $json = json_encode(array('success'=>true, 'alquileres'=>NULL,'message'=>"No hay resultados"));
                        }else{
                            for($i=0; $i<count($publicaciones); $i++){
                                $perfilPublicacion = $this->perfilModel->getByIdUser($publicaciones[$i]['idUsu']);
                                if($perfilPublicacion['verificado']){
                                    $publicaciones[$i]['verificado'] = true; 
                                }else{
                                    $publicaciones[$i]['verificado'] = false; 
                                }
                            }
                            $json = json_encode(array('success'=>true, 'alquileres'=>$publicaciones ,'message'=>""));
                        }
                    }
                }
            }else{
                $json = json_encode(array('success'=>false, 'message'=>"No se esta accediendo a la api de forma correcta"));
            }
            header('Content-Type: application/json');
            echo $json;
        }

        public function cantidadAlquileres(){
            if($_SERVER["REQUEST_METHOD"] == "GET"){
                $cantidadAlquileres = $this->alquilerModel->getCant();
                $json = json_encode(array('success'=>true, 'cantidad'=>$cantidadAlquileres, 'message'=>''));
            }else{
                $json = json_encode(array('success'=>false, 'message'=>'No se esta accediendo a la api de forma correcta'));
            }
            header('Content-Type: application/json');
            echo $json;
        }
        


        public function cantidadAlquileresForm(){
            if($_SERVER["REQUEST_METHOD"] == "GET"){
                if(isset($_GET['titulo']) && isset($_GET['etiquetas']) && isset($_GET['SelectorProvincia'])){
                    $titulo = $_GET['titulo'];
                    $etiquetas = $_GET['etiquetas'];
                    array_shift($etiquetas);
                    $etiquetas = implode(",", $etiquetas);
                    $provincia = $_GET['SelectorProvincia'];
                    $cantidadAlquileres = $this->alquilerModel->getCantForm($titulo, $etiquetas, $provincia);
                    $json = json_encode(array('success'=>true, 'cantidad'=>$cantidadAlquileres, 'message'=>''));
                }else{
                    $json = json_encode(array('success'=>false, 'message'=>'faltan parametros para utilizar esta API'));
                }
            }else{
                $json = json_encode(array('success'=>false, 'message'=>'No se esta accediendo a la api de forma correcta'));
            }
            header('Content-Type: application/json');
            echo $json;
        }

        public function extraerAlquileresForm(){
            if($_SERVER["REQUEST_METHOD"] == "GET"){
                if(!isset($_GET['limit'])){
                    $json = json_encode(array('success'=>false, 'message'=>"La variable limit no esta seteada"));
                }elseif(!isset($_GET['page'])){
                    $json = json_encode(array('success'=>false, 'message'=>"La variable page no esta seteada"));
                }else{
                    $limit = $_GET['limit'];
                    $page = $_GET['page'];
                    if($limit < 0 || $page < 0){
                        $json = json_encode(array('success'=>false, 'message'=>"Los valores de limit o page no son validos"));
                    }else{
                        if(isset($_GET['titulo']) && isset($_GET['etiquetas']) && isset($_GET['SelectorProvincia'])){
                            $titulo = $_GET['titulo'];
                            $etiquetas = $_GET['etiquetas'];
                            array_shift($etiquetas);
                            $etiquetas = implode(",", $etiquetas);
                            $provincia = $_GET['SelectorProvincia'];
                            $publicaciones = $this->alquilerModel->getLimitOffsetForm($limit, ($limit * ($page - 1)), $titulo, $etiquetas, $provincia);
                            if($publicaciones === false){
                                $json = json_encode(array('success'=>true, 'alquileres'=>NULL,'message'=>"No hay resultados"));
                            }else{
                                for($i=0; $i<count($publicaciones); $i++){
                                    $perfilPublicacion = $this->perfilModel->getByIdUser($publicaciones[$i]['idUsu']);
                                    if($perfilPublicacion['verificado']){
                                        $publicaciones[$i]['verificado'] = true; 
                                    }else{
                                        $publicaciones[$i]['verificado'] = false; 
                                    }
                                }
                                $json = json_encode(array('success'=>true, 'alquileres'=>$publicaciones ,'message'=>""));
                            }  
                        }else{
                            $json = json_encode(array('success'=>false, 'message'=>'faltan parametros para utilizar esta API'));
                        }
                    }
                }
            }else{
                $json = json_encode(array('success'=>false, 'message'=>"No se esta accediendo a la api de forma correcta"));
            }
            header('Content-Type: application/json');
            echo $json;
        }


        public function getRecomendados(){
            $json;
            session_start();
            $perfilActual = $this->perfilModel->getByIdUser($_SESSION['idUsu']);
            if(empty($perfilActual['intereses'])){
                $json = json_encode(array('success'=>false, 'message'=>'El usuario no tiene intereses'));
            }else{
                $intereses = explode(",",$perfilActual['intereses']);
                $publicaciones = $this->alquilerModel->getRecomendados(5, 0, $intereses);
                if($publicaciones != false){
                    $json = json_encode(array('success'=>true,'publicaciones'=>$publicaciones,'message'=>''));
                }else{
                    $json = json_encode(array('success'=>false,'message'=>'No hay coincidencias'));
                }
            }
            header('Content-Type: application/json');
            echo $json;
        }
        
    }
?>