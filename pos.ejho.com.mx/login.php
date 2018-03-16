<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("./inc/config.inc.php");


session_start();
$message="";

	
	

if(count($_POST)>0) {

$user = $_POST['txtusr'];
$pass = $_POST['txtpass'];
    
    $sQuery = "CALL ejhocomm_pos.sp_login('$user','$pass');";
    $result = $WBD->SP( $sQuery );
	$DATA = mysqli_fetch_array($result);
	


    if(is_array($DATA)) {
        $_SESSION["userid"] = $DATA['nIdUsuario'];
        $_SESSION["nombre"] = $DATA['nombre'];
        
        //echo $_SESSION["userid"];
       

       
    } else {
        $message = "Usuario o Clave Invalidos......";
    }
}
 if(isset($_SESSION["userid"])) {
header("Location: inventario.php");
}

?>