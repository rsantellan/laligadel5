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
        <?php 
        include('logica/Tournament.class.php');
        $tournament = Tournament::getAllTournaments(true, true);
        ?>
            <h2>Torneo: <?php echo $tournament->getName();?></h2>
		<p>
	<?php include('logica/TeamVsTeam.class.php')?>

        <?php $testList = TeamVsTeam::getTeamListPosition($tournament->getId()) ?>
        
                <div class="ulTable">
                    <ul>
                        <li class="liTitle">Cuadro</li>
                        <?php $index = count($testList)-1; ?>
                        <?php $even = true; ?>
                        <?php while($index >= 0):?>
                        <?php if($even): ?>
                            <li class="even"><?php echo $testList[$index]['name'] ?></li>
                        <?php else: ?>
                            <li class="odd"><?php echo $testList[$index]['name'] ?></li>
                        <?php endif; ?>
                        <?php $index--; $even = !$even;?>
                        <?php endwhile; ?>
                    </ul>
                    <ul>
                        <li class="liTitle">Jugados</li>
                        <?php $index = count($testList)-1; ?>
                        <?php $even = true; ?>
                        <?php while($index >= 0):?>
                        <?php if($even): ?>
                            <li class="even"><?php echo ($testList[$index]['won'] + $testList[$index]['tie'] + $testList[$index]['lost']) ?></li>
                        <?php else: ?>
                            <li class="odd"><?php echo ($testList[$index]['won'] + $testList[$index]['tie'] + $testList[$index]['lost']) ?></li>
                        <?php endif; $even = !$even;?>
                        <?php $index--; ?>
                        <?php endwhile; ?>
                    </ul>
                    <ul>
                        <li class="liTitle">Ganados</li>
                        <?php $index = count($testList)-1; ?>
                        <?php $even = true; ?>
                        <?php while($index >= 0):?>
                        <?php if($even): ?>
                            <li class="even"><?php echo $testList[$index]['won'] ?></li>
                        <?php else: ?>
                            <li class="odd"><?php echo $testList[$index]['won'] ?></li>
                        <?php endif; $even = !$even;?>
                        <?php $index--; ?>
                        <?php endwhile; ?>
                    </ul>
                    <ul>
                        <li class="liTitle">Empatados</li>
                        <?php $index = count($testList)-1; ?>
                        <?php $even = true; ?>
                        <?php while($index >= 0):?>
                        <?php if($even): ?>
                            <li class="even"><?php echo $testList[$index]['tie'] ?></li>
                        <?php else: ?>
                            <li class="odd"><?php echo $testList[$index]['tie'] ?></li>
                        <?php endif; $even = !$even;?>
                        <?php $index--; ?>
                        <?php endwhile; ?>
                    </ul>
                    <ul>
                        <li class="liTitle">Perdidos</li>
                        <?php $index = count($testList)-1; ?>
                        <?php $even = true; ?>
                        <?php while($index >= 0):?>
                        <?php if($even): ?>
                            <li class="even"><?php echo $testList[$index]['lost'] ?></li>
                        <?php else: ?>
                            <li class="odd"><?php echo $testList[$index]['lost'] ?></li>
                        <?php endif; $even = !$even;?>
                        <?php $index--; ?>
                        <?php endwhile; ?>
                    </ul>
                    <ul>
                        <li class="liTitle">GF</li>
                        <?php $index = count($testList)-1; ?>
                        <?php $even = true; ?>
                        <?php while($index >= 0):?>
                        <?php if($even): ?>
                            <li class="even"><?php echo $testList[$index]['goalsFavor'] ?></li>
                        <?php else: ?>
                            <li class="odd"><?php echo $testList[$index]['goalsFavor'] ?></li>
                        <?php endif; $even = !$even;?>
                        <?php $index--; ?>
                        <?php endwhile; ?>
                    </ul>
                    <ul>
                        <li class="liTitle">GC</li>
                        <?php $index = count($testList)-1; ?>
                        <?php $even = true; ?>
                        <?php while($index >= 0):?>
                        <?php if($even): ?>
                            <li class="even"><?php echo $testList[$index]['goalsAgainst'] ?></li>
                        <?php else: ?>
                            <li class="odd"><?php echo $testList[$index]['goalsAgainst'] ?></li>
                        <?php endif; $even = !$even;?>
                        <?php $index--; ?>
                        <?php endwhile; ?>
                    </ul>
                    <ul>
                        <li class="liTitle">Diferencia</li>
                        <?php $index = count($testList)-1; ?>
                        <?php $even = true; ?>
                        <?php while($index >= 0):?>
                        <?php if($even): ?>
                            <li class="even"><?php echo $testList[$index]['goalsDifference'] ?></li>
                        <?php else: ?>
                            <li class="odd"><?php echo $testList[$index]['goalsDifference'] ?></li>
                        <?php endif; $even = !$even;?>
                        <?php $index--; ?>
                        <?php endwhile; ?>
                    </ul>
                    <ul>
                        <li class="liTitle">Puntos</li>
                        <?php $index = count($testList)-1; ?>
                        <?php $even = true; ?>
                        <?php while($index >= 0):?>
                        <?php if($even): ?>
                            <li class="even"><?php echo $testList[$index]['points'] ?></li>
                        <?php else: ?>
                            <li class="odd"><?php echo $testList[$index]['points'] ?></li>
                        <?php endif; $even = !$even;  ?>
                        <?php $index--; ?>
                        <?php endwhile; ?>
                    </ul>
                </div>
                <div class="clear"></div>
                <br/>
		<hr/>
	
		<?php $list = Player::getAllByTournament($tournament->getId());?>
		

		
		<!-- Table markup-->
	<h2>Tabla de goleadores</h2>
	<br/>

        <div class="ulTable goleadores">
                    <ul>
                        <li class="liTitle">Nombre</li>
                        <?php $even = true; ?>
                        <?php foreach($list as $player):?>
                          <?php if($even): ?>
                            <li class="even"><?php echo $player->getName() ?></li>
                          <?php else: ?>
                            <li class="odd"><?php echo $player->getName() ?></li>
                            <?php endif; ?>
                        <?php 
                            $even = !$even;
                            endforeach;
                        ?>
                    </ul>
                    <ul>
                        <li class="liTitle">Partidos Jugados</li>
                        <?php $even = true; ?>
                        <?php foreach($list as $player):?>
                          <?php if($even): ?>
                            <li class="even"><?php echo $player->getAuxPlayed() ?></li>
                          <?php else: ?>
                            <li class="odd"><?php echo $player->getAuxPlayed() ?></li>
                            <?php endif; ?>
                        <?php
                            $even = !$even;
                            endforeach;
                        ?>
                    </ul>
                    <ul>
                        <li class="liTitle">Goles</li>
                        <?php $even = true; ?>
                        <?php foreach($list as $player):?>
                          <?php if($even): ?>
                            <li class="even"><?php echo round($player->getAuxGoals(), 2); ?></li>
                          <?php else: ?>
                            <li class="odd"><?php echo round($player->getAuxGoals(), 2); ?></li>
                            <?php endif; ?>
                        <?php
                            $even = !$even;
                            endforeach;
                        ?>
                    </ul>
                    <ul>
                        <li class="liTitle">Promedio</li>
                        <?php $even = true; ?>
                        <?php foreach($list as $player):?>
                          <?php if($even): ?>
                            <li class="even"><?php echo ($player->getAuxGoals() / $player->getAuxPlayed()) ?></li>
                          <?php else: ?>
                            <li class="odd"><?php echo ($player->getAuxGoals() / $player->getAuxPlayed()) ?></li>
                            <?php endif; ?>
                        <?php
                            $even = !$even;
                            endforeach;
                        ?>
                    </ul>
                </div>
                <div class="clear"></div>
                <br/>
		<hr/>
	
<?php $roundList = Round::retrieveAll($tournament->getId(), true, false, false);?>

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

            <div class="ulTable goleadores floating">
                    <ul>
                        <li class="liTitle">Nombre</li>
                        <?php $even = true; ?>
                        <?php foreach($listPlayerTeam as $player):?>
                          <?php if($even): ?>
                            <li class="even"><?php echo $player->getName() ?></li>
                          <?php else: ?>
                            <li class="odd"><?php echo $player->getName() ?></li>
                            <?php endif; ?>
                        <?php
                            $even = !$even;
                            endforeach;
                        ?>
                    </ul>
                    <ul>
                        <li class="liTitle">Goles</li>
                        <?php $even = true; ?>
                        <?php foreach($listPlayerTeam as $player):?>
                          <?php if($even): ?>
                            <li class="even"><?php echo $player->getAuxGoals() ?></li>
                          <?php else: ?>
                            <li class="odd"><?php echo $player->getAuxGoals() ?></li>
                            <?php endif; ?>
                            <?php $goalsTeam1 += $player->getAuxGoals();?>
                        <?php
                            $even = !$even;
                            endforeach;
                        ?>
                    </ul>

                </div>
                <div class="clear"></div>
                <br/>

            <?php $listPlayerTeam = Player::getTeamRoundPlayers($teamVsTeam->getId_team_2()->getId(),$round->getId()); ?>
            <h5><?php echo $teamVsTeam->getId_team_2()->getName(); ?></h5>

            <div class="ulTable goleadores floating">
                    <ul>
                        <li class="liTitle">Nombre</li>
                        <?php $even = true; ?>
                        <?php foreach($listPlayerTeam as $player):?>
                          <?php if($even): ?>
                            <li class="even"><?php echo $player->getName() ?></li>
                          <?php else: ?>
                            <li class="odd"><?php echo $player->getName() ?></li>
                            <?php endif; ?>
                        <?php
                            $even = !$even;
                            endforeach;
                        ?>
                    </ul>
                    <ul>
                        <li class="liTitle">Goles</li>
                        <?php $even = true; ?>
                        <?php foreach($listPlayerTeam as $player):?>
                          <?php if($even): ?>
                            <li class="even"><?php echo $player->getAuxGoals() ?></li>
                          <?php else: ?>
                            <li class="odd"><?php echo $player->getAuxGoals() ?></li>
                            <?php endif; ?>
                            <?php $goalsTeam2 += $player->getAuxGoals();?>
                        <?php
                            $even = !$even;
                            endforeach;
                        ?>
                    </ul>

                </div>
                <div class="clear"></div>
                <br/>
            
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
