<?php
$data = array();
if ($_POST["equipo_1"]<>'' && $_POST["equipo_2"]<>'' && $_POST["fecha"]<>'') {
    try{
        include("../../logica/TeamVsTeam.class.php");
        TeamVsTeam::saveTeamVsTeam($_POST["equipo_1"], $_POST["equipo_2"], $_POST["fecha"]);
        $data = array('result'=> 1,'body'=>'ok');
    }catch(Exception $e){
        $data = array('result'=> 0,'error'=>$e->getMessage());
    }

}else{
    $data = array('result'=> 0,'error'=>'El nombre esta vacio');
}

// JSON encode and send back to the server
echo json_encode($data);
exit;

