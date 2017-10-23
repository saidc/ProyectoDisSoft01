<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
/*
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('DB_NAME', 'Empresa01');
*/

  define('DB_HOST', 'fdb14.biz.nf');
  define('DB_USER', '2077544_empresa01');
  define('DB_PASS', 'ProyectoDisSoft01');
  define('DB_NAME', 'Empresa01');

include('Library/motor.php');

$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS, DB_NAME); // coneccion con la base de datos
/* verificar la conexión */
if (mysqli_connect_errno()) { // ver si la conexion fue exitosa 
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
}

$Usuario = new Usuario();


$UsuarioErr = $NombreErr = $emailErr = $PasswordErr = $RolErr = "";
$sw = False;

if ($_SERVER["REQUEST_METHOD"] == "POST") {


  if (empty($_POST["Usuario"])) {
    $UsuarioErr = "se requiere el Usuario";
    $sw = False;
  } else {
    $Usuario->usuario = test_input($_POST["Usuario"]);
    $sw = True;
  }

  
  if (empty($_POST["Nombre"])) {
    $NombreErr = "El nombre es requerido";
    $sw = False;
  } else {
    $Usuario->Nombre = test_input($_POST["Nombre"]);
  }  


  if (empty($_POST["email"])) {
    $emailErr = "El Correo es requerido";
    $sw = False;
  } else {
    $Usuario->Correo = test_input($_POST["email"]);
    if (!filter_var($Usuario->Correo, FILTER_VALIDATE_EMAIL) ) {
      $emailErr = "Formato invalido de Correo"; 
      $sw = False;
    }
  }


  if (empty($_POST["Password"])) {
    $PasswordErr = "La clave es requerida";
    $sw = False;
  } else {
    $Usuario->Password = test_input($_POST["Password"]);
  }  

  
  if (empty($_POST["Rol"])) {
    $RolErr = "El Rol es requerido";
    $sw = False;
  } else {
    $Usuario->Rol = test_input($_POST["Rol"]);
  }

  if(!empty($_POST["Login"])){ // agregar condicional de que pueda ser una equivocacion 
    header("Status: 301 Moved Permanently");
    header("Location: Login.php");
    exit;
  }
  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<input type="submit" name="Login" value="<--">  
<h2>Registro</h2>
<p><span class="error">* debe llenar todos los campos.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Usuario: <input type="text" name="Usuario" value="<?php echo $Usuario->usuario;?>">
  <span class="error">* <?php echo $UsuarioErr;?></span>
  <br><br>
  Nombre: <input type="text" name="Nombre" value="<?php echo $Usuario->Nombre;?>">
  <span class="error">* <?php echo $NombreErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php echo $Usuario->Correo;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Contraseña: <input type="text" name="Password" value="<?php echo $Usuario->Password;?>">
  <span class="error">* <?php echo $PasswordErr;?></span>
  <br><br>
  Rol:
  <input type="radio" name="Rol" value="Adm00">Administrador
  <input type="radio" name="Rol" value="Tra00">Trabajador
  <input type="radio" name="Rol" value="Int00">Interno
  <span class="error">* <?php echo $RolErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>


<?php


if($sw){
  echo "<br>"; 
  echo "<h1>Guardado: ".$Usuario->guardar($mysqli)."</h1>";
  echo "<br>";

  $lista = $Usuario->mostrar($mysqli);
  $arrlength = count($lista);

  for($x = 0; $x < $arrlength;  $x += 5) {

      echo 'ID: '.$lista[$x].'<br>';
      echo 'Usuario: '.$lista[$x + 1].'<br>';
      echo 'Nombre: '.$lista[$x + 2].'<br>';
      echo 'email: '.$lista[$x + 3].'<br>';
      echo 'Rol: '.$lista[$x + 4].'<br>';
      echo "<br>";
  }

}





$mysqli->close();
?>

</body>
</html>