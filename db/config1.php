<?php
$host = "localhost";
$db_name = "webtech_fall2024_reindorf_narh";
$username = "reindorf.narh";
$password = "(Qw123ty_)";

$conn = mysqli_connect($host, $username, $password, $db_name);

if(!$conn){
    die("Connection failed: ". mysqli_connect_error());
}
?>