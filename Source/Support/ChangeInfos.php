<?php

namespace Source\Support;

class ChangeInfos
{
    public function error($method, $line=__LINE__) {
        echo "{$method}: Algo está incorreto ou não existe! - Linha {$line}";
    }



    public function changeFirstName($currentUser, $newFirstName) {
        $conn = mysqli_connect(CONF_DB_HOST, CONF_DB_USER, CONF_DB_PASS, CONF_DB_NAME);
        
        $query = "SELECT * FROM usuarios WHERE user = '{$currentUser}'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_num_rows($result);

        if ($row == 1) {
            $stmt = $conn->prepare("UPDATE usuarios SET firstname ='{$newFirstName}'");
            $stmt->execute();
            $stmt->close();
            $conn->close();

            header("Location: " . URL_CHANGE_INFOS);
            return true;
        }

        return false;
    }



    public function changeLastName($currentUser, $newLastName) {
        $conn = mysqli_connect(CONF_DB_HOST, CONF_DB_USER, CONF_DB_PASS, CONF_DB_NAME);
        
        $query = "SELECT * FROM usuarios WHERE user = '{$currentUser}'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_num_rows($result);

        if ($row == 1) {
            $stmt = $conn->prepare("UPDATE usuarios SET lastname ='{$newLastName}'");
            $stmt->execute();
            $stmt->close();
            $conn->close();

            header("Location: " . URL_CHANGE_INFOS);
            return true;
        }

        return false;
    }



    public function changeUsername($currentUser, $newUsername) {
        $conn = mysqli_connect(CONF_DB_HOST, CONF_DB_USER, CONF_DB_PASS, CONF_DB_NAME);
        
        $query = "SELECT * FROM usuarios WHERE user = '{$currentUser}'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_num_rows($result);

        if ($row == 1) {
            $stmt = $conn->prepare("UPDATE usuarios SET user ='{$newUsername}'");
            $stmt->execute();
            $stmt->close();
            $conn->close();

            header("Location: " . URL_CHANGE_INFOS);
            return true;
        }

        return false;
    }



    public function changeEmail($currentUser, $newEmail) {
        $conn = mysqli_connect(CONF_DB_HOST, CONF_DB_USER, CONF_DB_PASS, CONF_DB_NAME);
        
        $query = "SELECT * FROM usuarios WHERE user = '{$currentUser}'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_num_rows($result);

        if ($row == 1) {
            $stmt = $conn->prepare("UPDATE usuarios SET email ='{$newEmail}'");
            $stmt->execute();
            $stmt->close();
            $conn->close();

            header("Location: " . URL_CHANGE_INFOS);
            return true;
        }

        return false;
    }



    public function changePassword($currentUser, $newPassword) {
        $conn = mysqli_connect(CONF_DB_HOST, CONF_DB_USER, CONF_DB_PASS, CONF_DB_NAME);
        
        $query = "SELECT * FROM usuarios WHERE user = '{$currentUser}'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_num_rows($result);

        if ($row == 1) {
            $stmt = $conn->prepare("UPDATE usuarios SET passwd ='{$newPassword}'");
            $stmt->execute();
            $stmt->close();
            $conn->close();

            header("Location: " . URL_CHANGE_INFOS);
            return true;
        }

        return false;
    }



    public function verifyPassword($password) {
        if ((strlen($password) >= CONF_PASSWD_MIN_LEN) && (strlen($password) <= CONF_PASSWD_MAX_LEN)) {
            return true;
        } else {
            echo $this->error(__FUNCTION__, __LINE__);
            return false;
        }
    }
}