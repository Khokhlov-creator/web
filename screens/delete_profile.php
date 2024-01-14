<?php
include_once "../assets/connection.php";
include_once "../assets/user_func.php";
include_once "../assets/review_func.php";

connect();
session_start();

if (!isset($_GET["id_user"]) || empty($_GET["id_user"])) {
    header("location: logout.php");
}

$id_user = validateGET($_GET["id_user"]);

$user = mysqli_fetch_array(getUserInfo($id_user));

if ($user && !empty($_SESSION["id_user"]) && (($id_user == $_SESSION["id_user"]) || !empty($_SESSION["admin"]))) {
    deleteUser($id_user, $user["book_img"]);

    if (empty($_SESSION["admin"])) {
        session_unset();
        session_destroy();
    }
}

header("location: index.php");