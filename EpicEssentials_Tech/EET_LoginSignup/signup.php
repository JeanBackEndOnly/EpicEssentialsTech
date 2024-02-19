<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){
   $username = $_POST["username"];
   $userpassword = $_POST["userpassword"];
   $email = $_POST["email"];
    try {
        require_once 'connectionToDb.php';
        require_once 'signup_model.php';
        require_once 'signup_contr.php';

        $errors = [];
        if(is_empty_inputs($username, $userpassword, $email)){
            $errors["empty_inputs"] = "Please fill all fields!";
        }
        if(is_invalid_email($email)){
            $errors["invalid_email"] = "Please input valid email!";
        }
        if(is_username_taken($pdo, $username)){
            $errors["username_taken"] = "Username already taken!";
        }
        if(is_email_registered($pdo, $email)){
            $errors["email_registered"] = "Email has been already registered!";
        }

        require_once 'session.php';

        if($errors){
            $_SESSION["errors_signup"] = $errors;
            $signupData = [
                "username" => $username,
                "email" => $email
            ];
            $_SESSION["signup_data"] = $signupData;
           // $userRole = "regular"; 
           // $_SESSION["user-role"] = $userRole;
            header("Location: ../index.php");
            die();
        }
            create_user($pdo, $username, $userpassword, $email);
            header("Location: ../index.php?signup=success");

            $pdo = null;
            $stmtm = null;

            die();
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}else{
    header("Location: ../index.php");
    die();
}