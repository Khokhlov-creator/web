<?php
include_once "../assets/connection.php";
include_once "../assets/book_func.php";
include_once "../assets/validation.php";

connect();
session_start();

if (empty($_SESSION["id_user"])) {
    header("location: index.php");
}

$book_name_response = "";
$author_response = "";
$image_response = "";

$book_name = "";
$author = "";

if (isset($_POST["submit"])) {
    $errors = validateBook();

    if (empty($errors)) {
        addBook();
        header("location: index.php");
    } else {
        $book_name_response = $errors[0];
        $author_response = $errors[1];
        $image_response = $errors[2];

        $book_name = htmlspecialchars($_POST["book_name"]);
        $author = htmlspecialchars($_POST["author"]);
    }
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
        <input type="text" id="book_name" name="book_name" placeholder="Enter book name..." value="<?php echo $book_name?>" minlength="" maxlength="" required>
        <span><?php echo $book_name_response?></span>

        <label for="image">Book image</label>
        <input type="file" accept="image/*" id="image" name="image">
        <span><?php echo $image_response?></span>

        <label for="author">Author's name</label>
        <input type="text" id="author" name="author" placeholder="Enter author's name..." value="<?php echo $author?>"  minlength="" maxlength="" required>
        <span><?php echo $author_response?></span>

        <input type="submit" name="submit" value="Submit">
    </form>
</div>
<?php include "footer.html" ?>

</body>
</html>
