<?php

/**
 * Description of ImageHandler
 *
 * @author rodrigo
 */
class ImageHandler {

    private $included = false;

    public function getConvertedPath($path, $height, $width, $crop = false, $admin = false) {
        if (!$this->included) {
            if (!$admin) {
                include './mdImageMagickHandler.class.php';
            } else {
                include '../logica/mdImageMagickHandler.class.php';
            }
            $this->included = true;
        }
        $arrStr = explode("/", $path);
        $arrStr = array_reverse($arrStr);
        $fileName = $arrStr[0];
        $directory = dirname($path);
        $realPath = getcwd();
        $returnPath = "";
        if($admin){
            $realPath .= "/../";
            $returnPath = "../";
        }else{
            $realPath .= "/";
        }
        $originalFile = $realPath.$directory.'/'.$fileName;
        $convertedPath = $realPath.$directory.'/cache/'.$height.'X'.$width;
        $returnPath .= $directory.'/cache/'.$height.'X'.$width;
        if($crop){
            $convertedPath .= "C";
            $returnPath .= "C";
        }
        $convertedPathFile = $convertedPath."/".$fileName;
        $returnPath .= "/".$fileName;
        if(!$this->fileExists($convertedPathFile)){
            self::checkDirectory($convertedPath);
            $mdImage = new mdImageMagickHandler($originalFile, $convertedPathFile, $width, $height, $crop);
            $mdImage->process();
        }
        return $returnPath;
    }

    private function fileExists($file) {
        return file_exists($file);
    }
    
	public static function checkDirectory($path){
		if (is_dir($path)) {
            $last = $path[strlen($path)-1];
            if($last == '/'){
                return $path;
            }
			return $path.'/';
		}
		$folders = $pieces = explode("/", $path);
		$smallPath = "/";
		foreach($folders as $folder){
			$smallPath .= $folder;
			if (!is_dir($smallPath)) {
				if(!mkdir($smallPath)) {
					if (!is_dir($smallPath)) {
						throw new Exception('Unable to create format directory');
					}
				}
				chmod($smallPath,0775);
			}
			$smallPath .= '/';
		}
		return $path;
	}
}

