<?php

// Database connection parameters
$host = "localhost";
$username = "root";
$password = "Suela2003!";
$database = "edoc";

// Create a connection
$databaseConnection = new mysqli($host, $username, $password, $database);

// Check the connection
if ($databaseConnection->connect_error) {
    die("Connection failed: " . $databaseConnection->connect_error);
}

// Your code goes here

// Close the connection when done
$databaseConnection->close();

?>
