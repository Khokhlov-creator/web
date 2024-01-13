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
    <link rel="stylesheet" href="../styles/styles.css">
    <title>Title</title>
</head>

<body>
<?php include "header.php" ?>

<div class="container">

    <div class="coll">
        <?php getAllBooks();?>
    </div>

    <?php
    if (!empty($_SESSION["admin"])) {
        echo "<a href='add_book.php'>Add book</a>";
    }
    ?>

</div>
<?php include "footer.html" ?>

</body>
</html>

//Во все формы кроме логина дописать min max required(если надо), кроме логинаб кроме логина.
