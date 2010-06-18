<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PictureListingclass
 *
 * @author rodrigo
 */
class PictureListing {

    public static function getFileList($dir) {
        // array to hold return value
        $retval = array();
        // add trailing slash if missing
        if(substr($dir, -1) != "/") $dir .= "/";
        // open pointer to directory and read list of files
        $d = @dir($dir) or die("getFileList: Failed opening directory $dir for reading");

        while(false !== ($entry = $d->read())) {
            // skip hidden files
            if($entry[0] == ".") continue;
               if(!is_dir("$dir$entry")) {
                $retval[] = array("picture" => $dir.$entry, "thumb" => $dir.'thumbs/'.$entry);
               }
        }
        $d->close();
        return $retval;
    }
}

