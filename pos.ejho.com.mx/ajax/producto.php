<?php
	include("../inc/config.inc.php");
$prod = $_POST['idprod'];

$query = "CALL ejhocomm_pos.SP_SELECT_PRODUCTO_INVENTARIO_ID('$prod');";

$resultado = $WBD->SP( $query );
	$data = mysqli_fetch_array($resultado);

	$sku         = $data['sku'];
	$idProd      = $data['nIdProducto'];
	$nombre      = utf8_encode($data['sNombreProd']);
	$descripcion = utf8_encode($data['sDescrpcionProd']);
    $categ       = $data['nIdCategoria'];
	$costo       = $data['nCosto'];
	$precio      = $data['nPrecio'];
	$unidad      = $data['nIdUnidad'];
	$url         = $data['url'];
	$stok        = $data['nstok'];
	$disponible  = $data['nDisponible'];
	

	$datos = array(
	 
	    "sku"           => $sku,
	    "idProd"        => $idProd,
	    "nombre"        => $nombre,
	    "descripcion"   => $descripcion,
	    "categ"         => $categ,
	    "costo"         => $costo,
	    "precio"        => $precio,
	    "unidad"        => $unidad,
	    "url"           => $url,
	    "stok"          => $stok,
	    "disponible"    => $disponible
	    );
	
	
	echo json_encode($datos);



?>