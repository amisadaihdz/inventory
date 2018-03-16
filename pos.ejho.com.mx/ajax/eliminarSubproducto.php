<?php
include("../inc/config.inc.php");
$nid = $_POST['idinf'];
$query = "CALL  ejhocomm_pos.sp_delete_subproucto('$nid');";
//echo $query;
$resultado = $WBD->SP( $query );
$data = mysqli_fetch_array($resultado);
$datos = array("msg"=>$data['msg']   , "cod"=>$data['cod']  );
echo json_encode($datos);

?>