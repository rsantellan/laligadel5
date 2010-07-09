<?php

/**
 * Description of ImageHandler
 *
 * @author rodrigo
 */
class ImageHandler {

    private $included = false;

    public function getConvertedPath($path, $height, $width, $crop = false, $admin = false, $ajax = false) {
        if (!$this->included) {
            if (!$admin) {
                include 'mdImageMagickHandler.class.php';
            } else {
                if($ajax) {
                    include '../../logica/mdImageMagickHandler.class.php';
                }else {
                    include '../logica/mdImageMagickHandler.class.php';
                }

            }
            $this->included = true;
        }
        $arrStr = explode("/", $path);
        $arrStr = array_reverse($arrStr);
        $fileName = $arrStr[0];
        $directory = dirname($path);
        $realPath = getcwd();
        $returnPath = "";
        if ($admin) {
            if (!$ajax) {
                $realPath .= "/../";
                $returnPath = "../";
            } else {
                $realPath .= "/../../";
                $returnPath = "../../";
            }
        } else {
            $realPath .= "/";
        }
        $originalFile = $realPath . $directory . '/' . $fileName;

        $convertedPath = $realPath . $directory . '/cache/' . $height . 'X' . $width;
        $returnPath .= $directory . '/cache/' . $height . 'X' . $width;
        if ($crop) {
            $convertedPath .= "C";
            $returnPath .= "C";
        }
        $convertedPathFile = $convertedPath . "/" . $fileName;
        $returnPath .= "/" . $fileName;
        if (!$this->fileExists($convertedPathFile)) {
            self::checkDirectory($convertedPath);

            $mdImage = new mdImageMagickHandler($originalFile, $convertedPathFile, $width, $height, $crop);
            $mdImage->process();
        }
        return $returnPath;
    }

    private function fileExists($file) {
        return file_exists($file);
    }

    public static function checkDirectory($path) {
        if (is_dir($path)) {
            $last = $path[strlen($path) - 1];
            if ($last == '/') {
                return $path;
            }
            return $path . '/';
        }
        $folders = $pieces = explode("/", $path);
        $smallPath = "/";
        foreach ($folders as $folder) {
            $smallPath .= $folder;
            if (!is_dir($smallPath)) {
                if (!mkdir($smallPath)) {
                    if (!is_dir($smallPath)) {
                        throw new Exception('Unable to create format directory');
                    }
                }
                chmod($smallPath, 0775);
            }
            $smallPath .= '/';
        }
        return $path;
    }

    public function remove($file) {
        if (!$this->fileExists($file)) {
            return false;
        }
        if (!@unlink($file)) {
            throw new Exception('image not deleted');
        }
        return true;
    }

    public function removeCompleteImage($file) {
        if ($this->remove($file)) {
            $directory = dirname($file);
            $arrStr = explode("/", $file);
            $arrStr = array_reverse($arrStr);
            $fileName = $arrStr[0];

            self::findAndRemoveFile($directory, $fileName);
        } else {
            throw new Exception('Ahhh no la pudo borrar');
        }
    }

    private static function findAndRemoveFile($path, $fileName) {
        //using the opendir function
        $dir_handle = @opendir($path) or die("Unable to open $path");

        //running the while loop
        while (false !== ($file = readdir($dir_handle))) {
            if ($file != "." && $file != "..") {

                if (is_dir($path . '/' . $file)) {
                    self::findAndRemoveFile($path . '/' . $file, $fileName);
                } else {
                    if ($file == $fileName) {
                        if (!unlink($path . '/' . $fileName)) {
                            throw new Exception('image not deleted of cache', 150);
                        }
                    }
                }
            }
        }

        //closing the directory
        closedir($dir_handle);
    }

    //# Original PHP code by Chirp Internet: www.chirp.com.au
    //# Please acknowledge use of this code by including this header.
    public function getFileList($dir, $noDirectories = false, $noCache = false, $recurse=false) {
        # array to hold return value
        $retval = array();

        # add trailing slash if missing
        if(substr($dir, -1) != "/") $dir .= "/";

        # open pointer to directory and read list of files
        $d = @dir($dir) or die("getFileList: Failed opening directory  $dir for reading");

        while(false !== ($entry = $d->read())) {
            # skip hidden files
            if($entry[0] == ".") continue;
            if(is_dir("$dir$entry")) {
                if(!$noDirectories){
                    $retval[] = array(
                        "name" => "$dir$entry/",
                        "type" => filetype("$dir$entry"),
                        "size" => 0,
                        "lastmod" => filemtime("$dir$entry")
                            );
                }

                if($recurse && is_readable("$dir$entry/")) {
                    if($noCache){
                       if($entry != 'cache'){
                            $retval = array_merge($retval, $this->getFileList("$dir$entry/", $noDirectories, $noCache, true));
                       }
                    }
                    
                }
            }
            elseif(is_readable("$dir$entry")) {
                $retval[] = array(
                        "name" => "$dir$entry",
                        "type" => mime_content_type("$dir$entry"),
                        "size" => filesize("$dir$entry"),
                        "lastmod" => filemtime("$dir$entry")
                    );
            }
        }
        $d->close();
        return $retval;
    }

}

