<?php

$data = array();



if ($_POST['bigChangeImageId'] <> '') {
    try {
        include("../../logica/Image.class.php");
        include("../../logica/ImageHandler.class.php");
        $image = Image::retrieveById($_POST['bigChangeImageId'], true, true, true);
        $imageHandler = new ImageHandler();
        $auxPath = $imageHandler->getConvertedPath($image->getFile(), 100, 100, true, true, true);
        $body = $body = "<img src='" . $auxPath . "'  tooltip='" . $image->getName() . "' alt='" . $image->getName() . "'/>";
        $data = array('result' => 1, 'body' => $body);
    } catch (Exception $e) {
        $data = array('result' => 0, 'error' => $e->getMessage());
    }
    echo json_encode($data);
    exit;
}

if ($_POST['changeImageId'] <> '') {
    try {
        include("../../logica/Image.class.php");
        include("../../logica/ImageHandler.class.php");
        $image = Image::retrieveById($_POST['changeImageId'], true, true, true);
        $imageHandler = new ImageHandler();
        $auxPath = $imageHandler->getConvertedPath($image->getFile(), 60, 60, true, true, true);
        $body = $body = "<img src='" . $auxPath . "'  tooltip='" . $image->getName() . "' alt='" . $image->getName() . "'/>";
        $data = array('result' => 1, 'body' => $body);
    } catch (Exception $e) {
        $data = array('result' => 0, 'error' => $e->getMessage());
    }
    echo json_encode($data);
    exit;
}

if ($_POST['imageId'] <> '' && $_POST['categoryId'] <> '') {
    try {
        include("../../logica/Image.class.php");
        $image = Image::addImageToCategory($_POST['imageId'], $_POST['categoryId'], true, true);
        $body = "<img src='../images/lightbox-ico-loading.gif'  tooltip='" . $image->getName() . "' alt='" . $image->getName() . "'/>";
        $data = array('result' => 1, 'body' => $body);
    } catch (Exception $e) {
        $data = array('result' => 0, 'error' => $e->getMessage());
    }
} else {
    $data = array('result' => 0, 'error' => 'El nombre esta vacio');
}

// JSON encode and send back to the server
echo json_encode($data);
exit;

