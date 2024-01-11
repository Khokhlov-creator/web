<?php
include_once "../assets/connection.php";
include_once "../assets/book_func.php";
include_once "../assets/review_func.php";
include_once "../assets/user_func.php";

connect();
session_start();

$id_review = $_GET["id_review"];

$review = mysqli_fetch_array(getReviewInfo($id_review));

$review_name = $review["review_name"];
$review_text = $review["review_text"];
$id_book = $review["id_book"];
$id_user = $review["id_user"];

$book = mysqli_fetch_array(getBookInfo($id_book));
$user = mysqli_fetch_array(getUserInfo($id_user));

if (isset($_POST["submit"])) {
    editReview($id_review);
    header("location: review.php?id_review=$id_review");
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
    <a href="book.php?id_book=<?php echo $id_book ?>"><?php echo $book["book_name"] ?></a>
    <a href="profile.php?id_user=<?php echo $id_user ?>"><?php echo $user["name"] ?></a>
    <?php
    $date = date_create($review["review_date"]);
    echo date_format($date, "d.m.Y");
    ?>

    <form action="review.php?id_review=<?php echo $id_review ?>" method="post">
        <label>
            <input name='review_name' id="review_name" value='<?php echo $review_name ?>' readonly>
        </label>
        <label>
            <input name='review_text' id="review_text" value='<?php echo $review_text ?>' readonly>
        </label>

        <label id="review_edit_submit"></label>
    </form>

    <?php
    if (isset($_SESSION["id_user"]) && (($id_user == $_SESSION["id_user"]) || isset($_SESSION["admin"]))){
        echo "<button id='edit_review'>Edit review</button>
              <script src='../js/edit_review.js'></script>";
    }
    ?>
</div>

<?php include "footer.html" ?>

</body>
</html>
