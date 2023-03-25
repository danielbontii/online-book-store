<?php

// Connect to the database and return the database object
function connect()
{
    // Set the hostname
    $hostname = 'localhost';

    // Set the database name
    $dbname = 'online_bookstore';

    // Set the username and password with permissions to the database
    $username = 'root';
    $password = '';

    // Create the DSN (data source name) by combining the database type, hostname and dbname
    $dsn = "mysql:host=$hostname;dbname=$dbname";

    try {
        return new PDO($dsn, $username, $password);
    } catch (Exception $e) {
        echo $e->getMessage();
    }

}
