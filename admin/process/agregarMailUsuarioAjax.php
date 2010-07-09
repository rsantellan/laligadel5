<?php
$data = array();
if($_POST['email'] <> ''){
    try{
        include("../../logica/CommentsMailing.class.php");
        $id = CommentsMailing::addEmailAdminAjax($_POST["email"]);

        $body = "<tr>";
        $body .= "<td>". $_POST['email'] ."</td>";
        $body .= "<td><input value='".$id."' onclick='changeMailingStatus(".$id.")' type='checkbox'";
        if($_POST['visibilidad'] == "true"){
            $body .="checked";
        }
        $body .= "> </td>";
        $body .= "</tr>";

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
