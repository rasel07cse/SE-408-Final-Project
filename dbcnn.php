<?php 

$server = "localhost";
$user = "root";
$pass = "";
$database = "registration";

$con = mysqli_connect($server, $user, $pass, $database);
// mysqli_connect(SERVER_ADDR, USER_NAME, PASSWORD,  DATABASE_NAME);

if (!$con) {
    die("<script>alert('Connection Failed.')</script>");
}

?>