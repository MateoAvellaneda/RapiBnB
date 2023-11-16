<?php
    require_once("../App/Models/PerfilesModel.php");
    require_once("../App/Models/UsuariosModel.php");
    require_once("../App/Models/AlquileresModel.php");
    require_once("../App/Controllers/BaseController.php");
    require_once("../App/Models/Database.php");
    require_once("../App/Classes/Alquiler.php");

    class PublicarAlquilerController extends BaseController{
        private $usuarioModel;
        private $perfilModel;
        private $alquilerModel;

        public function __construct(){
            $conection = new Database();
            $this->usuarioModel = new UsuariosModel($conection->getConection());
            $this->perfilModel = new PerfilesConexion($conection->getConection());
            $this->alquilerModel = new AlquileresModel($conection->getConection());
        }

        public function __call($nombre_del_método, $argumentos){
            header("location: http://localhost/RapiBnB/Public/PublicarAlquiler");
        }

        public function index(){
            if($this->checkSession()){
                require_once("../App/Views/PublicarAlquilerView.php");
            }else{
                header("location: http://localhost/RapiBnB/Public/InicioSesion");
            }
        }

        public function publicarAlquiler(){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if($this->checkSession()){
                    $publicacion = new Alquiler();
                    $erroresValidacion = $publicacion->validarDatos();
                    if(empty($erroresValidacion)){
                        $usuario = $this->usuarioModel->getById($_SESSION['idUsu']);
                        $alquileres = $this->alquilerModel->getByIdUser($_SESSION['idUsu']);
                        $numeroAlquiler;
                        if($alquileres === false){
                            $numeroAlquiler = 1;
                        }else{
                            $numeroAlquiler = count($alquileres);
                            $numeroAlquiler++;
                        }            
                        $nombreCarpetaFotos = $usuario['nombreUsu'] . $numeroAlquiler;
                        if(empty($publicacion->extraerDatos($nombreCarpetaFotos))){
                            $perfilActual = $this->perfilModel->getByIdUser($_SESSION['idUsu']);
                            if(!$perfilActual['verificado']){
                                date_default_timezone_set('America/Argentina/San_Luis');
                                $fechaEspera = new DateTime();
                                $fechaEspera->modify("+ 3 days");
                                $fechaEspera = $fechaEspera->format('Y-m-d H:i:s');
                                $respuesta = $this->alquilerModel->insertAlquiler($publicacion, $fechaEspera);
                            }else{
                                $respuesta = $this->alquilerModel->insertAlquiler($publicacion);
                            }
                            if($respuesta){
                                $json = json_encode(array('success'=>true, 'message'=>"Publicacion cargada con exito"));
                            }else{
                                $json = json_encode(array('success'=>false, 'message'=>"Hubo un problema al cargar la publicacion en la base de datos"));
                            }
                        }else{
                            $json = json_encode(array('success'=>false, 'message'=>"Hubo un problema al crear la carpeta de fotos"));
                        }
                    }else{
                        $json = json_encode(array('success'=>false, 'message'=>$erroresValidacion));
                    }
                }else{
                    $json = json_encode(array('success'=>false, 'message'=>"No tienes permiso para utilizar esta funcion"));
                }
            }else{
                $json = json_encode(array('success'=>false, 'message'=>"La peticion no se envio por POST"));
            }
            header('Content-Type: application/json');
            echo $json;
        }

        public function publicacionExitosa(){ 
            require_once("../App/Views/PublicacionExitosaView.php");   
        }
    }


?>