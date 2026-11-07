<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

$conn = new mysqli("localhost", "root", "", "complaint_portal");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>