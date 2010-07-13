<?php
$data = array();
if($_POST['tournament'] <> ''){
    try{
        include("../../logica/Tournament.class.php");
        Tournament::makeCurrent($_POST['tournament'], 1, true);
        $data = array('result'=> 1);
    }catch(Exception $e){
        $data = array('result'=> 0,'error'=>$e->getMessage());
    }

}else{
    $data = array('result'=> 0,'error'=>'El nombre esta vacio');
}

// JSON encode and send back to the server
echo json_encode($data);
exit;