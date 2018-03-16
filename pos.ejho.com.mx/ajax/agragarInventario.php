<?php
include("../inc/config.inc.php");
$prod       = $_POST['idprod'];
$cantidad   = $_POST['cant'];
$usr        = $_POST['usr'];
$query      = "CALL ejhocomm_pos.sp_procesa_inventario('$prod', '$cantidad', '$usr');";
$resultado  = $WBD->SP( $query );
$data       = mysqli_fetch_array($resultado);
$cod        = $data['cod'];
$msg        = utf8_encode($data['msg']);
$dats       = array("cod"    => $cod, "msg"    => $msg);
echo json_encode($dats);
?>
