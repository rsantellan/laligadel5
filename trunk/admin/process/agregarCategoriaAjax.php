<?php
$data = array();
if($_POST['name'] <> '' && $_POST['visibilidad']){
    try{
        include("../../logica/Category.class.php");
        $id = Category::saveCategory($_POST["name"],$_POST['visibilidad']);

        $body = "<tr id='category_tr_".$id."'>";
        $body .= "<td>".$id."</td>";
        $body .= "<td>". $_POST['name'] ."</td>";
        $body .= "<td><input value='".$id."' onclick='' type='checkbox'";
        if($_POST['visibilidad'] == "true"){
            $body .="checked";
        }
        $body .= "> </td>";
        $body .= "<td><a href='javascript:void(0)' onclick='deleteCategory(".$id.")'> Eliminar </a></td>";
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

