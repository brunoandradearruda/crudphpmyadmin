<?php

$DB_SERVER = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_NAME = "cadastro";
 

$link = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);


if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>