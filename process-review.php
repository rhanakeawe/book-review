<?php

# Connects to the database

session_start();

if (isset($_SESSION["user_id"])) {

    $mysqli = require __DIR__ ."/database.php";

    # Gets user from database
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}

$currentDateTime = new DateTime('now');
$currentDate = $currentDateTime->format('Y-m-d-h:i:s');

# Inserts data into the database

$sql = "INSERT INTO reviews (r_book_id, r_user_id, rating, review_text, created_at)
        VALUES (?, ?, ?, ?, ?)";
$stmt = $mysqli->stmt_init();
$stmt->prepare($sql);

# SQL Error Prints

if (! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

# Binds the string parameter to the SQL query
# https://www.w3schools.com/php/php_mysql_prepared_statements.asp
$stmt->bind_param("iiiss", $_POST["r_book_id"],$_SESSION["user_id"], $_POST["rating"], $_POST["review_text"], $currentDate);

# Takes user to signup-success page

if ($stmt->execute()) {
    header("Location: write.php");
    exit;
} else {
    die($mysqli->error  . " " . $mysqli->errorno);
}