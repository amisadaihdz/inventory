<?php 
##############################################################################
#
#Corresponsal V4.0 - Funciones Globales
#
#

##############################################################################
#
#Funciones Generales
#

#Funcion getIP()
#Recibe NULL
#Regresa $ip : Direccion IP inmediata o ultima en caso de Web Proxy
#Descripcion : Funcion que obtene la direccion IP del visitante
#Creado 3 Sept 2008
#Autor	Ing. Francisco Renteria
#Ultima Modificacion: 21 Marzo 2009 por Francisco Renteria

function getIP(){
	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
	}else{
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	$ip_array = explode(",", $ip);
	$ip = trim($ip_array[0]);
	return $ip;
}

#Funcion error()
#Recibe $ERROR_DATA, $IP
#Regresa NULL
#Descripcion : Envia correo con error
#Creado 25 Noviembre 2009
#Autor	Ing. Francisco Renteria
#Ultima Modificacion: 25 Noviembre 2009 por Francisco Renteria

function error($ERROR_DATA,$MAIL = FALSE){
	
	global $AUTORIZADOR, $O_LOG;
	
	$ERROR_DATA	= ($ERROR_DATA)?($ERROR_DATA):('N/A');
	
	$O_LOG->error($ERROR_DATA,$MAIL);

	return true;
}

#Funcion generateCode()
#Recibe $length, $strength
#Regresa NULL
#Descripcion : GENERA UN CODIGO RANDOM
#Creado 18 Julio 2011
#Autor	Ing. Francisco Renteria
#Ultima Modificacion: 18 Julio 2011 por Francisco Renteria

function generateCode($length = 10)
{
     if ($length <= 0)
    {
        return false;
    }
 
    $code = "";
    $chars = "ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
    srand((double)microtime() * 1000000);
    for ($i = 0; $i < $length; $i++)
    {
        $code = $code . substr($chars, rand() % strlen($chars), 1);
    }
    return $code;
 
}

#Funcion generateSessionCode()
#Recibe $length, $strength
#Regresa NULL
#Descripcion : GENERA UN CODIGO PARA LA SESSION NUEVO
#Creado 28 Nov 2008
#Autor	Ing. Francisco Renteria
#Ultima Modificacion: 12 Feb 2009 por Francisco Renteria

function generateSession($length = 10)
{
     if ($length <= 0)
    {
        return false;
    }
 
    $code = "";
    $chars = "abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
    srand((double)microtime() * 1000000);
    for ($i = 0; $i < $length; $i++)
    {
        $code = $code . substr($chars, rand() % strlen($chars), 1);
    }
    return $code;
 
}

#Funcion putCookie()
#Recibe $CODE : Codigo de autorizacion del corresponsal 8 Caracteres
#Regresa NULL
#Descripcion : Establece coookie LOGINRE con el codigo del corresponsal 
#Creado 3 Sept 2008
#Autor	Ing. Francisco Renteria
#Ultima Modificacion: 12 Feb 2009 por Francisco Renteria

function putCookie($CODE)
{
	setcookie("LOGINRE", $CODE, time()+604800);  /* expire in 1 hour */ 
	//setcookie("LOGINRE", $CODE, time()+31536000, "/", ".redefectiva.net", 0);
}

#Funcion getCookie()
#Recibe 
#Regresa NULL
#Descripcion : Lee el codigo si exite de los cookies 
#Creado 1 Dic 2008
#Autor	Ing. Francisco Renteria
#Ultima Modificacion: 12 Feb 2009 por Francisco Renteria

function getCookie()
{
	$codigo = 0;
	if(isset($_COOKIE['LOGINRE']))
	{ 
		$codigo = $_COOKIE['LOGINRE'];
	}
	return $codigo;
}

//NORMALIZA LOS CARACTERES RAROS DE LAS CADENAS
function Normalizar($string){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyyby';
    $aux = "";
    $band = true;
    for($i = 0;$i < strlen($string);$i++){
        $band = true;
        for($j = 0;$j < strlen($originales);$j++){
            if($string[$i] == $originales[$j]){
              $aux.=$modificadas[$j];
              $band = false;
            }
        }
        if($band)
            $aux.=$string[$i];
    }
    return utf8_encode($aux);
}


/**
 * Convierte un número de formato String a Decimal
 * 
 * Función que convierte un texto en formato decimal.<br/>
 * Se utiliza principalmente para eliminar el signo de Moneda y las comas<br/>
 * para poder guardar su valor correctamente en la Base de Datos<br/>
 * Fecha de modificación: 02 de Abril del 2014
 * 
 * @param string $str String en formato de moneda
 * @return número decimal
 * @author César Cavazos <ccavazos@mpsystems.com.mx>
 */
function toInt($str) {
    return preg_replace("/([^0-9\\.])/i", "", $str);
}

/**
 * Convierte un número de formato Decimal a String
 * 
 * Función que convierte un número decimal en formato moneda.<br/>
 * Se utiliza principalmente para agregarle comas y el signo de pesos.<br/>
 * Su principal función es solamente darle formato para el usuario final<br/>
 * Fecha de modificación: 02 de Mayo del 2014
 * 
 * @param decimal $number Numero Decimal a convertir
 * @param number $decimal Número entero para determinal en número de decimales
 * @return número en formato moneda
 * @author César Cavazos <ccavazos@mpsystems.com.mx>
 */
function toCurrency($number, $decimal = 2) {
    return "$" . number_format($number, $decimal);
}

function codificarUTF8( $texto ) {
	if ( !preg_match('!!u', $texto) ) {
		/* Si entro aqui quiere decir que no es utf8
		y por lo tanto debe ser codificado */
		$texto = utf8_encode($texto);
	}
	return $texto;
}

#
#Fin de Archivo
#
##############################################################################
?>