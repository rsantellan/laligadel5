<?php session_start ();?>
<?php if(!$_SESSION['userAdmin']):?>
<?php header("location:loginForm.php");?>
<?php else:?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>Agregar Equipo</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
   <?php
    if ($_POST["nombre_equipo"]<>'') {
        include("../logica/Team.class.php");
	Team::saveTeam($_POST["nombre_equipo"]);
        //Player::savePlayer($_POST["nombre_jugador"]);
        echo 'salvo<br/>';
        }
    ?>
    <p>Formulario equipos:</p>
    <form id="form_equipos" name="form_equipos" method="post" action="addTeam.php">
      <p>Nombre:
        <label>
          <input type="text" name="nombre_equipo" id="nombre_equipo" />
        </label>
      </p>
      <p>
        <label>
          <input type="submit" name="enviar_equipo" id="enviar_equipo" value="Guardar" />
        </label>
      </p>
    </form>
    <a href="index.php">Dashboard</a>
  </body>
</html>
<?php endif; ?>
