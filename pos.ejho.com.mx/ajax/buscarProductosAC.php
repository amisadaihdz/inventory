<?php
include("../inc/config.inc.php");
$busq = $_GET['query'];


$squery = "CALL ejhocomm_pos.sp_select_productos_AC('$busq');";

$result =$WBD->query($squery);

while($data = mysqli_fetch_array($result)){
    
    $datos [] = array(
        "data" => $data['nIdProducto'],
        "value" => utf8_encode($data['nombre']),
         "label" => utf8_encode($data['nombre'])
        );
    
}
$json = json_encode(array("suggestions" => 
       $datos));

echo  $json;


?>