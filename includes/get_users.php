<?php
require_once 'dbh.inc.php';

function get_users(): array {
    global $pdo;
    
    try {
        // get all users
        $sql = "SELECT * FROM users";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
    
    return $users;
}

