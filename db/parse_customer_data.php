<?php
              //include 'connect_db.php';
              include($_SERVER['DOCUMENT_ROOT'].'/Restwert/db/connect_db.php');
              function ParseToDatabase($data)
                {
                    
                    

                    $connection = Connect();

                    // Check the connection
                    if (!$connection) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $values = "";

                    foreach ($data as $value) 
                    {
                        $values .= "'" . $value . "', ";
                        next($data);
                    }

                    $values = substr_replace($values, '', -2);

                    $sql = "INSERT INTO customers VALUES ($values)";


                    if (mysqli_query($connection, $sql))
                    {
                        echo "New record created successfully";
                    } 
                    else 
                    {
                        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
                    }

                    header("Location:redirect_customer.php");
                    mysqli_close($connection);
                }
?>