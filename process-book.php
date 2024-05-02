<?php

# Connects to the database

$mysqli = require __DIR__ ."/database.php";

# Inserts data into the database

$sql = "INSERT INTO books (title, isbn, publication_year, genre_id, author_id, publisher_id)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $mysqli->stmt_init();
$stmt->prepare($sql);

# SQL Error Prints

if (! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

# Binds the string parameter to the SQL query
# https://www.w3schools.com/php/php_mysql_prepared_statements.asp
$stmt->bind_param("sssiii", $_POST["title"],$_POST["isbn"], $_POST["publication_year"], $_POST["genre_id"], $_POST["author_id"], $_POST["publisher_id"]);

# Takes user to signup-success page

if ($stmt->execute()) {
    header("Location: admin.php");
    exit;
} else {
    die($mysqli->error  . " " . $mysqli->errorno);
}