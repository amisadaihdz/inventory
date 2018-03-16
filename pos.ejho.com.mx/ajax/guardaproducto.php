<?php
include("../inc/config.inc.php");

$cod = 1;
$msg = 'Error General, Contacte a soporte';
$idprod = 0;

$sku        = $_POST['sku'];
$nombreprd  = $_POST['nombreprd'];
$descprd    = $_POST['descprd'];
$categprd   = $_POST['categprd'];
$costoprd   = $_POST['costoprd'];
$precioprd  = $_POST['precioprd'];
$sfile      =  $_FILES['sfile'];
$unidad     = $_POST['unidad'];


$query = "CALL ejhocomm_pos.sp_insert_productos('$sku','$nombreprd','$descprd','$costoprd','$precioprd', '$categprd','$unidad');";
//echo $query;
$resultado = $WBD->SP( $query );
$data = mysqli_fetch_array($resultado);
$idprod = $data['idprod'];
//echo $idprod;
$target_dir = "../prodimgs/".$idprod.".png";
if($idprod > 0){
    if(isset($_FILES['sfile'])){
        if(move_uploaded_file($_FILES["sfile"]["tmp_name"], $target_dir)){
            $cod = 0;
            $msg = 'Producto Cargado Exitosamente';
        }else{
            
           $cod = 0;
            $msg = 'Producto guardado sin Imagen'; 
        }
    }
}else{
   $cod = 400;
            $msg = 'No se pudo guardar el Producto';  
    
}

$datoss = array("cod" => $cod, "msg" => $msg);

echo json_encode($datoss);

?>