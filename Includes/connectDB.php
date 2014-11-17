<?php
    require_once ("/Includes/simplecms-config.php"); //include names for database connectivity
    require_once ("/Functions/database.php"); //include the ability to call functions from database.php file

    // Create database connection
    $databaseConnection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); //create connection to database
    if ($databaseConnection->connect_error)
    {
        die("Database selection failed: " . $databaseConnection->connect_error);
    }

    // Create tables if needed.
    prep_DB_content(); //call functions from database.php file
?>