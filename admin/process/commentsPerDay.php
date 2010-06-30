<?php

if ($_POST['type'] == '' || $_POST['type'] == ' ') {
    $data = array('result' => 0, 'table' => ' ');


// JSON encode and send back to the server
    echo json_encode($data);
    exit;
}

include_once '../../logica/Comments.class.php';

$table = "<h3> No data </h3>";
if ($_POST['type'] == 1) {
    $commentsList = Comments::getAllComents(0, 0, true, true, true);
    $commentsList = Comments::groupAndCountByDay($commentsList);
    $table = Comments::getTableOfComments($commentsList, "El dia con mas comentarios es");
}

if ($_POST['type'] == 2) {
    $commentsList = Comments::getCommentsCountByAuthor(true, true);
    $table = Comments::getTableOfComments($commentsList, "Usuarios con mas comentarios");
}

$data = array('result' => 1, 'table' => $table);


// JSON encode and send back to the server
echo json_encode($data);
exit;
