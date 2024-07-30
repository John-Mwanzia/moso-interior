<?php

declare(strict_types=1);


require_once "../vendor/autoload.php";
// require_once 'HTTP/Request2.php';
// require __DIR__ . "../vendor/autoload.php";


function get_username(object $pdo, string $username): bool
{
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        return true;
    } else {
        return false;
    }
}

function get_email(object $pdo, string $email): bool
{
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        return true;
    } else {
        return false;
    }
}

function create_user(object $pdo, string $username, string $email, string $password): void
{
    $options = [
        'cost' => 12,
    ];
    $password_hash = password_hash($password, PASSWORD_BCRYPT, $options);
    $query = "INSERT INTO users (username, email, password_hash) VALUES (:username, :email, :password_hash)";
    $stmt = $pdo->prepare($query);
    $user =  $stmt->execute([
        'username' => $username,
        'email' => $email,
        'password_hash' => $password_hash,
    ]);

if($user){
    SESSION_START();
    $SESSION["signup-success"] = "You are now logged in";
}
else{
    $SESSION["signup-error"] = "An error occurred. Please try again";
}
}
