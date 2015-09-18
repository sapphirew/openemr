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
$sql = "SELECT MAX(pid) AS maxpid FROM patient_data";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$maxpid = htmlentities($row['maxpid']);
$newi = 1;
$countUpdate = 0;
while ($newi <= $maxpid) {
    $sql = "SELECT date FROM (SELECT id, date FROM form_encounter WHERE pid = ".$newi." ORDER BY id DESC LIMIT 1) sub";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($result)){
        $laspidtdate = htmlentities($row['date']);
    }
    $today=date('Y-m-d H:i:s');
    $dayDiff = strtotime($today) - strtotime($laspidtdate);
    $dayDifference = floor($dayDiff / 86400);
    if($dayDifference > 1095){
    $sql = "UPDATE patient_data SET PatiCat = 'New Patient' WHERE id = " . $newi;
    mysqli_query($conn, $sql);
    $countUpdate++;
    }
    $newi++;
}
echo $dayDifference;

