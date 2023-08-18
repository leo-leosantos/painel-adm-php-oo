<?php


namespace App\Adms\Models\helper;


class AdmsUpload
{
    private string $directory;
    private string $tmpName;
    private string $name;
    private bool $result;

    function getResult(): bool
    {
        return $this->result;
    }

    public function upload(string $directory, string $tmpName, string $name): void
    {
        $this->directory = $directory;
        $this->tmpName = $tmpName;
        $this->name = $name;

        if ($this->valDirectory()) {
            $this->uploadFile();
        } else {
            $this->result =  false;
        }
    }


    private function valDirectory(): bool
    {
        if ((!file_exists($this->directory))  and (!is_dir($this->directory))) {
            mkdir($this->directory, 0755);
            if ((!file_exists($this->directory))  and (!is_dir($this->directory))) {
                $_SESSION['msg'] =  '<p>Error: Upload error linha 32 amdsUpodad</p>';

                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }


    private function uploadFile()
    {
        if (move_uploaded_file($this->tmpName, $this->directory . $this->name)) {
            $this->result =  true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Error no upload 58 amdUplod </p>";
            $this->result = false;
        }
    }
}
