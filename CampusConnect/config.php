<?php
// Connect to database
ini_set('display_errors', 'On');


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CampusConnect";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
