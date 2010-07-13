<?php
$data = array();
if($_POST['tournament'] <> ''){
    try{
        include("../../logica/Round.class.php");
	$roundList = Round::retrieveAll($_POST['tournament'], true, true, true);
        $list = array();
        foreach($roundList as $round){
            $aux = array();
            $aux['id'] = $round->getId();
            $aux['name'] = $round->getName();
            array_push($list, $aux);
        }
        $data = array('result'=> 1,'list'=> $list);
    }catch(Exception $e){
        $data = array('result'=> 0,'error'=>$e->getMessage());
    }

}else{
    $data = array('result'=> 0,'error'=>'El nombre esta vacio');
}

// JSON encode and send back to the server
echo json_encode($data);
exit;