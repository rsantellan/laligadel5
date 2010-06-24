<?php
$data = array();

if($_POST['round_id'] <> '' && $_POST['nombre'] <> '' && $_POST['golero'] <> '' && $_POST['defensa_izquierdo'] <> '' && $_POST['defensa_derecho'] <> '' && $_POST['atacante_izquierdo'] <> '' && $_POST['atacante_derecho'] <> ''){
    try{
        include("../logica/TeamOfTheRound.class.php");
        $id = TeamOfTheRound::saveTeamOfTheRound($_POST['golero'], $_POST['defensa_derecho'], $_POST['defensa_izquierdo'], $_POST['atacante_derecho'], $_POST['atacante_izquierdo'], $_POST['nombre'], $_POST['round_id']);
        $data = array('result'=> 1,'name'=> $_POST['nombre'], 'id' => $id);
    }catch(Exception $e){
        $data = array('result'=> 0,'error'=>$e->getMessage());
    }

}else{
    $data = array('result'=> 0,'error'=>'El nombre esta vacio');
}

// JSON encode and send back to the server
echo json_encode($data);
exit;

