<?php
$data = array();

if($_POST['teamId'] <> '' && $_POST['rating'] <> ''){
    try{
        include("../logica/TeamOfTheRound.class.php");
        
        $values = TeamOfTheRound::changeTeamOfTheRoundRating($_POST['teamId'], $_POST['rating']);
        $roundedValue = round(($values[0] / $values[1]), 2);
        $body = "<h4>El puntaje del equipo es de : ".$roundedValue. "</h4>";
        $data = array('result'=> 1,'body'=> $body);
    }catch(Exception $e){
        $data = array('result'=> 0,'error'=>$e->getMessage());
    }

}else{
    $data = array('result'=> 0,'error'=>'Los campos estan vacios');
}

// JSON encode and send back to the server
echo json_encode($data);
exit;