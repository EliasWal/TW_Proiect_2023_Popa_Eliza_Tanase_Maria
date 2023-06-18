<?php 
    require "../config.php";

    session_start();

    function createUser($firstname, $lastname, $email, $username, $password, $pronouns, $gender) {
        global $mysql;
        $sql = "INSERT INTO user_registred(firstname, lastname, email, username, password, gender, pronouns) VALUES(?,?,?,?,?,?,?)";
        $stmtcreate = $mysql->prepare($sql);
        $stmtcreate->bind_param("sssssss", $firstname, $lastname, $email, $username, $password, $gender, $pronouns);
        if($stmtcreate->execute()) {
            return true;
        }
        else {
            return false;
        }

    }

    function isAlreadyUser($username, $email) {
        global $mysql;
        $sql = "SELECT * FROM user_registred where username=? or email = ?";
        $stmtcheck = $mysql->prepare($sql);
        $stmtcheck->bind_param("ss", $username, $email);
        $stmtcheck->execute();
        $result = $stmtcheck->get_result();
        if ($result->num_rows === 0) {
            return false;
        }
        else {
            return true;
        }
    }
?>