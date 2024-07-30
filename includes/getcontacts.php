<?php
// import the database connection 
require_once 'dbh.inc.php';

try {
    // get all contacts
    $sql = "SELECT * FROM contacts";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $contacts = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
