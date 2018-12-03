<?php
/**
 * Created by PhpStorm.
 * User: Виктор
 * Date: 26.07.2018
 * Time: 15:25
 */

class Editor
{
    public $TaskModel;
    protected $fileDest;

    public function __construct()
    {
       require_once(ROOT . '/models/Task.php');
       $this->TaskModel = new Task();
       $this->fileDest = NULL;
    }

    public function actionNewtask()
    {
        if (isset($_POST['post'])) {
            if (isset($_FILES['Image']['size'])) {
                $this->checkUploadedFile();
            }
            $this->TaskModel->saveTask($this->fileDest);
            header('Refresh: 2, url=../');
        } else {
            require_once(ROOT . '/views/TaskEditor.php');
        }
    }

    protected function checkUploadedFile()
    {
        $this->fileDest = ROOT .'/images/';
        $name = uniqid('', true);
        $this->fileDest .= '/'.$name;
        if (!(move_uploaded_file($_FILES['Image']['tmp_name'], $this->fileDest) AND
            preg_match("'^(image\/){1}((png)|(jpeg)|(gif)){1}$'", $_FILES['Image']['type']))) {
            $this->fileDest = NULL;
        } else {
            $this->imageCropAny();
            $this->fileDest = '/images/'.$name;
        }
    }

    public function cropUploadedFile($im)
    {
        $width = imagesx($im);
        $height = imagesy($im);
        $x = ((0 + $width)/2) - 160; // get center coordinates to place crop rectangle in image center.
        $y = (($height + 0)/2) - 120;
        if ($width > 320 OR $height > 240) {
            return imagecrop($im, ['x' => $x, 'y' => $y, 'width' => 320, 'height' => 240]);
        } else {
            return $im;
        }
    }

    public function imageCropAny()
    {
        $type = $_FILES['Image']['type'];
        $allowedTypes = array(
            'image/gif',
            'image/jpeg',
            'image/png'
        );
        if (!in_array($type, $allowedTypes)) {
            return false;
        }
        switch (array_search($type, $allowedTypes)) {
            case 0 :
                $im = imageCreateFromGif($this->fileDest);
                $imgcropped = $this->cropUploadedFile($im);
                imagegif($imgcropped, $this->fileDest);
                break;
            case 1 :
                $im = imageCreateFromJpeg($this->fileDest);
                $imgcropped = $this->cropUploadedFile($im);
                imagejpeg($imgcropped, $this->fileDest);
                break;
            case 2 :
                $im = imageCreateFromPng($this->fileDest);
                $imgcropped = $this->cropUploadedFile($im);
                imagepng($imgcropped, $this->fileDest);
                break;
        }
        imagedestroy($im);
        imagedestroy($imgcropped);
        return true;
    }
}