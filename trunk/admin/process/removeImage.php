<?php

$data = array();


if ($_POST['imageId'] <> '' ) {
    try {
        include("../../logica/Image.class.php");
        $result = Image::removeImage($_POST['imageId'], true, true, true, true);
        if($result){
            $data = array('result' => 1, 'body' => '');
        }else{
            $data = array('result' => 0, 'body' => '');
        }
        
    } catch (Exception $e) {
        $data = array('result' => 0, 'error' => $e->getMessage());
    }
} else {
    $data = array('result' => 0, 'error' => 'El nombre esta vacio');
}

// JSON encode and send back to the server
echo json_encode($data);
exit;

