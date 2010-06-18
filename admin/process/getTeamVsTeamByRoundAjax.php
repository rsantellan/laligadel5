<?php
$data = array();
if($_POST['id'] <> ''){
    try{
        include("../../logica/TeamVsTeam.class.php");
        $list = TeamVsTeam::getRoundTeamsAdmin($_POST["id"]);
        $body = "";
        foreach($list as $teamVsTeam){
            $body .= "<h4>".$teamVsTeam->getId_team_1()->getName()." <strong> VS </strong>".$teamVsTeam->getId_team_2()->getName()."</h4>";
            $body .= "<br/>";
        }


        $data = array('result'=> 1,'body'=> $body);
    }catch(Exception $e){
        $data = array('result'=> 0,'error'=>$e->getMessage());
    }

}else{
    $data = array('result'=> 0,'error'=>'El id esta vacio');
}

// JSON encode and send back to the server
echo json_encode($data);
exit;

