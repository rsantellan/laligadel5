<?php

$data = array();
if ($_POST['id'] <> '' && $_POST['type'] <> '') {
    
    switch ($_POST['type']) {
        case 1:
            try {
                //include("../../logica/Category.class.php");
                //$id = Category::removeCategory($_POST["id"]);
                $data = array('result' => 1, 'body' => 'player');
            } catch (Exception $e) {
                $data = array('result' => 0, 'error' => $e->getMessage());
            }

            break;
        case 2:
            try {
                //include("../../logica/Category.class.php");
                //$id = Category::removeCategory($_POST["id"]);
                $data = array('result' => 1, 'body' => 'team');
            } catch (Exception $e) {
                $data = array('result' => 0, 'error' => $e->getMessage());
            }
            break;
        case 3:
            try {
                //include("../../logica/Category.class.php");
                //$id = Category::removeCategory($_POST["id"]);
                $data = array('result' => 1, 'body' => 'round');
            } catch (Exception $e) {
                $data = array('result' => 0, 'error' => $e->getMessage());
            }
            break;
        case 4:
            try {
                include("../../logica/Category.class.php");
                $id = Category::removeCategory($_POST["id"]);
                $data = array('result' => 1, 'body' => 'categoria');
            } catch (Exception $e) {
                $data = array('result' => 0, 'error' => $e->getMessage());
            }
            break;
        default:
            break;
    }
} else {
    $data = array('result' => 0, 'error' => 'El nombre esta vacio');
}

// JSON encode and send back to the server
echo json_encode($data);
exit;

