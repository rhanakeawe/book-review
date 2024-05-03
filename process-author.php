<?php

# Connects to the database

$mysqli = require __DIR__ ."/database.php";

# Inserts data into the database

$sql = "INSERT INTO `authors` (author_name, gender, birth_year)
        VALUES (?,?,?)";
$stmt = $mysqli->stmt_init();
$stmt->prepare($sql);

# SQL Error Prints

if (! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

# Binds the string parameter to the SQL query
# https://www.w3schools.com/php/php_mysql_prepared_statements.asp
$stmt->bind_param("ssi", $_POST["author_name"], $_POST["gender"], $_POST["birth_year"]);

# Takes user to signup-success page

if ($stmt->execute()) {
    header("Location: admin.php");
    exit;
} else {
    die($mysqli->error  . " " . $mysqli->errorno);
}