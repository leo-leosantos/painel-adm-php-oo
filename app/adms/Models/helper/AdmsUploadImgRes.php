<?php


namespace App\Adms\Models\helper;



class AdmsUploadImgRes extends AdmsConn
{
    private array $imageData;
    private string $directory;
    private string $name;
    private int  $width;
    private int  $height;

    private $newImage;
    private bool $result;
    private $imgResize;

    function getResult(): bool
    {
        return $this->result;
    }

    public function upload(array $imageData, string $directory, string $name, int $width, int $height): void
    {
        $this->imageData = $imageData;
        $this->directory = $directory;
        $this->name = $name;
        $this->width = $width;
        $this->height = $height;

        $this->valDirectory();
    }


    private function valDirectory(): void
    {


        if ((file_exists($this->directory) and (!is_dir($this->directory)))) {
            $this->createDir();
        } elseif (!file_exists($this->directory)) {
            $this->createDir();
        } else {
            $this->uploadFile();
        }
    }



    private function createDir(): void
    {
        mkdir($this->directory, 0755);
        if (!file_exists($this->directory)) {
            $_SESSION['msg'] = "Error upload error linha 60";
            $this->result = false;
        } else {
            $this->uploadFile();
        }
    }

    private function uploadFile(): void
    {

        switch ($this->imageData['type']) {

            case 'image/jpeg':
            case 'image/jpg':
            case 'image/pjpeg':
                $this->uploadFileJpeg();
                break;
            case 'image/png':
            case 'image/x-png':
                $this->uploadFilePng();
                break;

            default:

                $_SESSION['msg'] = "<p style='color: #f00'>Error Image deve ser png pu jpeg linha 80</p>";
                $this->result = false;
        }
    }


    private function uploadFileJpeg(): void
    {

        $this->newImage = imagecreatefromjpeg($this->imageData['tmp_name']);
       $this->redImage();

       if(imagejpeg($this->imgResize, $this->directory . $this->name, 100)){
        $this->result = true;
        $_SESSION['msg'] = "<p style='color: #008000'> uplada da imgae jpeg  realizado com uscesso linha 93</p>";

       }else{
        $this->result = false;
        $_SESSION['msg'] = "<p style='color: #f00'>Error uplada da imgae jpeg nao realizado linha 97</p>";

       }

    }


    
    private function uploadFilePng(): void
    {

        $this->newImage = imagecreatefrompng($this->imageData['tmp_name']);
        $this->redImage();

       if(imagepng($this->imgResize, $this->directory . $this->name, 1)){
        $this->result = true;
        $_SESSION['msg'] = "<p style='color: #008000'> uplada da imgae png  realizado com uscesso linha 93</p>";

       }else{
        $this->result = false;
        $_SESSION['msg'] = "<p style='color: #f00'>Error uplada da imgae png nao realizado linha 97</p>";

       }

    }

    private function redImage(): void
    {
         $width_original =   imagesx($this->newImage);
         $height_original =   imagesy($this->newImage);

        $this->imgResize = imagecreatetruecolor($this->width, $this->height);       

        imagecopyresampled($this->imgResize, $this->newImage , 0,0,0,0, $this->width, $this->height, $width_original, $height_original);

    }
}
