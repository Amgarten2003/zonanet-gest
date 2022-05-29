<?php

namespace Source\Support;

class Token
{
    private $token;
    private $active = 1;



    public function error($method, $line=__LINE__) {
        echo "{$method}: Algo está incorreto ou não existe! - Linha {$line}"; 
    }



    public function getToken() {
        return $this->token;
    }



    public function setToken($token) {
        $this->token = $token;
    }



    public function generateToken() {
        // Generating the Token
        $combinations = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $generatedToken = array_rand($combinations, 7);
        $token = implode("", $generatedToken);
        return $token;
    }



    public function sendTokenToDB($token) {

        // Establishing connection to DataBase
        $conn = mysqli_connect(CONF_DB_HOST, CONF_DB_USER, CONF_DB_PASS, CONF_DB_NAME);

        if ($conn->connect_error) {
            die('Conexão falhou: ' . $conn->connect_error);
        } else {
            // Sending the token and the active parameter to the DataBase
            $stmt = $conn->prepare("INSERT INTO token(token, active) VALUES (?, ?)");
            $stmt->bind_param("si", $token, $this->active);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }
    }
    
    

    public function verifyToken($token) {
        $conn = mysqli_connect(CONF_DB_HOST, CONF_DB_USER, CONF_DB_PASS, CONF_DB_NAME);
        $sql = "SELECT * FROM token";
        $result = $conn->query($sql);
        $seem_tokens = [];

        // Getting all the results of the column 'token' and adding them to the 'seem_token' variable
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($seem_tokens, $row['token']);
            }
        }
        
        
        // Verifying if the token exists in the array 'seem_token'
        if (in_array($token, $seem_tokens)) {
           // header("Location: " . URL_HOME);
           return true;
        } else {
            echo "{$this->error(__FUNCTION__, __LINE__)}";
            return false;
        }
    }


    
    public function setInactiveToken($token) {
        // Setting the token as inactive after the validation
        $this->active = 0;
        $conn = mysqli_connect(CONF_DB_HOST, CONF_DB_USER, CONF_DB_PASS, CONF_DB_NAME);
        $sql = "UPDATE token SET active='{$this->active}' WHERE token=$token";
        $result = $conn->query($sql);
        $conn->close();
        
        return true;
    }
}