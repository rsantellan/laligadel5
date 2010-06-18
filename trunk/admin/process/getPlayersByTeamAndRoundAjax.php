<?php
$data = array();
if($_POST['team'] <> '' && $_POST['round'] <> ''){
    try{
        include("../../logica/Player.class.php");
        $listPlayerTeam = Player::getTeamRoundPlayersAdmin($_POST["team"],$_POST["round"]);
        $body = "<ul>";
        foreach($listPlayerTeam as $player){
            $body .= "<li>".$player->getName()." : ".$player->getAuxGoals()."</li>";
        }
        $body .= "</ul>";

        $data = array('result'=> 1,'body'=> $body);
    }catch(Exception $e){
        $data = array('result'=> 0,'error'=>$e->getMessage());
    }

}else{
    $data = array('result'=> 0,'error'=>'El equipo y la ronda estan vacios');
}

// JSON encode and send back to the server
echo json_encode($data);
exit;

