<?php
include_once "../assets/connection.php";
include_once "../assets/user_func.php";
include_once "../assets/review_func.php";
include_once "../assets/book_func.php";

connect();
session_start();

if (!isset($_GET["page"]) || !isset($_GET["id_user"])) {
    $_GET["page"] = 0;
}

$id_user = validateGET($_GET["id_user"]);
$current_page = validateGET($_GET["page"]);

$user = mysqli_fetch_array(getUserInfo($id_user));

if (!$user) {
    header("location: index.php");
}

$name = $user["name"];

$page = 4 * $current_page;
if ($page == 0) {
    $_SESSION["amount_of_all_reviews"] = getAmountOfAllUserReviews($id_user);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/styles_profile.css">
    <title>Title</title>
</head>

<body>
<?php include "header.php" ?>

<div class="container">
    <div class="user_info">
        <?php
        if(!empty($_SESSION["id_user"]) && ($id_user != $_SESSION["id_user"])){
          echo "<p>Username: $name </p>";
        } else {
            echo "<p>Your name: $name </p>";
        }
        ?>
        <?php
        if (!empty($_SESSION["id_user"]) && ($id_user == $_SESSION["id_user"])) {
            echo "<a href='edit_profile.php' class='edit_profile'>Edit profile</a>";
            echo "<a href='edit_password.php' class='edit_password'>Edit password</a>";
        }
        if (!empty($_SESSION["id_user"]) && ($id_user == $_SESSION["id_user"]) || !empty($_SESSION["admin"])) {
            echo "<a href='delete_profile.php?id_user=$id_user' class='delete_profile'>Delete profile</a>";
        }
        ?>
    </div>

    <?php getReviewsByUser($id_user, $page); ?>

    <div class="pag">
        <?php
        if ($page != 0) {
            $page_to_pass = $current_page - 1;
            echo "<a href='profile.php?id_user=$id_user&page=$page_to_pass'>Previos</a>";
        }

        if ($page + 4 < $_SESSION["amount_of_all_reviews"]) {
            $page_to_pass = $current_page + 1;
            echo "<a href='profile.php?id_user=$id_user&page=$page_to_pass'>Next</a>";
        }
        ?>
    </div>
</div>

<?php include "footer.html" ?>

</body>
</html>

