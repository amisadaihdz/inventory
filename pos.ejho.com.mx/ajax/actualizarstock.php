<?php
	include("../inc/config.inc.php");
$prod = $_POST['idpsrod'];
$descr = utf8_encode($_POST['descr']);
$exist = $_POST['exist'];
$usu = $_POST['usr'];


$query = "CALL ejhocomm_miapp.SP_UPDATE_PRODUCTO_INVENTARIO_ID('$prod','$descr','$exist','$usu');";

//echo $query;

    $resultado = $WBD->SP( $query );
	$data = mysqli_fetch_array($resultado);

	
	$code = $data['code'];
	$msg = $data['msg'];
	
	
	$datos = array(
	    
	    "code" => $code,
	    "msg" => $msg
	    );
	
	
	echo json_encode($datos);



?>