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
     include("../logica/Team.class.php");
     include("../logica/Round.class.php");
   ?>

   <?php
    if ($_POST["equipo_1"]<>'' && $_POST["equipo_2"]<>'' && $_POST["fecha"]<>'') {
        
        
        include("../logica/TeamVsTeam.class.php");
        TeamVsTeam::saveTeamVsTeam($_POST["equipo_1"], $_POST["equipo_2"], $_POST["fecha"]);
        echo 'salvo<br/>';
        }
    ?>

Equipo fecha:
<form id="form1" name="form1" method="post" action="addTeamVsTeam.php">
  <?php $teamList = Team::getAllTeamsAdmin(); ?>
  <label>equipo 1
    <select name="equipo_1" id="equipo_1">
          <?php foreach($teamList as $team): ?>
          <option value="<?php echo $team->getId()?>"><?php echo $team->getName()?></option>
         <?php endforeach; ?>
    </select>
    <br />
  </label>
  <label>equipo 2
    <select name="equipo_2" id="equipo_2">
          <?php foreach($teamList as $team): ?>
          <option value="<?php echo $team->getId()?>"><?php echo $team->getName()?></option>
         <?php endforeach; ?>
    </select>
    <br />
  </label>
    <label>Fecha
        <?php $roundList = Round::getAllRoundsAdmin();?>
      <select name="fecha" id="fecha">
        <?php foreach($roundList as $round): ?>
          <option value="<?php echo $round->getId()?>"><?php echo $round->getName()?></option>
         <?php endforeach; ?>
      </select>
  </label>
  <p>
    <label>
        <input type="submit" name="enviar_jugador_fecha" id="enviar_jugador_fecha" value="Guardar" />
    </label>
  </p>
  
</form>

    <a href="index.php">Dashboard</a>
  </body>
</html>
<?php endif; ?>
