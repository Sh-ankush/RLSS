<?php
require_once('config.php');

global $DB_HOST ;
global $DB_NAME ;
global $DB_USER ;
global $DB_PASS ;

// Create connection
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>