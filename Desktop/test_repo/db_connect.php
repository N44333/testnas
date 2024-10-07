<?php
$host = "localhost";
$username = "root";
$password = ""; // Change from " " to ""
$database = "project_ideas_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8mb4
$conn->set_charset("utf8mb4");

echo getcwd(); // Print the current working directory
echo file_exists('includes/db_connect.php') ? 'File exists' : 'File does not exist';
?>