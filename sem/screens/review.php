<?php
include_once "../assets/connection.php";
include_once "../assets/book_func.php";
include_once "../assets/review_func.php";
include_once "../assets/user_func.php";
include_once "../assets/validation.php";

connect();
session_start();

$id_review = validateGET($_GET["id_review"]);

$review = mysqli_fetch_array(getReviewInfo($id_review));

if (!$review) {
    header("location: index.php");
}

$review_name = $review["review_name"];
$review_text = $review["review_text"];

$id_book = $review["id_book"];
$id_user = $review["id_user"];

$review_name_response = "";
$review_text_response = "";

$book = mysqli_fetch_array(getBookInfo($id_book));
$user = mysqli_fetch_array(getUserInfo($id_user));

if (isset($_POST["submit"])) {
    $errors = validateReview();

    if (empty($errors)) {
        editReview($id_review);
        header("location: review.php?id_review=$id_review");
    } else {
        $review_name_response = $errors[0];
        $review_text_response = $errors[1];

        $review_name = htmlspecialchars($_POST["review_name"]);
        $review_text = htmlspecialchars($_POST["review_text"]);

        echo "<script src='../js/edit_review_after_error.js' defer></script>";
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
        <span><?php echo $review_name_response?></span>
        <label>
            <input name='review_text' id="review_text" value='<?php echo $review_text ?>' readonly>
        </label>
        <span><?php echo $review_text_response?></span>

        <label id="review_edit_submit"></label>
    </form>

    <?php
    if (isset($_SESSION["id_user"]) && (($id_user == $_SESSION["id_user"]) || isset($_SESSION["admin"]))){
        echo "<button id='edit_review'>Edit review</button>
              <script src='../js/edit_review.js'></script>
              
              <a href='delete_review.php?id_review=$id_review&id_user=$id_user'>Delete review</a>";
    }
    ?>
</div>

<?php include "footer.html" ?>

</body>
</html>
