<?php
include_once "../assets/connection.php";
include_once "../assets/book_func.php";
include_once "../assets/review_func.php";

connect();
session_start();

if (!isset($_GET["id_book"]) || empty($_GET["id_book"])) {
    header("location: index.php");
}

$id_book = validateGET($_GET["id_book"]);

$book = mysqli_fetch_array(getBookInfo($id_book));

if ($book && !empty($_SESSION["admin"])) {
    deleteBook($id_book, $book["book_img"]);
}

header("location: index.php");
