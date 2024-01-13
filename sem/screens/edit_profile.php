<?php
include_once "../assets/connection.php";
include_once "../assets/user_func.php";
include_once "../assets/validation.php";

connect();
session_start();

$user = mysqli_fetch_array(getUserInfo($_SESSION["id_user"]));

if (!$user) {
    header("location: index.php");
}

$name_response = "";
$username_response = "";

$name = $user["name"];
$username = $user["username"];

if (isset($_POST["submit"])) {
    $errors = validateUserEdit();

    if(empty($errors)){
        editUser($_SESSION["id_user"]);
        header("location: profile.php?id_user=$_SESSION[id_user]");
    } else {
        $name_response = $errors[0];
        $username_response = $errors[1];

        $name = htmlspecialchars($_POST["name"]);
        $username = htmlspecialchars($_POST["username"]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/styles.css">
    <title>Edit profile</title>
</head>

<body>
<?php include "header.php" ?>

<div class="container">
    <form action="edit_profile.php" method="post">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Edit your name..." value="<?php echo $name ?>">
        <span><?php echo $name_response ?></span>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Edit your username..." value="<?php echo $username ?>">
        <span><?php echo $name_response ?></span>

        <input type="submit" name="submit" value="Submit">
    </form>
</div>
<?php include "footer.html" ?>

</body>
</html>

