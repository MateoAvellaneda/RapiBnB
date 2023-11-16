<?php
    require_once("../App/Controllers/BaseController.php");
    require_once("../App/Models/PerfilesModel.php");
    require_once("../App/Models/ReseniasModel.php");
    require_once("../App/Models/OfertasAceptadasModel.php");
    require_once("../App/Models/Database.php");
    require_once("../App/Models/RespuestaReseniasModel.php");


    class ReseniasController extends BaseController{
        private $perfilesModel;
        private $reseñasModel;
        private $ofertasAceptadasModel;
        private $respuestasModel;


        public function __construct(){
            $conection = new Database();
            $this->ofertasAceptadasModel = new OfertasAceptadasModel($conection->getConection());
            $this->perfilesModel = new PerfilesConexion($conection->getConection());
            $this->reseñasModel = new ReseñasModel($conection->getConection());
            $this->respuestasModel = new RespuestaReseniasModel($conection->getConection());
        }


        public function publicarResenia(){
            $json;
            if(!$this->checkSession()){
                $json = json_encode(array('success'=>false, 'message'=>"No tiene permisos para usar este metodo"));
            }elseif(!isset($_POST['idOferta']) || !isset($_POST['puntuacion'])){
                $json = json_encode(array('success'=>false, 'message'=>"Datos faltantes"));
            }else{
                $perfilActual = $this->perfilesModel->getByIdUser($_SESSION['idUsu']);
                $ofertaActual = $this->ofertasAceptadasModel->getById($_POST['idOferta']);
                $idOferta = $ofertaActual['idPerfil'];
                $idPerfil = $perfilActual['idPerfil'];
                if($idOferta != $idPerfil){
                    $json = json_encode(array('success'=>false, 'message'=>"No es el dueño de esta oferta"));
                }elseif($perfilActual['verificado'] == false){
                    $json = json_encode(array('success'=>false, 'message'=>"Solo los usuarios verificados pueden reseñar los alquileres"));
                }else{
                    if($this->reseñasModel->checkReseñaExistente($ofertaActual['id'])){
                        $json = json_encode(array('success'=>false, 'message'=>"Esta oferta ya tiene una reseña"));
                    }elseif(!empty($_POST['descripcionResenia'])){
                        if($this->reseñasModel->insertReseña($_POST['idOferta'], $_POST['puntuacion'], $_POST['descripcionResenia'])){
                            $json = json_encode(array('success'=>true, 'message'=>""));
                        }else{
                            $json = json_encode(array('success'=>false, 'message'=>"Ocurrio un error al ingresar la reseña"));
                        }
                    }else{
                        if($this->reseñasModel->insertReseña($_POST['idOferta'], $_POST['puntuacion'], null)){
                            $json = json_encode(array('success'=>true, 'message'=>""));
                        }else{
                            $json = json_encode(array('success'=>false, 'message'=>"Ocurrio un error al ingresar la reseña"));
                        }
                    }
                }
            }
            header('Content-Type: application/json');
            echo $json;
        }



        public function estraerReseniasAlquiler(){
            if(!isset($_GET['idAlq'])){
                $json = json_encode(array('success'=>false, 'message'=>"error, no se encuentra la variable idAlq"));
            }else{
                $resenias = $this->reseñasModel->extraerReseniasByIdAlq($_GET['idAlq']);
                if($resenias == false){
                    $json = json_encode(array('success'=>false, 'message'=>"No hay reseñas para este alquiler"));
                }else{
                    $respuestasResenias = array();
                    for($i=0;$i<count($resenias);$i++){
                        $nombreCompletoPerfil = $this->perfilesModel->getNombreApellidoById($resenias[$i]['idPerfil']);
                        $resenias[$i]['nombre'] = $nombreCompletoPerfil['nombre'];
                        $resenias[$i]['apellido'] = $nombreCompletoPerfil['apellido'];
                        $resp = $this->respuestasModel->getRespuestaByIdResenia($resenias[$i]['idReseña']);
                        if($resp != false){
                            $respuestasResenias[] = $resp;
                        }
                    }
                    $json = json_encode(array('success'=>true,'resenias'=>$resenias, 'respuestas'=>$respuestasResenias,'message'=>""));
                }
            }
            header('Content-Type: application/json');
            echo $json;
        }


        public function PublicarRespuestaResenia(){
            $json;
            if(!$this->checkSession()){
                $json = json_encode(array('success'=>false, 'message'=>"No tienes permiso para usar este metodo"));
            }elseif(!isset($_POST['respuesta']) || !isset($_POST['idResenia'])){
                $json = json_encode(array('success'=>false, 'message'=>"Datos faltantes"));
            }else{
                $checkRespuesta = $this->respuestasModel->checkRespuestaExistente($_POST['idResenia']);
                if($checkRespuesta){
                    $json = json_encode(array('success'=>false, 'message'=>"Esta reseña ya tiene respuesta"));
                }elseif(empty($_POST['respuesta'])){
                    $json = json_encode(array('success'=>false, 'message'=>"La respuesta esta vacia"));
                }else{
                    $insertRespuesta = $this->respuestasModel->insertRespuesta($_POST['idResenia'],$_POST['respuesta']);
                    if($insertRespuesta){
                        $json = json_encode(array('success'=>true, 'message'=>""));
                    }else{
                        $json = json_encode(array('success'=>false, 'message'=>"Hubo un problema al cargar la respuesta"));
                    }
                }
            }
            header('Content-Type: application/json');
            echo $json;
        }
    }
?>