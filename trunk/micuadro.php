<?php include('header.php') ?>
<script type="text/javascript" src="js/jquery.qtip-1.0.0-rc3.min.js"></script>
<script src="js/jquery-ui-1.7.3.custom.min.js" type="text/javascript"> </script>
<script src="js/seleccionarMis5.js" type="text/javascript"> </script>
<link href="css/playersDragAndDrop.css" type="text/css" rel="stylesheet" />
<link href="css/rating.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/rating.js"></script>

<script type="text/javascript" src="js/fieldMovement.js"></script>


<?php include('closeHeader.php') ?>

<?php include('logoAndMenu.php') ?>

<div id="body">
    <?php include_once 'logica/Round.class.php'; ?>
    <?php $round = Round::getLastRound() ?>
    <h2 class="title">Arma el equipo de la: <?php echo $round->getName() ?><label id="help"> Ayuda <img src="images/HelpIcon.gif" alt="Futbol" width="34" height="34" /></label></h2>
    <div class="story">
        <a href="javascript:void(0)" onclick="showAddTeamOfTheRound()" id="add_team_of_the_round_link">Agregar equipo de la fecha</a>

        <div id ="addTeamOfTheRound" class="hide">

            <div id='field' class='field'>
                <div class="campo" id="campo">
                    <img src='./images/cancha.jpg'/>
                </div>
                <div style="clear: both"><!-- --></div>
                <div class="selected-plan golero" id="goaly">
                    <span class="help-text">Golero</span>
                    <div style="clear: both"><!-- --></div>
                </div>

                <div style="clear: both"><!-- --></div>
                <br/>
                <div class="selected-plan defensaIzquierdo" id="defense_left">
                    <span class="help-text">Defensa izquierdo</span>
                    <div style="clear: both"><!-- --></div>
                </div>

                <div class="selected-plan defensaDerecho" id="defense_right">
                    <span class="help-text">Defensa derecho</span>
                    <div style="clear: both"><!-- --></div>
                </div>

                <div style="clear: both"><!-- --></div>
                <br/>
                <div class="selected-plan atacanteIzquierdo" id="attacker_left">
                    <span class="help-text">Atacante izquierdo</span>
                    <div style="clear: both"><!-- --></div>
                </div>

                <div class="selected-plan atacanteDerecho" id="attacker_right">
                    <span class="help-text">Atacante derecho</span>
                    <div style="clear: both"><!-- --></div>
                </div>
            </div>

            <div id="players">
                <?php include_once 'logica/Player.class.php'; ?>
                <?php
                include './logica/ImageHandler.class.php';
                $imageHandler = new ImageHandler();
                ?>
                <?php $list = Player::getPlayersOfLastRound(); ?>
                <?php foreach ($list as $player): ?>
                <?php
                    $auxPath = $player->getImage();
                    if ($player->hasImage()) {
                        $auxPath = $imageHandler->getConvertedPath($player->getImage(), 54, 54, true, false);
                    } ?>
                    <div class="player" id="<?php echo $player->getId() ?>">
                        <img src="<?php echo $auxPath ?>" width="54" height="54" tooltip="<?php echo $player->getName() ?>"/>
                        <p class="remove">sacar</p>
                    </div>
                <?php endforeach; ?>
                    <script type="text/javascript">
                        var pageHeight = 1000;
                    </script>
                </div>
                <div style="clear: both"><!-- --></div>
                <br/>
                <div class="formulario" id="formulario">
                    Escribe tu nombre:
                    <input name="nombre" type="text" maxlength="255" id="text_person_name"/>
                    <input type="hidden" name="round_id" id="round_id" value="<?php echo $round->getId() ?>"/>
                    <input name="enviar" type="button" value="enviar" id="button_send_form"/>
                    <br/>
                    <br/>
                    <a href="javascript:void(0)" onclick="showListOfTeamOfTheRound()" id="show_list_of_team_of_the_round_link">Ver equipos hechos</a>
                </div>
                <div style="clear: both"><!-- --></div>
                <br/>
                <label id="selected_defense_right"></label>
                <br/>
                <label id="selected_defense_left"></label>
                <br/>
                <label id="selected_attacker_right"></label>
                <br/>
                <label id="selected_attacker_left"></label>
                <br/>
                <label id="selectedGoaly"></label>
            </div>

            <div id="list_of_teams_of_the_round">
            <?php $roundList = Round::getAll(); ?>
            <?php $listAllPlayers = Player::getAll() ?>
            <?php include_once 'logica/TeamOfTheRound.class.php'; ?>
            <?php foreach ($roundList as $auxRound): ?>
                        <h3><?php echo $auxRound->getName(); ?></h3>
                        <br/>
                        <br/>
            <?php $allTeamsOfTheRound = TeamOfTheRound::getTeamOfTheRoundOfOneRound($auxRound->getId(), $listAllPlayers) ?>
            <?php
                        $canChange = false;
                        if ($round->getId() == $auxRound->getId()) {
                            $canChange = true;
                        }
            ?>
            <?php foreach ($allTeamsOfTheRound as $teamOfTheRound): ?>
                            <div id="container_team_of_the_round_<?php echo $teamOfTheRound->getId() ?>" class="team_of_the_round_container">
                                <div class ="team_of_the_round_container_upper">

                                    <h3>Este es el equipo de: <strong><?php echo $teamOfTheRound->getAuthor(); ?></strong></h3>
                                </div>
                                <div class ="team_of_the_round_container_player">
                                    <h5 class="team_of_the_round_container_player_title">Golero</h5>
                    <?php
                            $auxPath = $teamOfTheRound->getPlayerGoaly()->getImage();
                            if ($teamOfTheRound->getPlayerGoaly()->hasImage()) {
                                $auxPath = $imageHandler->getConvertedPath($teamOfTheRound->getPlayerGoaly()->getImage(), 54, 54, true, false);
                            } ?>
                            <img src="<?php echo $auxPath ?>" width="54" height="54" tooltip="<?php echo $teamOfTheRound->getPlayerGoaly()->getName() ?>"/>
                            <br/>
                            <h7 class="team_of_the_round_container_player_title"><?php echo $teamOfTheRound->getPlayerGoaly()->getName() ?></h7>
                        </div>
                        <div class ="team_of_the_round_container_player">
                            <h5 class="team_of_the_round_container_player_title">Defensa Izquierdo</h5>
                    <?php
                            $auxPath = $teamOfTheRound->getPlayerDefenderLeft()->getImage();
                            if ($teamOfTheRound->getPlayerDefenderLeft()->hasImage()) {
                                $auxPath = $imageHandler->getConvertedPath($teamOfTheRound->getPlayerDefenderLeft()->getImage(), 54, 54, true, false);
                            } ?>
                            <img src="<?php echo $auxPath ?>" width="54" height="54" tooltip="<?php echo $teamOfTheRound->getPlayerDefenderLeft()->getName() ?>"/>
                            <br/>
                            <h7 class="team_of_the_round_container_player_title"><?php echo $teamOfTheRound->getPlayerDefenderLeft()->getName() ?></h7>
                        </div>
                        <div class ="team_of_the_round_container_player">
                            <h5 class="team_of_the_round_container_player_title">Defensa Derecho</h5>
                    <?php
                            $auxPath = $teamOfTheRound->getPlayerDefenderRight()->getImage();
                            if ($teamOfTheRound->getPlayerDefenderRight()->hasImage()) {
                                $auxPath = $imageHandler->getConvertedPath($teamOfTheRound->getPlayerDefenderRight()->getImage(), 54, 54, true, false);
                            } ?>
                            <img src="<?php echo $auxPath ?>" width="54" height="54" tooltip="<?php echo $teamOfTheRound->getPlayerDefenderRight()->getName() ?>"/>
                            <br/>
                            <h7 class="team_of_the_round_container_player_title"><?php echo $teamOfTheRound->getPlayerDefenderRight()->getName() ?></h7>
                        </div>
                        <div class ="team_of_the_round_container_player">
                            <h5 class="team_of_the_round_container_player_title">Atacante Izquierdo</h5>
                    <?php
                            $auxPath = $teamOfTheRound->getPlayerAttackerLeft()->getImage();
                            if ($teamOfTheRound->getPlayerAttackerLeft()->hasImage()) {
                                $auxPath = $imageHandler->getConvertedPath($teamOfTheRound->getPlayerAttackerLeft()->getImage(), 54, 54, true, false);
                            } ?>
                            <img src="<?php echo $auxPath ?>" width="54" height="54" tooltip="<?php echo $teamOfTheRound->getPlayerAttackerLeft()->getName() ?>"/>
                            <br/>
                            <h7 class="team_of_the_round_container_player_title"><?php echo $teamOfTheRound->getPlayerAttackerLeft()->getName() ?></h7>
                        </div>
                        <div class ="team_of_the_round_container_player">
                            <h5 class="team_of_the_round_container_player_title">Atacante Derecho</h5>
                    <?php
                            $auxPath = $teamOfTheRound->getPlayerAttackerRight()->getImage();
                            if ($teamOfTheRound->getPlayerAttackerRight()->hasImage()) {
                                $auxPath = $imageHandler->getConvertedPath($teamOfTheRound->getPlayerAttackerRight()->getImage(), 54, 54, true, false);
                            } ?>
                            <img src="<?php echo $auxPath ?>" width="54" height="54" tooltip="<?php echo $teamOfTheRound->getPlayerAttackerRight()->getName() ?>"/>
                            <br/>
                            <h7 class="team_of_the_round_container_player_title"><?php echo $teamOfTheRound->getPlayerAttackerRight()->getName() ?></h7>
                        </div>
                        <div class="clear"></div>
                        <div class ="team_of_the_round_container_lower">
                            <div id="stars" class="stars_container">
                                <h5>Ponle un puntaje: </h5>
                                <ul class="star-rating <?php if ($canChange)
                                echo 'rate_widget' ?>" id="team_of_the_round_<?php echo $teamOfTheRound->getId() ?>" object_id="<?php echo $teamOfTheRound->getId() ?>">
                                <li class="current-rating" style="width:<?php echo $teamOfTheRound->getCalculatedRatingPercent() ?>%;">Currently 3/5 Stars.</li>
                                <li><a href="javascript:void(0)" title="1 star out of 5" class="one-star <?php if ($canChange)
                                    echo 'ratings_stars' ?>" rating="1">1</a></li>
                             <li><a href="javascript:void(0)" title="2 stars out of 5" class="two-stars <?php if ($canChange)
                                        echo 'ratings_stars' ?>" rating="2">2</a></li>
                                 <li><a href="javascript:void(0)" title="3 stars out of 5" class="three-stars <?php if ($canChange)
                                            echo 'ratings_stars' ?>" rating="3">3</a></li>
                                     <li><a href="javascript:void(0)" title="4 stars out of 5" class="four-stars <?php if ($canChange)
                                                echo 'ratings_stars' ?>" rating="4">4</a></li>
                                         <li><a href="javascript:void(0)" title="5 stars out of 5" class="five-stars <?php if ($canChange)
                                                    echo 'ratings_stars' ?>" rating="5">5</a></li>
                                         </ul>
                                         <h6> Puntos del equipo: <?php echo $teamOfTheRound->getCalculatedRating() ?> </h6>
                                     </div>
                                 </div>
                             </div>
            <?php endforeach; ?>
                                                    <br/>
                                                    <br/>
                                                    <hr/>
            <?php endforeach; ?>
                                                </div>
                                            </div>

    <?php include('bottom.php') ?>
