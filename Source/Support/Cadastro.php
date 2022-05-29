<?php

namespace Source\Support;

class Cadastro
{
    private $firstName;
    private $lastName;
    private $user;
    private $email;
    private $password;



    public function error($method, $line=__LINE__) {
        echo "{$method}: Algo está incorreto ou não existe! - Linha {$line}"; 
    }



    public function getFirstName() {
        return $this->firstName;
    }



    public function getLastName() {
        return $this->lastName;
    }



    public function getUser() {
        return $this->user;
    }



    public function getEmail() {
        return $this->email;
    }



    public function getPassword() {
        return $this->password;
    }


    
    public function setFirstName($firstName) {
        $this->firstName = filter_var($firstName, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }


    public function setLastName($lastName) {
        $this->lastName = filter_var($lastName, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }



    public function setUser($user) {
        $this->user = filter_var($user, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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


    
    public function confirmPassword($password, $confirmPassword) {
        // Confirming if the password if equals to the second one
        
        if ($password !== $confirmPassword) {
            echo "As senhas precisam ser iguais!";
            return false;
        } else {
            return true;
        }
    }



    public function createUser($firstName, $lastName, $user, $email, $password) {
        // Setting the user's info
        $firstName = $this->firstName;
        $lastName = $this->lastName;
        $user = $this->user;
        $email = $this->email;
        $password = $this->password;
        
        $conn = mysqli_connect(CONF_DB_HOST, CONF_DB_USER, CONF_DB_PASS, CONF_DB_NAME);
        

        // Executing the insertion query of the user's informations into the DataBase
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        } else {
            $stmt = $conn->prepare("INSERT INTO usuarios(firstname, lastname, user, email, passwd) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $firstName, $lastName, $user, $email, $password);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }


        // Destroying the user informations after the execution of the MySQL Query
        $firstName = null;
        $lastName = null;
        $user = null;
        $email = null;
        $password = null;

        return true;
    }


    
    public function verifyExistingAccount($user, $email) {
        $conn = mysqli_connect(CONF_DB_HOST, CONF_DB_USER, CONF_DB_PASS, CONF_DB_NAME);
        
        $queryUser = "SELECT * FROM usuarios WHERE user = '{$user}'";
        $resultUser = mysqli_query($conn, $queryUser);
        $row = mysqli_num_rows($resultUser);
        
        $canUseUser = false;
        $canUseEmail = false;

        // Checking if user already exists in the DataBase
        if($row == 0) {
            $canUseUser = true;
        } else {
            echo "USUARIO JÁ EXISTE";
            return false;
        }

        // Creating the email query
        $queryEmail = "SELECT * FROM usuarios WHERE email = '{$email}'";
        $resultEmail = mysqli_query($conn, $queryEmail);
        $rowEmail = mysqli_num_rows($resultEmail);

        // Checking if email already exists in the DataBase
        if($rowEmail == 0) {
            $canUseEmail = true;
        } else {
            echo "EMAIL JÁ EXISTE";
            return false;
        }


        // If user can use his username and email, return true 
        if ($canUseUser && $canUseEmail) {
            $conn->close();
            return true;
        } else {
            return false;
        }
    }
}