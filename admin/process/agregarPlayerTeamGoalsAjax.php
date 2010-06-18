<?php
$data = array();
if ($_POST["equipo"]<>'' && $_POST["jugador"]<>'' && $_POST["fecha"]<>'' && $_POST["goles"]<>'') {
    try{
        include("../../logica/TeamPlayerRound.class.php");
        TeamPlayerRound::saveTeamPlayerRound($_POST["equipo"], $_POST["jugador"], $_POST["fecha"], $_POST["goles"]);

        $data = array('result'=> 1,'body'=>'ok');
    }catch(Exception $e){
        $data = array('result'=> 0,'error'=>$e->getMessage());
    }

}else{
    $data = array('result'=> 0,'error'=>'Los goles estan vacios');
}

// JSON encode and send back to the server
echo json_encode($data);
exit;

