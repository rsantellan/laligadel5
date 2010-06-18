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
     include("../logica/Player.class.php");
     include("../logica/Round.class.php");
   ?>

   <?php
    if ($_POST["equipo"]<>'' && $_POST["jugador"]<>'' && $_POST["fecha"]<>'' && $_POST["goles"]<>'') {
        include("../logica/TeamPlayerRound.class.php");
        TeamPlayerRound::saveTeamPlayerRound($_POST["equipo"], $_POST["jugador"], $_POST["fecha"], $_POST["goles"]);
        echo 'salvo<br/>';
    }
    ?>
<p>Jugador fecha: </p>
<form id="form1" name="form1" method="post" action="">
  <p>
    <label>Jugador
       <?php $playerList = Player::getAllPlayersAdmin()?>
      <select name="jugador" id="jugador">
        <?php foreach($playerList as $player): ?>
          <option value="<?php echo $player->getId()?>"><?php echo $player->getName()?></option>
         <?php endforeach; ?>
      </select>
      <br />
    </label>
    <label>equipo
        <?php $teamList = Team::getAllTeamsAdmin(); ?>
      <select name="equipo" id="equipo">
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
  </p>
  <p>
    <label>Goles
      <input type="text" name="goles" id="goles" />
    </label>
  </p>
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
