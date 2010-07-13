<?php
$data = array();
if($_POST['name'] <> '' && $_POST['id_tournament'] <> '' ){
    try{
        include("../../logica/Round.class.php");
        //Round::saveRound($_POST["nombre_fechas"]);
	$id = Round::saveRound($_POST["name"], $_POST['id_tournament']);
        $data = array('result'=> 1,'name'=> $_POST['name'], 'id' => $id);
    }catch(Exception $e){
        $data = array('result'=> 0,'error'=>$e->getMessage());
    }

}else{
    if($_POST['name'] <> ''){
        $data = array('result'=> 0,'error'=>'El torneo esta vacio');
    }else{
        $data = array('result'=> 0,'error'=>'El nombre esta vacio');
    }
    
}

// JSON encode and send back to the server
echo json_encode($data);
exit;

