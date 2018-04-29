<?php

function getDatabaseHandle() {
    $servername = 'localhost';
    $username = 'root';
    $password = 'Pullareddy@123';
    $database = 'crypto';
    $conn = mysqli_connect($servername, $username, $password, $database);
    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
    return $conn;
    }

function getQueryResult($db, $query){
    $result = mysqli_query($db, $query);
    return $result;
}

function dbClose($conn){
  mysqli_close($conn);
}
?>