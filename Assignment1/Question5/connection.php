<?php

$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "myDB";


  $conn = new mysqli($servername, $username, $password,);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  //creating database if exist
  $createdb = "CREATE DATABASE IF NOT EXISTS $dbname";

  if ($conn->query($createdb) === TRUE) {
  
  } else {
    echo "Error creating database: " . $conn->error;
  }
  $conn->select_db($dbname);
//creating a table Movies
$createtb = "CREATE TABLE IF NOT EXISTS Movies ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,`title` VARCHAR(70) NOT NULL , `rating` INT(6) NOT NULL )";

if ($conn->query($createtb) === TRUE) {
} else {
  echo "Error creating table: " . $conn->error;
}
// $conn->close();
// ?>


  