<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "valdevieso_ratunil_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn -> connect_error){
    die("Connection Error". $conn->connect_error);
}
echo"Connected Successfully";
?>