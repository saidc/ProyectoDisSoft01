<?php 
/**
* 
*/
class connect 
{
	public $mysqli;
	function __construct()
	{

		//$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS, DB_NAME);
		$mysqli = new mysqli('localhost','root','','Empresa01');
		/* verificar la conexión */
		if (mysqli_connect_errno()) {
		    printf("Falló la conexión: %s\n", mysqli_connect_error());
		    exit();
		}

		
		//mysqli_close($enlace);

	}
	function __destruct(){
		mysqli_close($this->mysqli);
	}

}


?>