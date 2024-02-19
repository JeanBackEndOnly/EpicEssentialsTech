<?php
/*
if($_SERVER["REQUEST_METHOS"] === "POST"){
    $username = $_POST["username"];
    $userpassword = $_POST["userpassword"];

    try {
        require_once 'connectionToDb.php';
        require_once 'login_model.php';
        require_once 'login_contr.php';

        $erros = [];

        require_once 'session.php';

        if(is_inputs_empty($username, $userpassword)){
            $erros["empty_inputs"] = "Please fill all fields!";
        }
        $username_result = get_user($pdo, $username);
        if(is_username_wrong($result)){
            $erros["login_incorrect"] = "Username Doesn't exist!";
        }
        if(is_userpassword_wrong($userpassword, $result["userpassword"])){
            $erros["login_incorrect"] = "Wrong password!";
        }        
        if(is_username_wrong($result) && is_userpassword_wrong($userpassword, $result["userpassword"])){
            $erros["login_incorrect"] = "account doesn't exist!";
        }

        if($errors){
            $_SESSION["errors_login"] = $errors;
            $signupData = [
                "username" => $username,
                "email" => $email
             ];
             $_SESSION["signup_data"] = $signupData;
 
            header("Location: ../index.php");
            die();
        }

        $newSessionId = session_create_id();
        $SessionId = $newSessionId . "_" . $result["id"];
        session_id($SessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);

        $_SESSION["last_regeneration"] = time();

        error_log("Redirecting user with role: " . $_SESSION["user-role"]);

        if(isset($_SESSION["user-role"]) !== "Admin"){
            header("Location: ../index.php?login=success");

            $pdo = null;
            $statement = null;

            die();
        }else if(isset($_SESSION["user-role"]) === "Admin"){
            header("Location: ../index.php?login=success");

            $pdo = null;
            $statement = null;

            die();
        }
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}else{
    header("Location: ../index.php");
    die();
}
*/
/*
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = $_POST["username"];
    $userpassword = $_POST["userpassword"];

    try {
        require_once 'connectionToDb.php';
        require_once 'login_model.php';
        require_once 'login_contr.php';

        $errors = []; // Corrected variable name

        require_once 'session.php';

        if(is_inputs_empty($username, $userpassword)){
            $errors["empty_inputs"] = "Please fill all fields!";
        }
        $result = get_user($pdo, $username); // Corrected variable name
        /* if(is_username_wrong($result)){
            $errors["login_incorrect"] = "Username Doesn't exist!";
        } */
        if($result !== null && is_username_wrong($result)){
            $errors["login_incorrect"] = "Username Doesn't exist!";
        }        
        /* if(is_userpassword_wrong($userpassword, $result["userpassword"])){
            $errors["login_incorrect"] = "Wrong password!";
        }  */ /*  
        if ($result === null) {
            // Handle the case where the user doesn't exist
            $errors["login_incorrect"] = "Username Doesn't exist!";
        } else {
            if (is_userpassword_wrong($userpassword, $result["userpassword"])) {
                $errors["login_incorrect"] = "Wrong password!";
            }
        }
         
        if(is_username_wrong($result) && is_userpassword_wrong($userpassword, $result["userpassword"])){
            $errors["login_incorrect"] = "Account doesn't exist!";
        }

        if($errors){ // Corrected variable name
            $_SESSION["errors_login"] = $errors;
            $signupData = [
                "username" => $username,
                "email" => $email
             ];
             $_SESSION["signup_data"] = $signupData;
 
            header("Location: ../index.php");
            die();
        }

        $newSessionId = session_create_id();
        $SessionId = $newSessionId . "_" . $result["id"];
        session_id($SessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);

        $_SESSION["last_regeneration"] = time();

        error_log("Redirecting user with role: " . $_SESSION["user-role"]);

        if($_SESSION["user-role"] !== "Admin"){ // Corrected session variable check
            header("Location: ../RegularPage/index.php?login=success");

            $pdo = null;
            $statement = null;

            die();
        }else if($_SESSION["user-role"] === "Admin"){ // Corrected session variable check
            header("Location: ../AdminPage/index.php?login=success");

            $pdo = null;
            $statement = null;

            die();
        }
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}else{
    header("Location: ../index.php");
    die();
}
*/
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $userpassword = $_POST["userpassword"];

    try {
        require_once 'connectionToDb.php';
        require_once 'login_model.php';
        require_once 'login_contr.php';

        $errors = [];

        require_once 'session.php';

        if (is_inputs_empty($username, $userpassword)) {
            $errors["empty_inputs"] = "Please fill all fields!";
        }
        $result = get_user($pdo, $username);
        
        if ($result === null) {
            // Handle the case where the user doesn't exist
            $errors["login_incorrect"] = "Username Doesn't exist!";
        } else {
            if (is_userpassword_wrong($userpassword, $result["userpassword"])) {
                $errors["login_incorrect"] = "Wrong password!";
            }
        }
         
        if (is_username_wrong($result) && isset($errors["login_incorrect"])) {
            // Handle the case where both username and password are incorrect
            $errors["login_incorrect"] = "Account doesn't exist!";
        }

        if ($errors) {
            $_SESSION["errors_login"] = $errors;
            $signupData = [
                "username" => $username,
                "email" => $email
             ];
             $_SESSION["signup_data"] = $signupData;
 
            header("Location: ../index.php");
            die();
        }

        // If everything is correct, set up session and redirect
        $newSessionId = session_create_id();
        $SessionId = $newSessionId . "_" . $result["id"];
        session_id($SessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);

        $_SESSION["last_regeneration"] = time();

        if ($_SESSION["user-role"] !== "Admin") {
            header("Location: ../RegularPage/index.php?login=success");
        } else {
            header("Location: ../AdminPage/index.php?login=success");
        }

        $pdo = null;
        $statement = null;
        die();

    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}

