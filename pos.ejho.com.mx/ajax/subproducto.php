<?php
	include("../inc/config.inc.php");
	
$prod = $_POST['idprod'];

$datos = array();

$query = "CALL ejhocomm_pos.sp_select_subproductos('$prod');";

$resultado = $WBD->SP( $query );
while($data = mysqli_fetch_array($resultado)){
    
    $idProd     = $data['nIdProducto'];
	$idSubProd  = $data['nIdSubProducto'];
	$nombre     = utf8_encode($data['sNombreProd']);
	$precio     = $data['nPrecio'];
    $url        = $data['url'];
    $id         = $data['nId'];
    $req         = $data['nCantidad'];
    $disp         = $data['nDisponible'];
    

    $dats = array(
	    "idProd"    => $idProd,
	    "idSubProd" => $idSubProd,
	    "nombre"    => $nombre,
	    "precio"    => $precio,
	     "surl"     => $url,
	     "id"       => $id,
	     "req"      => $req,
	     "disp"     => $disp,
	    );
	    
$datos[]= $dats;	    
};

	
	
	
	
	
	echo json_encode($datos);



?>