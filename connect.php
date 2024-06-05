<?php
$servername = "localhost";
$username = "userdb";
$password = "databaza";
$dbname = "northwindmysql"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>