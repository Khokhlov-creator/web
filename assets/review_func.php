<?php
function reviewDisplay($id_review): void
{
    $review = mysqli_fetch_array(getReviewInfo($id_review));
    $review_name = $review["review_name"];
    $review_text = $review["review_text"];
    $id_user = $review["id_user"];
    $id_book = $review["id_book"];

    $user = mysqli_fetch_array(getUserInfo($id_user));
    $user_img = $user["image"];
    $username = $user["username"];

    $book = mysqli_fetch_array(getBookInfo($id_book));
    $book_name = $book["book_name"];

    echo "
        <div class='review'>
        <img src='../user_images/$user_img' alt = 'user pic'>
            <div class='review_details'>
              <div class='review_links'>
                  <a class='review_label' href='profile.php?id_user=$id_user'>$username</a>
                  <div class='links'>
                       
                      <a href='review.php?id_review=$id_review'>Go to review $review_name</a>
                      <a href='book.php?id_book=$id_book'>Go to book $book_name</a>
                      <span>
                      ";
    $date = date_create($review["review_date"]);
    echo date_format($date, "d.m.Y");
    echo "
                    </span>
                </div>
            </div>
              <pre>
$review_text
              </pre>
           </div>
        </div>";
}

function getReviewInfo($id_review): mysqli_result
{
    global $conn;
    return $conn->query("SELECT * FROM review WHERE id_review = '$id_review'");
}

function getAllReviews($id_book): void
{

    global $conn;
    $result = $conn->query("SELECT id_review FROM review WHERE id_book = '$id_book' ORDER BY review_date DESC");

    while ($review = mysqli_fetch_assoc($result)) {
        reviewDisplay($review["id_review"]);
    }
}

function addReview($id_book): void
{
    global $conn;
    $review_name = mysqli_real_escape_string($conn, $_POST['review_name']);
    $review_text = mysqli_real_escape_string($conn, $_POST['review_text']);
    $id_user = $_SESSION["id_user"];
    $review_date = date("Y-m-d");
    $conn->query("INSERT INTO review (review_name, review_date, review_text, id_user, id_book) VALUES ('$review_name', '$review_date', '$review_text', '$id_user', '$id_book')");
}

function getReviewsByUser($id_user, $page): void
{
    global $conn;
    $max_reviews = 4;
    $result = $conn->query("SELECT id_review FROM review WHERE id_user = '$id_user' ORDER BY review_date DESC LIMIT $max_reviews OFFSET $page");

    if (mysqli_num_rows($result) == 0) {
        echo "Here is empty :(";
    }

    while ($review = mysqli_fetch_assoc($result)) {
        reviewDisplay($review["id_review"]);
    }
}

function getAmountOfAllUserReviews($id_user): int
{
    global $conn;
    $result = $conn->query("SELECT id_review FROM review WHERE id_user = '$id_user'");
    return mysqli_num_rows($result);
}

function editReview($id_review): void
{
    global $conn;
    $review_name = mysqli_real_escape_string($conn, $_POST["review_name"]);
    $review_text = mysqli_real_escape_string($conn, $_POST["review_text"]);

    setReviewName($review_name, $id_review);
    setReviewText($review_text, $id_review);
}

function setReviewName(string $newName, $id_review): void
{
    global $conn;
    $conn->query("UPDATE review SET review_name = '$newName' WHERE id_review = '$id_review'");
}

function setReviewText(string $newText, $id_review): void
{
    global $conn;
    $conn->query("UPDATE review SET review_text = '$newText' WHERE id_review = '$id_review'");
}

function validateReview(): array
{
    global $conn;
    $review_name = mysqli_real_escape_string($conn, $_POST["review_name"]);
    $review_text = mysqli_real_escape_string($conn, $_POST["review_text"]);

    $errors[0] = isReviewNameValid($review_name);
    $errors[1] = isReviewTextValid($review_text);

    for ($i = 0; $i < 2; $i++) {
        if ($errors[$i] != "") {
            return $errors;
        }
    }

    return [];
}

function validateGET($param): int
{
    if (($param == "") || !ctype_digit($param)) {
        return 0;
    }
    return $param;
}

function deleteReview($id_review): void
{
    global $conn;
    $conn->query("DELETE FROM review WHERE id_review = '$id_review'");
}
