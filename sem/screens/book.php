<?php
include_once "../assets/connection.php";
include_once "../assets/book_func.php";
include_once "../assets/review_func.php";
include_once "../assets/user_func.php";
include_once "../assets/validation.php";

connect();
session_start();

$id_book = $_GET["id_book"];

$book = mysqli_fetch_array(getBookInfo($id_book));

$book_name = $book["book_name"];
$author = $book["author"];
$book_image = $book["book_img"];

$book_name_response = "";
$author_response = "";
$review_name_response = "";
$review_text_response = "";

if (isset($_POST["submit"])) {
    $errors = validateReview();

    if (empty($errors)) {
        addReview($id_book);
        header("location: book.php?id_book=$id_book");
    } else {
        $review_name_response = $errors[0];
        $review_text_response = $errors[1];
    }
}

if (isset($_GET["edit"])) {
    editBook($id_book);
    header("location: book.php?id_book=$id_book");
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
    <form action="book.php?id_book=<?php echo $id_book?>" method="post">
        <label>
            <input id="book_name" name="book_name" value="<?php echo $book_name?>" readonly>
        </label>
        <span><?php echo $book_name_response?></span>

        <label>
            <input id="author" name="author" value="<?php echo $author?>" readonly>
        </label>
        <span><?php echo $author_response?></span>

        <label id="book_edit_submit"></label>
    </form>
    <?php
    if (isset($_SESSION["admin"])) {
        echo "<button id='edit_book'>Edit book data</button>
              <script src='../js/edit_book.js'></script>";
    }
    ?>

    <img src="../book_images/<?php echo $book_image?>" alt="image">
</div>

<form action="book.php?id_book=<?php echo $id_book?>" method = "post">

    <label for="review_name">Title of review</label>
    <input type="text" id="review_name" name="review_name" placeholder="Title...">
    <span><?php echo $review_name_response?></span>

    <label for="review_text">Review</label>
    <input type="text" id="review_text" name="review_text" placeholder="Review...">
    <span><?php echo $review_text_response?></span>

    <input type="submit" name="submit" value="Submit">

</form>

<?php getAllReviews($id_book);?>


<?php include "footer.html" ?>

</body>
</html>
