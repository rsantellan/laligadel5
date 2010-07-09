<?php
$data = array();
if($_POST['id'] <> '' && $_POST['valor'] <> ''){
    try{
        include("../../logica/CommentsMailing.class.php");
        $id = CommentsMailing::changeStatus($_POST["id"], $_POST['valor']);

        $body = "ok";

        $data = array('result'=> 1,'body'=> $body);
    }catch(Exception $e){
        $data = array('result'=> 0,'error'=>$e->getMessage());
    }

}else{
    $data = array('result'=> 0,'error'=>'El nombre esta vacio');
}

// JSON encode and send back to the server
echo json_encode($data);
exit;