<?php

namespace Source\Support;

class Login
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
        $this->password = $email;
    }



    public function setPassword($password) {
        $this->password = $password;
    }



    public function verifyCredentials($email, $password) {
        $conn = mysqli_connect(CONF_DB_HOST, CONF_DB_USER, CONF_DB_PASS, CONF_DB_NAME);

        $query = "SELECT * FROM usuarios WHERE email = '{$email}' AND passwd = '{$password}'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_num_rows($result);

        // Checking if user exists in the DataBase, if true, redirect user to the Home Page
        if($row == 1) {
            header("Location: " . URL_HOME);
            exit();
            return true;
        } else {
            var_dump($row);
            exit();
            return false;
        }
    }
}