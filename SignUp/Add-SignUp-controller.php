<?php
    require '../config.php';
    require "signup-service.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstname = $_POST['name1'];
        $lastname = $_POST['name2'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repassword = $_POST['repeatpassword'];
        $pronouns = $_POST['pronouns'];
        $gender = $_POST['gender'];

        if (isAlreadyUser($username, $email))
        {
            echo "<script>
                alert('Username or Email already taken!');
                window.location.href = 'http://localhost/TW_Proiect_2023_Popa_Eliza_Tanase_Maria/SignUp/SignUp.php';
            </script>";
        }
        else {
            if($password != $repassword)
            {
                echo "<script>
                    alert('Password does not match!');
                    window.location.href = 'http://localhost/TW_Proiect_2023_Popa_Eliza_Tanase_Maria/SignUp/SignUp.php';
                </script>";
            }
            else {
                if(createUser($firstname, $lastname, $email, $username, $password, $pronouns, $gender)) {
                    echo "<script>
                        alert('Account created!');
                        window.location.href = 'http://localhost/TW_Proiect_2023_Popa_Eliza_Tanase_Maria/SignUp/SignUp.php';
                    </script>";
                }
                else {
                    echo"<script>
                        alert('Error. Account could not be created!');
                        window.location.href = 'http://localhost/TW_Proiect_2023_Popa_Eliza_Tanase_Maria/SignUp/SignUp.php';
                    </script>";
                }
            }
        }
    }

?>