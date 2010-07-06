<?php
$data = array();
if($_POST['id'] <> '' && $_POST['visibilidad'] <> ''){
    try{
        include("../../logica/Category.class.php");
        
        $id = Category::makeVisible($_POST["id"], $_POST['visibilidad']);
        $data = array('result'=> 1,'body'=> 'ok');
    }catch(Exception $e){
        $data = array('result'=> 0,'error'=>$e->getMessage());
    }

}else{
    $data = array('result'=> 0,'error'=>'El nombre esta vacio');
}

// JSON encode and send back to the server
echo json_encode($data);
exit;

