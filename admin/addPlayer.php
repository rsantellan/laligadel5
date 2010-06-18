<?php session_start ();?>
<?php if(!$_SESSION['userAdmin']):?>
<?php header("location:loginForm.php");?>
<?php else:?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>Agregar jugador</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
   <?php
    if ($_POST["nombre_jugador"]<>'') {
        include("../logica/Player.class.php");
	Player::savePlayer($_POST["nombre_jugador"]);
    }
    ?>
    <p>Formulario jugadores:</p>
    <form id="form_jugadores" name="form_jugadores" method="post" action="addPlayer.php">
    <p>Nombre:
        <label>
            <input type="text" name="nombre_jugador" id="nombre_jugador" />
        </label>
    </p>
    <p>
        <label>
            <input type="submit" name="enviar_jugador" id="enviar_jugador" value="Guardar" />
        </label>
    </p>
    </form>

    <a href="index.php">Dashboard</a>
  </body>
</html>
<?php endif; ?>