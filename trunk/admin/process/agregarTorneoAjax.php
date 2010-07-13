<?php
$data = array();
if($_POST['name'] <> ''){
    try{
        include("../../logica/Tournament.class.php");
        $id = Tournament::createTournament($_POST['name'],0);
        $data = array('result'=> 1,'name'=> $_POST['name'], 'id' => $id);
    }catch(Exception $e){
        $data = array('result'=> 0,'error'=>$e->getMessage());
    }

}else{
    $data = array('result'=> 0,'error'=>'El nombre esta vacio');
}

// JSON encode and send back to the server
echo json_encode($data);
exit;

