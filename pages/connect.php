<?php
    $servername = "localhost:3333";
    $username = "root";
    $password = "12345678";
    $db = "eif";

    // Create connection
    $conn = new mysqli($servername, $username, $password,$db);
    $conn->set_charset("utf8");
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
?>