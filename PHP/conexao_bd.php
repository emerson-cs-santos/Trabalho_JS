<?php

// Open a Connection to MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trabalho_js";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
    echo 'errado';
	return;
} 

// SELECIONAR BANCO QUE VAMOS TRABALHAR
$query = 'use trabalho_js';
$result = $conn->query($query);

?>