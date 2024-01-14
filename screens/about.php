<?php
include_once "../assets/connection.php";
include_once "../assets/book_func.php";

connect();
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/styles_about.css">
    <title>Title</title>
</head>

<body>
<?php include "header.php" ?>

<div class="container">
    <div class="about">
        BookRev <br>
        is a specialized website dedicated to the art of literary exploration through insightful book reviews.
        Whether you're an avid reader searching for your next literary adventure or an author looking for constructive feedback,
        BookRev offers a curated collection of reviews that delve deep into the heart of each story.
    </div>
</div>
<?php include "footer.html" ?>

</body>
</html>