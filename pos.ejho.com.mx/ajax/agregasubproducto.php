<?php
include("../inc/config.inc.php");
$prod       = $_POST['idproducto'];
$subprod    = $_POST['subprod'];
$cantidad   = $_POST['cantidad'];
$squery     = "CALL ejhocomm_pos.sp_insert_subproductos('$prod','$subprod','$cantidad');";
//echo $squery;
$result     =$WBD->query($squery);
$data       = mysqli_fetch_array($result);
    $datos  = array(
      "cod" => $data['cod'],
      "msg" => utf8_encode($data['msg'])
        );
echo json_encode($datos);
?>