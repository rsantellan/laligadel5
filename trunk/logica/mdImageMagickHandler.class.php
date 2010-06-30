<?php

/**
 * Description of mdImageMagickHandler
 *
 * @author rodrigo
 */
class mdImageMagickHandler {

    //put your code here

    private $width = 0;
    private $height = 0;
    private $crop = false;
    private $imageSource = "";
    private $fileDestination = "";
    private $convertPath = "convert";

    private $imageMagickLocation = '/usr/bin/'; // Produccion '/usr/local/bin/'; // local '/usr/bin/'
    
    /**
     *
     * @param <String> $imageSource
     * @param <String> $folderDestination
     * @param <int> $width
     * @param <int> $height
     * @param <boolean> $crop
     */
    public function __construct($imageSource, $fileDestination, $width, $height, $crop = false) {
        $this->crop = $crop;
        $this->height = $height;
        $this->width = $width;
        $this->imageSource = $imageSource;
        $this->fileDestination = $fileDestination;
        $this->convertPath = $this->imageMagickLocation . $this->convertPath;
    }

    private function fileGenerate() {
        if (!$this->fileExist($this->imageSource)) {
            throw new Exception("No image has been given", 8181);
        }

        $fileSrc = $this->imageSource;
        $fileDsc = $this->fileDestination;

        $imageDetails = getimagesize($fileSrc);

        if ($this->crop) {
            $command = $this->getConvertCropCommand($this->width, $this->height);
        } else {
            $command = ' -resize ' . $this->width . 'x' . $this->height;
        }

        $command .= ' -interlace line -format JPEG -quality 95%';

        $exec = $this->convertPath . " $command $fileSrc $fileDsc";

        exec($exec);

        if (is_readable($fileDsc)) {
            chmod($fileDsc, 0775);
        }
    }

    private function fileExist($file) {
        return file_exists($file);
    }

    private function getConvertCropCommand($width, $height=null) {
        $commands = "";
        if ($height === null)
            $height = $width;

        // get size of the original
        $imginfo = getimagesize($this->imageSource);
        $orig_w = $imginfo[0];
        $orig_h = $imginfo[1];
        // resize image to match either the new width
        // or the new height
        // if original width / original height is greater
        // than new width / new height
        if ($orig_w / $orig_h > $width / $height) {
            // then resize to the new height...
            $commands .= ' -resize "x' . $height . '"';
            // ... and get the middle part of the new image
            // what is the resized width?
            $resized_w = ($height / $orig_h) * $orig_w;
            // crop
            $commands .= ' -crop "' . $width . 'x' . $height .
                    '+' . round(($resized_w - $width) / 2) . '+0"';
        } else {
            // or else resize to the new width
            $commands .= ' -resize "' . $width . '"';
            // ... and get the middle part of the new image
            // what is the resized height?
            $resized_h = ($width / $orig_w) * $orig_h;
            // crop
            $commands .= ' -crop "' . $width . 'x' . $height .
                    '+0+' . round(($resized_h - $height) / 2) . '"';
        }

        return $commands;
    }

    public function process(){
        $this->fileGenerate();
    }
    
    public function getImage() {
        if ($this->fileExist($this->fileDestination)) {
            return file_get_contents($this->fileDestination);
        } else {
            if ($this->fileExist($this->imageSource)) {
                $this->fileGenerate();
                return file_get_contents($this->fileDestination);
            } else {
                throw new Exception("No image has been given", 150);
            }
        }
    }

    /*
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
    */
}

