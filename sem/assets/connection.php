<?php
function connect(): void
{
    $db_host = '127.0.0.1';
    $db_user = 'root';
    $db_password = '';
    $db_name = 'khokhdmi';

    global $conn;
    try {
        $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);
    } catch (mysqli_sql_exception) {
        die('Database is not connected: ');
    }
}