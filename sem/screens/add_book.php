<?php
include_once "../assets/connection.php";
include_once "../assets/book_func.php";

connect();

if (isset($_POST["submit"])) {
    addBook();
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/styles.css">
    <title>Title</title>
</head>

<body>
<?php include "header.php" ?>

<div class="container">
    <form action="add_book.php" method="post" enctype="multipart/form-data">
        <label for="book_name">Book name</label>
        <input type="text" id="book_name" name="book_name" placeholder="Enter book name...">

        <label for="image">Book image</label>
        <input type="file" accept="image/*" id="image" name="image">

        <label for="author_name">Author's name</label>
        <input type="text" id="author_name" name="author_name" placeholder="Enter author's name...">

        <input type="submit" name="submit" value="Submit">
    </form>
</div>
<?php include "footer.html" ?>

</body>
</html>
