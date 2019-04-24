<?php

    $dbHostName = "107.180.50.167";
    $dbUsername = "admin_remote";
    $dbPassword = "Admin@123";
    $dbName = "admin_remote";

// Create Database Connection

    try{
        $db_con = new PDO("mysql:host={$dbHostName};dbname={$dbName}",$dbUsername,$dbPassword);
        $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected Successfully!";
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }

?>
