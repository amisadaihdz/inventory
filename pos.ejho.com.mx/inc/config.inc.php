<?php 

#Descripcion : Reportar Errores, 0 Omitir errores, 1 Reportar Errores
#Descripcion : Reportar Errores, 0 Omitir errores, 1 Reportar Errores
error_reporting(E_ALL);
error_reporting(1);
ini_set('display_errors',1);
################ Librerias, Objetos y Funciones ##############################


include("functions.inc.php");
include("database.class.php");
include("Log.class.php");



##############################################################################
#
#Ruta Web
#Descripcion : Ruta Raiz para el sistema

$SERVER	    =	localhost;
$DATABASE	=	"xxxx";
$USER		=	"xxxx";
$PASS		=	"xxxxxx";
$PORT		=	"xxxx";




#Descripcion : Objeto Log, Objeto BD
$IP					=	getIP();
$LOG				=	new Log("",$IP,"RED");


$WBD	=	new database($LOG, "WRITE", $SERVER, $USER, $PASS, $DATABASE, $PORT);

?>
