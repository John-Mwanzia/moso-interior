<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    try {
        // import the database connection 
        require_once 'dbh.inc.php';
        // Prepare an insert statement
        $sql = "INSERT INTO contacts (first_name, last_name, email, message) VALUES (:first_name, :last_name, :email, :message)";
        $stmt = $pdo->prepare($sql);
        // Bind parameters to the prepared statement
        $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);
        // Execute the prepared statement
        $stmt->execute();
        // Redirect to the contact page
        header("Location: ../index.php?message=success");
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../");
    die();
}
