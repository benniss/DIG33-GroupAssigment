<?php
/* This file contains the connection information for accessing the MySQL database */

// Error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Settings required to access the database
$db_host = "localhost";
$db_user = "s3412678";
$db_password = "";
$db_name = "c9";


// This is the actual connection to MySQL
$connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

// Test for successful connection
if(mysqli_connect_errno()) {
  die("Database connection failed: " . mysqli_connect_error() ." (" . mysqli_connect_errno() . ")"
  );
}

?>