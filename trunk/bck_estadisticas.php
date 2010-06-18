<?php include('header.php') ?>
<link href="css/tabla.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				auto: true, 
				continuous: true
			});
      		$('#menu_estadistica').addClass('active');
		});	
	</script>
<?php include('closeHeader.php')?>

<?php include('logoAndMenu.php')?>

<div id="body">
	<h2 class="title">Estadisticas</h2>
        <div class="story">
		<p>
	<?php include('logica/TeamVsTeam.class.php')?>

        <?php $testList = TeamVsTeam::getTeamListPosition() ?>
        <?php $index = count($testList)-1; ?>
		<table align="center">
			<tr>
				<th>Cuadro</th>
				<th>Jugados</th>
				<th>Ganados</th>
				<th>Empatados</th>
				<th>Perdidos</th>
                                <th>GF</th>
                                <th>GC</th>
                                <th>Puntos</th>
			</tr>
                        <?php while($index >= 0):?>
			<tr>
				<td><?php echo $testList[$index]['name'] ?></td>
				<td><?php echo ($testList[$index]['won'] + $testList[$index]['tie'] + $testList[$index]['lost']) ?></td>
				<td><?php echo $testList[$index]['won'] ?></td>
				<td><?php echo $testList[$index]['tie'] ?></td>
				<td><?php echo $testList[$index]['lost'] ?></td>
                                <td><?php echo $testList[$index]['goalsFavor'] ?></td>
                                <td><?php echo $testList[$index]['goalsAgainst'] ?></td>
                                <td><?php echo $testList[$index]['points'] ?></td>
			</tr>
                        <?php $index--; ?>
                        <?php endwhile; ?>
                       	

		</table>
		<br/>
		
		<hr/>
		<?php //include("logica/Player.class.php");?>
		
		<?php $list = Player::getAll();?>
		

		
		<!-- Table markup-->
	<h2>Tabla de goleadores</h2>
	<br/>
	<table id="goleadores" align="center">

	<!-- Table header -->

		<thead>
			<tr>
				<th scope="col" id="tabla_nombre">Nombre</th>
				<th scope="col" id="tabla_jugados">Partidos Jugados</th>
				<th scope="col" id="tabla_goles">Goles</th>
			</tr>
		</thead>

	<!-- Table footer -->

		<tfoot>

		</tfoot>

	<!-- Table body -->

		<tbody>
			<?php 
				$first = true;
				$odd = true;
			?>
			<?php foreach($list as $player):?>
			<?php 
				$class = '';
				if($first){
					$class = 'first';
					$first = false;
				}else{
					if($odd){
						$class = 'odd';
					}else{
						$class = 'even';
					}
					$odd = !$odd;
				}
			?>
			<tr align="center" class='<?php echo $class?>'>
				<td><?php echo $player->getName();?></td>
				<td><?php echo $player->getAuxPlayed();?></td>
				<td><?php echo $player->getAuxGoals();?></td>
			</tr>
			<?php endforeach;?>
			
			
		</tbody>

</table>
		
<?php //include('logica/Round.class.php')?>

<?php $roundList = Round::getAll(); ?>

<?php foreach($roundList as $round):?>
        <h2><?php echo $round->getName(); ?></h2>
        <br/>
        <h3>Partidos</h3>
        <hr/>
        <?php $teamVsTeamList = TeamVsTeam::getRoundTeams($round->getId());?>
        <?php foreach($teamVsTeamList as $teamVsTeam):?>
            <?php //print_r($teamVsTeam) ?>
        <h4><?php echo $teamVsTeam->getId_team_1()->getName(); ?> <strong> VS </strong><?php echo $teamVsTeam->getId_team_2()->getName(); ?></h4>
            <br/>
            <p> Goles por equipo</p>
            <?php
                $goalsTeam1 = 0;
                $goalsTeam2 = 0;
            ?>
            <?php $listPlayerTeam = Player::getTeamRoundPlayers($teamVsTeam->getId_team_1()->getId(),$round->getId()); ?>
            <h5><?php echo $teamVsTeam->getId_team_1()->getName(); ?></h5>
            <table id="goleadores" align="center">

            <!-- Table header -->

		<thead>
			<tr>
				<th scope="col" id="tabla_nombre">Nombre</th>
				<th scope="col" id="tabla_goles">Goles</th>
			</tr>
		</thead>

            <!-- Table footer -->

		<tfoot>

		</tfoot>

            <!-- Table body -->

		<tbody>
			<?php
				$odd = true;
			?>
			<?php foreach($listPlayerTeam as $player):?>
			<?php
				$class = '';
				if($odd){
						$class = 'odd';
					}else{
						$class = 'even';
					}
				$odd = !$odd;

			?>
			<tr align="center" class='<?php echo $class?>'>
				<td><?php echo $player->getName();?></td>
                                <?php $goalsTeam1 += $player->getAuxGoals();?>
				<td><?php echo $player->getAuxGoals();?></td>
			</tr>
			<?php endforeach;?>


		</tbody>

            </table>

            <?php $listPlayerTeam = Player::getTeamRoundPlayers($teamVsTeam->getId_team_2()->getId(),$round->getId()); ?>
            <h5><?php echo $teamVsTeam->getId_team_2()->getName(); ?></h5>
            <table id="goleadores" align="center">

            <!-- Table header -->

		<thead>
			<tr>
				<th scope="col" id="tabla_nombre">Nombre</th>
				<th scope="col" id="tabla_goles">Goles</th>
			</tr>
		</thead>

            <!-- Table footer -->

		<tfoot>

		</tfoot>

            <!-- Table body -->

		<tbody>
			<?php
				$odd = true;
			?>
			<?php foreach($listPlayerTeam as $player):?>
			<?php
				$class = '';
				if($odd){
						$class = 'odd';
					}else{
						$class = 'even';
					}
				$odd = !$odd;

			?>
			<tr align="center" class='<?php echo $class?>'>
				<td><?php echo $player->getName();?></td>
                                <?php $goalsTeam2 += $player->getAuxGoals();?>
				<td><?php echo $player->getAuxGoals();?></td>
			</tr>
			<?php endforeach;?>


		</tbody>

            </table>
            <?php
                if($goalsTeam1 > $goalsTeam2){
                    echo "<h2>Gano: ".$teamVsTeam->getId_team_1()->getName()."</h2>";
                }else{
                    if($goalsTeam1 == $goalsTeam2){
                        echo "<h2>Empate</h2>";
                    }else{
                        echo "<h2>Gano: ".$teamVsTeam->getId_team_2()->getName()."</h2>";
                    }
                }
            ?>
        <?php endforeach; ?>

<?php endforeach; ?>


	</div>
	
</div>

<?php include('bottom.php')?>
