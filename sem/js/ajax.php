<?php
include_once "../assets/user_func.php";
include_once "../assets/connection.php";

connect();

$username = $_GET["username"];

if (usernameExists($username)) {
    echo "Username is already exist!";
} else {
    echo "";
}