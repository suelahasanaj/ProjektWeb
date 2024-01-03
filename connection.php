<?php

// Parametrat e lidhjes se databazes
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "doktorionline";

// Krijoj lidhjen
$database = new mysqli($db_host, $db_username, $db_password, $db_name);

// Kontrolloj lidhjen
if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);
}

?>
