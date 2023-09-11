<?php

/* Database credentials. Assuming you are running MySQL 
  server with default setting (user 'root' with no password) */
$config = parse_ini_file('../private/db-config.ini');
//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); 

$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
//echo $config['servername'];
//echo $config['dbname'];

/* Attempt to connect to MySQL database */
// Check connection 
//echo $conn->connect_errno;
