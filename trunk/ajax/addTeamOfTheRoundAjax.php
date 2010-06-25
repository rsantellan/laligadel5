<?php
$data = array();

if($_POST['round_id'] <> '' && $_POST['nombre'] <> '' && $_POST['golero'] <> '' && $_POST['defensa_izquierdo'] <> '' && $_POST['defensa_derecho'] <> '' && $_POST['atacante_izquierdo'] <> '' && $_POST['atacante_derecho'] <> ''){
    try{
        include("../logica/TeamOfTheRound.class.php");
        $teamOfTheRound = TeamOfTheRound::saveTeamOfTheRound($_POST['golero'], $_POST['defensa_derecho'], $_POST['defensa_izquierdo'], $_POST['atacante_derecho'], $_POST['atacante_izquierdo'], $_POST['nombre'], $_POST['round_id']);
        $body = "
                <h3> Equipo recien ingresado... </h3>
                <div id='container_team_of_the_round_".$teamOfTheRound->getId()."' class='team_of_the_round_container'>
                                <div class ='team_of_the_round_container_upper'>

                                    <h3>Este es el equipo de: <strong>".$teamOfTheRound->getAuthor()."</strong></h3>
                                </div>
                                <div class ='team_of_the_round_container_player'>
                                    <h5 class='team_of_the_round_container_player_title'>Golero</h5>
                                    <img src='".$teamOfTheRound->getPlayerGoaly()->getImage() ."' width='54' height='54' tooltip='".$teamOfTheRound->getPlayerGoaly()->getName() ."'/>
                                    <br/>
                                    <h7 class='team_of_the_round_container_player_title'>".$teamOfTheRound->getPlayerGoaly()->getName() ."</h7>
                                </div>
                                <div class ='team_of_the_round_container_player'>
                                    <h5 class='team_of_the_round_container_player_title'>Defensa Izquierdo</h5>
                                    <img src='".$teamOfTheRound->getPlayerDefenderLeft()->getImage() ."' width='54' height='54' tooltip='". $teamOfTheRound->getPlayerDefenderLeft()->getName() ."'/>
                                    <br/>
                                    <h7 class='team_of_the_round_container_player_title'>".$teamOfTheRound->getPlayerDefenderLeft()->getName() ."</h7>
                                </div>
                                <div class ='team_of_the_round_container_player'>
                                    <h5 class='team_of_the_round_container_player_title'>Defensa Derecho</h5>
                                    <img src='". $teamOfTheRound->getPlayerDefenderRight()->getImage() ."' width='54' height='54' tooltip='". $teamOfTheRound->getPlayerDefenderRight()->getName() ."'/>
                                    <br/>
                                    <h7 class='team_of_the_round_container_player_title'>". $teamOfTheRound->getPlayerDefenderRight()->getName() ."</h7>
                                </div>
                                <div class ='team_of_the_round_container_player'>
                                    <h5 class='team_of_the_round_container_player_title'>Atacante Izquierdo</h5>
                                    <img src='". $teamOfTheRound->getPlayerAttackerLeft()->getImage() ."' width='54' height='54' tooltip='". $teamOfTheRound->getPlayerAttackerLeft()->getName() ."'/>
                                    <br/>
                                    <h7 class='team_of_the_round_container_player_title'>". $teamOfTheRound->getPlayerAttackerLeft()->getName() ."</h7>
                                </div>
                                <div class ='team_of_the_round_container_player'>
                                    <h5 class='team_of_the_round_container_player_title'>Atacante Derecho</h5>
                                    <img src='". $teamOfTheRound->getPlayerAttackerRight()->getImage() ."' width='54' height='54' tooltip='". $teamOfTheRound->getPlayerAttackerRight()->getName() ."'/>
                                    <br/>
                                    <h7 class='team_of_the_round_container_player_title'>". $teamOfTheRound->getPlayerAttackerRight()->getName() ."</h7>
                                </div>
                                <div class='clear'></div>
                                
                            </div>";





        $data = array('result'=> 1,'name'=> $_POST['nombre'], 'body' => $body);
    }catch(Exception $e){
        $data = array('result'=> 0,'error'=>$e->getMessage());
    }

}else{
    $data = array('result'=> 0,'error'=>'El nombre esta vacio');
}

// JSON encode and send back to the server
echo json_encode($data);
exit;

