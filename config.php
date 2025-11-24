<?php 

//declaring variables
$host = "localhost"; //database server address
$user = "root"; //username with access to mysql, typically root by default
$password = ""; //local setup so no password
$database = "users_db"; //name of the database

//creating connection
$conn = new mysqli($host, $user, $password, $database); //creates conn object

if ($conn->connect_error) { //error message
    die("connection failed: ". $conn->connect_error); //die means stop the script
}
?>