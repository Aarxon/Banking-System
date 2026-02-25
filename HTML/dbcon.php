<?php
// Database connection settings
$hostname = "localhost";
$username = "RealBank"; 
$password = "FakeBank123"; 
$dbname = "BankDB"; 

// Connect to database
$con = mysqli_connect($hostname, $username, $password, $dbname);

// Check connection
if (!$con) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
?>
