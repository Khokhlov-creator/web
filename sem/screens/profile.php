<?php
include_once "../assets/connection.php";
include_once "../assets/user_func.php";
include_once "../assets/review_func.php";
include_once "../assets/book_func.php";

connect();
session_start();

$id_user = $_GET["id_user"];
$user = mysqli_fetch_array(getUserInfo($id_user));
$name = $user["name"];
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
    <div class="user_info">
        <p>Your name: <?php echo $name?></p>
        <?php
        if ($id_user == $_SESSION["id_user"]){
            echo "<a href='edit_profile.php'>Edit profile</a>";
        }
        ?>
    </div>

    <?php getReviewsByUser($id_user);?>
</div>

<?php include "footer.html" ?>

</body>
</html>

