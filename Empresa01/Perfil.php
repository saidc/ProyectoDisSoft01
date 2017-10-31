<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h2>Perfil - Nombre-Usuario</h2>
    <!-- <p><span class="error">* tiene que ingresar Usuario y Contraseña.</span></p> -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <button type="button">Registrarse</button>
      <input type="button" value="Click me">
      <input type="submit" name="Registrarse" value="Log-Out">
    </form>
  </body>
</html>
