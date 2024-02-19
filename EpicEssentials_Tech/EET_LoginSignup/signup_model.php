<?php

declare(strict_types=1);

function get_username(object $pdo, string $username){
    $query = "SELECT username FROM user_signup WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_email(object $pdo, string $email){
    $query = "SELECT email FROM user_signup WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function set_user(object $pdo, string $username, string $userpassword, string $email){
    $query = "INSERT INTO user_signup (username, userpassword, email, user_role) VALUE (:username, :userpassword, :email, 'Regular');";
    $stmt = $pdo->prepare($query);
    $options = [
        'cost' => 12
    ];
    $hasedPassword = password_hash($userpassword, PASSWORD_BCRYPT, $options);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":userpassword", $hasedPassword);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
}