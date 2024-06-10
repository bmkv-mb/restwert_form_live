<?php

function Connect()
{
    $servername = "localhost";
    $database = "form_db";
    $username = "root";
    $password = "";

    # Use this if app is built into docker #

    // $connection = new mysqli(
    //     'db' , 
    //     'php_docker',
    //     'password',
    //     'php_docker'
    // );

    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }else{
        return $connection;
    }
}
