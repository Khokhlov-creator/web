<?php
include_once "../assets/connection.php";
include_once "../assets/review_func.php";

connect();
session_start();

if (!isset($_GET["id_review"]) || empty($_GET["id_review"])) {
    header("location: index.php");
}

$id_review = validateGET($_GET["id_review"]);

$review = mysqli_fetch_array(getReviewInfo($id_review));
$id_user = $review["id_user"];

if ($review && !empty($_SESSION["id_user"]) && (($id_user == $_SESSION["id_user"]) || !empty($_SESSION["admin"]))) {
    deleteReview($id_review);
}

header("location: profile.php?id_user=$id_user");