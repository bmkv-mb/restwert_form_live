<?php

function Connect()
                {
                    $servername = "localhost";
                    $database = "form_db";
                    $username = "root";
                    $password = "";


                    // use this if app is built into docker
                    // $connection = mysqli_connect(
                    //     'db' , 
                    //     'php_docker',
                    //     'password',
                    //     'php_docker'
                    // );
                    

                    // Create a connection
                    $connection = mysqli_connect($servername, $username, $password, $database);

                    return $connection;
                }