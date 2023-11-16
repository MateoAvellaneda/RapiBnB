<?php 
    class ImageController{

        public function publicaciones(){
            $direccionImagen = '../App/Images/fotosPublicaciones/' . $_GET['direccion'];
            if(file_exists($direccionImagen)){
                $imageInfo = getimagesize($direccionImagen);
                $contentType = $imageInfo['mime'];
                header('Content-Type: ' . $contentType);
                readfile($direccionImagen);
            }
        }

        public function documentacion(){
            $direccionImagen = '../App/Images/DocumentacionPerfil/' . $_GET['direccion'];
            if(file_exists($direccionImagen)){
                $imageInfo = getimagesize($direccionImagen);
                $contentType = $imageInfo['mime'];
                header('Content-Type: ' . $contentType);
                readfile($direccionImagen);
            }
        }
    }

?>