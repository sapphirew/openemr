<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "openemr";
if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT pid FROM patient_data WHERE status=''";
$result = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($result);
echo $rows;