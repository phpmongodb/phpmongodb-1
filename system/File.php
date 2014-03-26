<?php
/**
 * @package PHPmongoDB
 * @version 1.0.0
 */
defined('PMDDA') or die('Restricted access');

class File {

    public $path;
    public $file;
    public $success = true;
    public $message;

    public function __construct($path = NULL, $file = NULL) {
        $this->path = $path;
        $this->file = $file;
    }

    public function write($content) {

        if (!$handle = fopen($this->path . $this->file, 'a')) {
            $this->success = false;
            $this->message = 'Cannot open file (' . $this->path . $this->file . ')';
            exit;
        }

        if (fwrite($handle, $content) === FALSE) {
            $this->success = false;
            $this->message = 'Cannot write to file (' . $this->path . $this->file . ')';
            exit;
        }
        $this->success = true;
        $this->message = 'Success, wrote (' . $content . ') to file (' . $this->path . $this->file . ')';
        fclose($handle);
    }

    public function download($file = FALSE, $path = FALSE) {
        if (!$file && !$path) {
            $file = $this->path . $this->file;
        } else if (!$path) {
            $file = $this->path . $file;
        } else if (!$file) {
            $file = $path . $this->file;
        }
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;
    }

    public function delete($file = FALSE,$path=FALSE) {
         if (file_exists($this->path.$this->file)) {
            unlink($this->path . $this->file);
         }
    }
    
    /* creates a compressed zip file */

    function createZip($files = array(), $destination = '', $overwrite = false,$path=false) {
        if(!$path){
            $path=$this->path;
        }
        $destination=$path.$destination;
        //if the zip file already exists and overwrite is false, return false
        if (file_exists($destination) && !$overwrite) {
            $this->message="the zip file already exists and overwrite is false";
            return false;
        }
        //vars
        $validFiles = array();
        //if files were passed in...
        if (is_array($files)) {
            //cycle through each file
            foreach ($files as $file) {
                //make sure the file exists
                if (file_exists($path.$file)) {
                    $validFiles[] = $file;
                }
            }
        }
        //if we have good files...
        if (count($validFiles)) {
            //create the archive
            $zip = new ZipArchive();
            if ($zip->open($destination, $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
                $this->message="unable to create the archive";
                return false;
            }
            //add the files
            foreach ($validFiles as $file) {
                $zip->addFile($path.$file, $file);
            }
            //debug
            //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
            //close the zip -- done!
            $zip->close();

            //check to make sure the file exists
            return file_exists($destination);
        } else {
            $this->message="file not exitst";
            return false;
        }
    }

}