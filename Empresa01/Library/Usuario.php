<?php

/**
* 
*/
class Usuario
{
	public $Id;
	public $usuario;
	public $Password;
	public $Nombre;
	public $Correo;
	public $Rol;
	
	function __construct()
	{
		
	}

	function guardar($mysqli){

		$sql = "INSERT INTO Usuario VALUES (NULL, ?,?,?,?,?)";
		//echo $connect;
		$stmt = $mysqli->prepare($sql);
		
		if ($stmt) {
			$stmt->bind_param("sssss", $this->usuario,$this->Password,$this->Nombre,$this->Correo,$this->Rol);
			$stmt->execute();
			$stmt->close();
			return True;
		}else{
			echo "error al hacer el query";	
			return False;
		}
	}
	static function mostrar($mysqli){
		$sql = "SELECT ID, Usuario, Nombre, Correo, Rol FROM Usuario";
		$stmt=$mysqli->prepare($sql);
		$stmt->execute();
		$stmt->store_result();
		//$rs  = mysqli_query($mysqli,$sql);  // resultado (rs)
		$est = array();
		 $stmt->bind_result($ID,$Usuario , $Nombre, $email , $Rol);

	     while ($stmt->fetch()) 
	     {  
	     	$est[] = $ID;
	     	$est[] = $Usuario ;
	     	$est[] = $Nombre;
	     	$est[] = $email;
	     	$est[] = $Rol;
	      }

	      echo "</pre>";
	      /*
		
		while ($fila = mysqli_fetch_assoc($rs) > 0){
			$est[]   = $fila;
		}*/
		return $est;
	}
}
?>