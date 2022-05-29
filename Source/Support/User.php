<?php

namespace Source\Support;

class User
{
    private $email;
    private $password;



    public function error($method, $line=__LINE__) {
        echo "{$method}: Algo está incorreto ou não existe! - Linha {$line}";
    }



    public function getEmail() {
        return $this->email;
    }



    public function getPassword() {
        return $this->password;
    }



    public function setEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
            return true;
        } else {
            return "{$this->error(__FUNCTION__, __LINE__)}";
        }
    }


    
    public function setPassword($password) {
        if ((strlen($password) >= CONF_PASSWD_MIN_LEN) && (strlen($password) <= CONF_PASSWD_MAX_LEN)) {
            $this->password = $password;
            return true;
        } else {
            echo $this->error(__FUNCTION__, __LINE__);
            return false;
        }
    }
}
