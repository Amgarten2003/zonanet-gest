<?php

namespace Source\Support;

class ChangePass
{
    public function error($method, $line=__LINE__) {
        echo "{$method}: Algo está incorreto ou não existe! - Linha {$line}";
    }



    public function verifyOldPassword($password, $email) {
        $conn = mysqli_connect(CONF_DB_HOST, CONF_DB_USER, CONF_DB_PASS, CONF_DB_NAME);
        $sql = "SELECT * FROM usuarios";
        $result = $conn->query($sql);
        $seem_passwords = [];

        // Getting all the results of the column 'passwd' and adding them to the 'seem_passwords' variable
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($seem_passwords, $row['passwd']);
            }
        }

        // Verifying if the new password is equals to the old one
        $sql = "SELECT * FROM usuarios WHERE email='{$email}' AND passwd='{$password}'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            echo "A nova senha deve ser diferente da antiga!"; 
            return false;
        } else {
            return true;
        }
    }



    public function changePass($password, $email) {
        $conn = mysqli_connect(CONF_DB_HOST, CONF_DB_USER, CONF_DB_PASS, CONF_DB_NAME);
        $sql = "UPDATE usuarios SET passwd='{$password}' WHERE email='{$email}'";
        $result = $conn->query($sql);
        $conn->close();

        if ($result) {
            echo "Senha alterada!";
            header("Location: " . URL_HOME);
            return true;
        } else {
            $this->error(__FUNCTION__, __LINE__);
            return false;
        }
    }
}