<?php
####################################log.class####################################
//For break use "\n" instead '\n'
class database{

	public $HOST, $USER, $PASSWORD, $PORT, $DATABASE, $NAME, $TIMEOUT;
	public $COUNT;
	public $LINK;
	public $LOG;

	public $ERROR;

	public function __construct($log,$name,$host,$user,$password,$database,$port = 3306,$timeout = 5)
	{

		$this->NAME			= 	trim($name);
		$this->HOST			= 	trim($host);
		$this->USER			=	trim($user);
		$this->PASSWORD		= 	trim($password);
		$this->DATABASE		=	trim($database);
		$this->TIMEOUT		= 	$timeout;
		$this->PORT		 	= 	$port;

		$this->COUNT		= 	0;

		$this->LOG			=	$log;

		#$this->OLD_ERROR_HANDLER = set_error_handler("self::catchME",E_WARNING);

		self::initDatabase();
	}


	public function setDatabase($NEWDB)
	{
		$this->DATABASE	= ($this->LINK->select_db($NEWDB))?($NEWDB):($this->DATABASE);

		return $this->DATABASE;
	}

	public function getName()
	{
		return $this->NAME;
	}

	public function getPort()
	{
		return $this->PORT;
	}

	public function getHost()
	{
		return $this->HOST;
	}

	public function getDatabase()
	{
		return $this->DATABASE;
	}

	public function error()
	{
		return $this->LINK->error;
	}

	public function lastId()
	{
		return $this->LINK->insert_id;
	}

	public function rowcount()
	{
		return $this->COUNT;
	}

	public function check()
	{
		return (mysqli_connect_error())?(FALSE):(TRUE);
	}

	public function query($QUERY)
	{
		if(self::check()){
			try{
				self::clean_db($this->LINK,NULL,FALSE);
				$RESULT = $this->LINK->query($QUERY);
				self::clean_db($this->LINK,$RESULT,FALSE);

				return $RESULT;

			}catch(Exception $e){

				catchME($e->getCode(),$e->getMessage(),$e->getFile(),$e->getLine());

				return false;
			}
		}else{
			return false;
		}
	}

	public function SP($QUERY)
	{
		if(self::check()){
			try{
				self::clean_db($this->LINK,NULL);
				$RESULT = $this->LINK->query($QUERY);
				self::clean_db($this->LINK,$RESULT);

				return $RESULT;

			}catch(Exception $e){

				catchME($e->getCode(),$e->getMessage(),$e->getFile(),$e->getLine());

				return false;
			}
		}else{
			return false;
		}
	}

	public function ejecutarComando($psComando){
	  $nAfectados = -1;
	  $bResult = false;
	       if ($psComando==""){
		       exit("Error de codificaci&oacute;n, falta indicar el comando");
		   }
		   if (!$this->LINK){
		    exit("Error de codificaci&oacute;n, falta conectar la base");
		   }

		   		self::clean_db($this->LINK,NULL);
				$bResult = $this->LINK->query($psComando);//mysqli_query($this->LINK,$psComando);
				self::clean_db($this->LINK,$bResult);

		   if ($bResult){
		       $nAfectados = mysqli_affected_rows($this->LINK);
           		   }
		   return $nAfectados;
	  }

	function fetch_array($consulta)
 	{
  		return mysqli_fetch_array($consulta);
 	}

 	function num_rows($consulta)
 	{
 		return mysqli_num_rows($consulta);
 	}

 function fetch_row($consulta)
 {
 	 return mysqli_fetch_row($consulta);
 }
 function fetch_assoc($consulta)
 {
 	 return mysqli_fetch_assoc($consulta);
 }








	public function close()
	{
		return $this->LINK->close();
	}

	public function getInfo()
	{
		return $this->LINK->info;
	}
	private function initDatabase()
	{
		$this->LINK = mysqli_init();

		if (!$this->LINK) {

			$this->LOG->error($this->NAME.' : '."Falla al crear link ",FALSE);

			return false;
		}

		if (!mysqli_options($this->LINK, MYSQLI_OPT_CONNECT_TIMEOUT, $this->TIMEOUT)) {

			$this->LOG->error($this->NAME.' : '."Setting MYSQLI_OPT_CONNECT_TIMEOUT failed ",FALSE);

			return false;
		}

		if (!mysqli_real_connect($this->LINK, $this->HOST, $this->USER, $this->PASSWORD, $this->DATABASE, $this->PORT)) {
			$this->LOG->error("Falla en conexion de Base de Datos ".$this->NAME." : ".mysqli_connect_errno(),FALSE);
			#$this->LOG->error($this->NAME.' : '.'Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error(),FALSE);

			return false;
		}

		return true;
	}

	private function catchME($errno,$errstr,$errfile,$errline)
	{
		$this->LOG->db($this->NAME,$errno,$errstr,$errfile,$errline);

		return true;
	}

	private function catchError()
	{
		if($this->LINK->errno > 0)
		{
			$this->ERROR	=	$this->LINK->error;
			$this->LOG->error($this->ERROR);
		}
	}

	private function clean_db($result)
	{
		if($this->LINK->more_results())
		{
			$this->LINK->next_result();
		}

		/**
		while(mysqli_next_result($this->LINK))
		{
			if($l_result = mysqli_store_result($this->LINK))
			{
				mysqli_free_result($l_result);
			}
		}
		**/

		if($result != NULL){
			if(is_resource($result)) {
				mysqli_free_result($result);
			}
		}

		/**
		$result->close();
		while(mysql_result($this->LINK)){}
		if($this->LINK->more_results())
		{
			$this->LINK->next_result();
		}
		**/
	}

	function __destruct() {	}
}
?>