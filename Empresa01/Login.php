<!DOCTYPE HTML>  
<html>
<head>
  <meta charset="utf-8">
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php

$Usuario = $Password = "";
$UsuarioErr = $PasswordErr = "";
$sw = False;

if ($_SERVER["REQUEST_METHOD"] == "POST") {


  if (empty($_POST["Usuario"])) {
    $UsuarioErr = "se requiere el Usuario";
    $sw = False;
  } else {
    $Usuario = test_input($_POST["Usuario"]);
    $sw = True;
  }

  

  if (empty($_POST["Password"])) {
    $PasswordErr = "la clave es requerida";
    $sw = False;
  } else {
    $Password = test_input($_POST["Password"]);
  }  

  if(!empty($_POST["Registrarse"])){
    header("Status: 301 Moved Permanently");
    header("Location: Registro.php");
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

<h2>Login</h2>
<p><span class="error">* tiene que ingresar Usuario y Contraseña.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Usuario: <input type="text" name="Usuario" value="<?php echo $Usuario;?>">
  <span class="error">* <?php echo $UsuarioErr;?></span>
  <br><br>
  Contraseña: <input type="text" name="Password" value="<?php echo $Password;?>">
  <span class="error">* <?php echo $PasswordErr;?></span>
  <br><br>
  <input type="submit" name="Sigin" value="Sig-in">  
  <br><br>
  <input type="submit" name="Registrarse" value="Registrarse">  
</form>

<?php

if($sw){
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

  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS, DB_NAME); // conexion con la base de datos

  
  /* verificar la conexión */
  if (mysqli_connect_errno()) {
      printf("Falló la conexión: %s\n", mysqli_connect_error());
      exit();
  }



  $sql  = "SELECT ID, Usuario, Nombre, Correo, Rol FROM Usuario WHERE Usuario = ? AND Password = ?";
  $stmt = $mysqli->prepare($sql);
  if ($stmt) {
    $stmt->bind_param("ss", $Usuario,$Password);

    $stmt->execute();
    $stmt->store_result();
    //$rs  = mysqli_query($mysqli,$sql);  // resultado (rs)
    $lista = array();
    $stmt->bind_result($ID, $Usuario , $Nombre, $email , $Rol);

    while ($stmt->fetch()) {  
      $lista[] = $ID;
      $lista[] = $Usuario ;
      $lista[] = $Nombre;
      $lista[] = $email;
      $lista[] = $Rol;
    }

    $stmt->close();
    $mysqli->close();
    $arrlength = count($lista);

    for($x = 0; $x < $arrlength;  $x += 5) {

        echo 'ID: '.$lista[$x].'<br>';
        echo 'Usuario: '.$lista[$x + 1].'<br>';
        echo 'Nombre: '.$lista[$x + 2].'<br>';
        echo 'email: '.$lista[$x + 3].'<br>';
        echo 'Rol: '.$lista[$x + 4].'<br>';
        echo "<br>";
    }

  }else{
      echo "Hubo un fallo en la consulta";
  }

}

?>

</body>
</html>
