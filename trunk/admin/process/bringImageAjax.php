<?php

$data = array();
if ($_POST['name'] <> '' && $_POST['type'] <> '') {
    include("../../logica/ImageHandler.class.php");
    $imageHandler = new ImageHandler();
    switch ($_POST['type']) {
        case 1:
            try {
                $auxPath = $imageHandler->getConvertedPath($_POST['name'], 54, 54, false, true, true);
                $body = $body = "<img src='" . $auxPath . "'  tooltip='" . $_POST['name'] . "' alt='" . $_POST['name'] . "'/><br/>";
                $data = array('result' => 1, 'body' => $body);
            } catch (Exception $e) {
                $data = array('result' => 0, 'error' => $e->getMessage());
            }

            break;
        case 2:
            try {
                $auxPath = $imageHandler->getConvertedPath($_POST['name'], 60, 60, true, true, true);
                $body = $body = "<img src='" . $auxPath . "'  tooltip='" . $_POST['name'] . "' alt='" . $_POST['name'] . "'/><br/>";
                $data = array('result' => 1, 'body' => $body);
            } catch (Exception $e) {
                $data = array('result' => 0, 'error' => $e->getMessage());
            }
            break;
        case 3:
            try {
                $auxPath = $imageHandler->getConvertedPath($_POST['name'], 100, 100, true, true, true);
                $body = $body = "<img src='" . $auxPath . "'  tooltip='" . $_POST['name'] . "' alt='" . $_POST['name'] . "'/><br/>";
                $data = array('result' => 1, 'body' => $body);
            } catch (Exception $e) {
                $data = array('result' => 0, 'error' => $e->getMessage());
            }
            break;
        case 4:
            try {
                $auxPath = $imageHandler->getConvertedPath($_POST['name'], 101, 67, true, true, true);
                $body = $body = "<img src='" . $auxPath . "'  tooltip='" . $_POST['name'] . "' alt='" . $_POST['name'] . "'/><br/>";
                $data = array('result' => 1, 'body' => $body);
            } catch (Exception $e) {
                $data = array('result' => 0, 'error' => $e->getMessage());
            }
            break;
        case 5:
            try {
                $auxPath = $imageHandler->getConvertedPath($_POST['name'], 600, 400, false, true, true);
                $body = $body = "<img src='" . $auxPath . "'  tooltip='" . $_POST['name'] . "' alt='" . $_POST['name'] . "'/><br/>";
                $data = array('result' => 1, 'body' => $body);
            } catch (Exception $e) {
                $data = array('result' => 0, 'error' => $e->getMessage());
            }
            break;
        case 6:
            try {
                $auxPath = $imageHandler->getConvertedPath($_POST['name'], 800, 600, false, true, true);
                $body = $body = "<img src='" . $auxPath . "'  tooltip='" . $_POST['name'] . "' alt='" . $_POST['name'] . "'/><br/>";
                $data = array('result' => 1, 'body' => $body);
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

