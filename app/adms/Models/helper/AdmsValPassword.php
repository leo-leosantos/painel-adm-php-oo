<?php


namespace App\Adms\Models\helper;


class AdmsValPassword
{
    private string $password;
    private bool $result;

    function getResult(): bool
    {
        return $this->result;
    }
    public function validatePassword(string $password): void
    {
        $this->password = $password;
        if (stristr($this->password, "'")) {
            $_SESSION['msg'] = "<p> Caracter ' invalido<p/>";
            $this->result = false;
        } else {
            if (stristr($this->password, " ")) {
                $_SESSION['msg'] = "<p> Error: espaço em branco  não permitido<p/>";
                $this->result = false;
            } else {
                $this->valExtensionPassword();
            }
        }
    }

    private function valExtensionPassword(): void
    {
        if (strlen($this->password) < 6) {
            $_SESSION['msg'] = "<p> Error: senha no mimino   6 caracteres<p/>";
            $this->result = false;
        } elseif(strlen($this->password) > 15) {
            $_SESSION['msg'] = "<p> Error: senha no maximo   15 caracteres<p/>";
            $this->result = false;
        }else{
            $this->valValuePassword();

        }
    }

    private function valValuePassword(): void
    {
        if(preg_match('/^(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z0-9-@#$%*]{6}$/', $this->password)){
            $this->result = true;

        }else{
            $_SESSION['msg'] = "<p> Error: senha deve ter letras e numeros<p/>";
            $this->result = false;
        }
    }
}
