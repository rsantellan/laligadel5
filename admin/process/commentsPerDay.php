<?php
include_once '../../logica/Comments.class.php';
$commentsList = Comments::getAllComents(0, 0, true, true, true);
$list = array();
//foreach($commentsList as $comment){
//    $list[$comment->getId()] = $comment->getDate();
//}
$commentsList = Comments::groupAndCountByDay($commentsList);
$data = array('result'=> 1,'list'=>$list, 'ordenados' =>$commentsList);


// JSON encode and send back to the server
echo json_encode($data);
exit;
