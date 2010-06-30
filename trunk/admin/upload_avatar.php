<?php

// Code for Session Cookie workaround
if (isset($_POST["PHPSESSID"])) {
    session_id($_POST["PHPSESSID"]);
} else if (isset($_GET["PHPSESSID"])) {
    session_id($_GET["PHPSESSID"]);
}

session_start();

$id = 0;
if (isset($_POST["ID"])) {
    $id = $_POST["ID"];
} else if (isset($_GET["ID"])) {
    $id = $_GET["ID"];
}

$className = '';
if (isset($_POST["OBJECTCLASSNAME"])) {
    $className = $_POST["OBJECTCLASSNAME"];
} else if (isset($_GET["OBJECTCLASSNAME"])) {
    $className = $_GET["OBJECTCLASSNAME"];
}


// Check post_max_size (http://us3.php.net/manual/en/features.file-upload.php#73762)
$POST_MAX_SIZE = ini_get('post_max_size');
$unit = strtoupper(substr($POST_MAX_SIZE, -1));
$multiplier = ($unit == 'M' ? 1048576 : ($unit == 'K' ? 1024 : ($unit == 'G' ? 1073741824 : 1)));

if ((int) $_SERVER['CONTENT_LENGTH'] > $multiplier * (int) $POST_MAX_SIZE && $POST_MAX_SIZE) {
    header("HTTP/1.1 500 Internal Server Error"); // This will trigger an uploadError event in SWFUpload
    echo "POST exceeded maximum allowed size.";
    exit(0);
}

// Settings
$save_path = getcwd() . "/uploads/";    // The path were we will save the file (getcwd() may not be reliable and should be tested in your environment)
$upload_name = "Filedata";
$max_file_size_in_bytes = 2147483647;    // 2GB in bytes
$extension_whitelist = array("jpg", "gif", "png"); // Allowed file extensions
$valid_chars_regex = '.A-Z0-9_ !@#$%^&()+={}\[\]\',~`-';    // Characters allowed in the file name (in a Regular Expression format)
// Other variables
$MAX_FILENAME_LENGTH = 260;
$file_name = "";
$file_extension = "";
$uploadErrors = array(
    0 => "There is no error, the file uploaded with success",
    1 => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
    2 => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
    3 => "The uploaded file was only partially uploaded",
    4 => "No file was uploaded",
    6 => "Missing a temporary folder"
);


// Validate the upload
if (!isset($_FILES[$upload_name])) {
    HandleError("No upload found in \$_FILES for " . $upload_name);
    exit(0);
} else if (isset($_FILES[$upload_name]["error"]) && $_FILES[$upload_name]["error"] != 0) {
    HandleError($uploadErrors[$_FILES[$upload_name]["error"]]);
    exit(0);
} else if (!isset($_FILES[$upload_name]["tmp_name"]) || !@is_uploaded_file($_FILES[$upload_name]["tmp_name"])) {
    HandleError("Upload failed is_uploaded_file test.");
    exit(0);
} else if (!isset($_FILES[$upload_name]['name'])) {
    HandleError("File has no name.");
    exit(0);
}

// Validate the file size (Warning: the largest files supported by this code is 2GB)
$file_size = @filesize($_FILES[$upload_name]["tmp_name"]);
if (!$file_size || $file_size > $max_file_size_in_bytes) {
    HandleError("File exceeds the maximum allowed size");
    exit(0);
}

if ($file_size <= 0) {
    HandleError("File size outside allowed lower bound");
    exit(0);
}


// Validate file name (for our purposes we'll just remove invalid characters)
$file_name = preg_replace('/[^' . $valid_chars_regex . ']|\.+$/i', "", basename($_FILES[$upload_name]['name']));
if (strlen($file_name) == 0 || strlen($file_name) > $MAX_FILENAME_LENGTH) {
    HandleError("Invalid file name");
    exit(0);
}


// Validate that we won't over-write an existing file
if (file_exists($save_path . $file_name)) {
    HandleError("File with this name already exists");
    exit(0);
}

// Validate file extension
$path_info = pathinfo($_FILES[$upload_name]['name']);
$file_extension = $path_info["extension"];
$is_valid_extension = false;
foreach ($extension_whitelist as $extension) {
    if (strcasecmp($file_extension, $extension) == 0) {
        $is_valid_extension = true;
        break;
    }
}
if (!$is_valid_extension) {
    HandleError("Invalid file extension");
    exit(0);
}

// Validate file contents (extension and mime-type can't be trusted)
/*
  Validating the file contents is OS and web server configuration dependant.  Also, it may not be reliable.
  See the comments on this page: http://us2.php.net/fileinfo

  Also see http://72.14.253.104/search?q=cache:3YGZfcnKDrYJ:www.scanit.be/uploads/php-file-upload.pdf+php+file+command&hl=en&ct=clnk&cd=8&gl=us&client=firefox-a
  which describes how a PHP script can be embedded within a GIF image file.

  Therefore, no sample code will be provided here.  Research the issue, decide how much security is
  needed, and implement a solution that meets the needs.
 */


// Process the file
/*
  At this point we are ready to process the valid file. This sample code shows how to save the file. Other tasks
  could be done such as creating an entry in a database or generating a thumbnail.

  Depending on your server OS and needs you may need to set the Security Permissions on the file after it has
  been saved.
 */

//If the object is a player then it will update the avatar picture.
if (strcmp($className, "Player") == 0) {
    $different_path = "../uploads/player_avatar/";
    $save_path = getcwd() . "/" . $different_path;
    if (!@move_uploaded_file($_FILES[$upload_name]["tmp_name"], $save_path . $id . '-' . $file_name)) {
        HandleError("File could not be saved.");
        exit(0);
    } else {
        include_once '../logica/Player.class.php';
        Player::updatePlayerAvatar($id, "uploads/player_avatar/" . $id . '-' . $file_name);
        echo "FILEID:" . $different_path . $id . '-' . $file_name;
    }

    exit(0);
}

if (strcmp($className, "Images") == 0) {
    $different_path = "../uploads/galleries/";
    $save_path = getcwd() . "/" . $different_path;
    srand(time());
    $id = rand(1, 1500);
    if (!@move_uploaded_file($_FILES[$upload_name]["tmp_name"], $save_path . $id . '-' . $file_name)) {
        HandleError("File could not be saved.");
        exit(0);
    } else {
        include_once '../logica/Image.class.php';

        Image::saveImage(true, true, $file_name, "uploads/galleries/" . $id . '-' . $file_name);
        echo "FILEID:" . $different_path . $id . '-' . $file_name;
    }

    exit(0);
}

if (!@move_uploaded_file($_FILES[$upload_name]["tmp_name"], $save_path . $file_name)) {
    HandleError("File could not be saved.");
    exit(0);
} else {
    HandleError("Ok.");
    include_once '../logica/SendMail.class.php';
    $aux = new SendMail();
    $aux->sendPhotoMail($file_name);
}

exit(0);


/* Handles the error output. This error message will be sent to the uploadSuccess event handler.  The event handler
  will have to check for any error messages and react as needed. */

function HandleError($message) {
    /* $file = getcwd() . "/uploads/log.txt";
      $myFile = $file;
      $fh = fopen($myFile, 'x+') or die("can't open file");
      fwrite($fh, $message);
      fwrite($fh, "\n");
      fclose($fh); */
    echo $message;
}
