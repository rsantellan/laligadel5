<?php session_start ();?>
<?php if(!$_SESSION['userAdmin']):?>
<?php header("location:loginForm.php");?>
<?php else:?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>Agregar Fecha</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
   <?php
    if ($_POST["nombre_fechas"]<>'') {
        include("../logica/Round.class.php");
        Round::saveRound($_POST["nombre_fechas"]);
        echo 'salvo<br/>';
        }
    ?>
    <p>Formulario fechas:</p>
    <form id="form_fechas" name="form_fechas" method="post" action="addRound.php">
      <p>Nombre:
        <label>
          <input type="text" name="nombre_fechas" id="nombre_fechas" />
        </label>
      </p>
      <p>
        <label>
          <input type="submit" name="enviar_fechas" id="enviar_fechas" value="Guardar" />
        </label>
      </p>
    </form>
    <a href="index.php">Dashboard</a>
  </body>
</html>
<?php endif; ?>
