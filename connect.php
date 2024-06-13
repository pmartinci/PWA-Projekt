<?php

    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "vijesti";

    $dbc = mysqli_connect($servername, $username, $password, $dbname) or
        die("Error connecting to the database.");

    /*
    if($dbc) {
        echo "Connected successfully.";
    } 
    */
?>