<?php
function connect(): void
{
    $db_host = 'localhost';
    $db_user = 'khokhdmi';
    $db_password = 'webove aplikace';
    $db_name = 'khokhdmi';

    global $conn;
    try {
        $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);
        if (!$conn){
           throw new Exception(mysqli_connect_error());
        }
    } catch (Exception $e) {
        die('Database is not connected: ');
    }
}