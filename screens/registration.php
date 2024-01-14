<?php
include_once "../assets/connection.php";
include_once "../assets/user_func.php";
include_once "../assets/validation.php";

connect();
session_start();

$name_response = "";
$psswd_response = "";
$username_response = "";
$conf_psswd_response = "";
$image_response = "";

$name = "";
$username = "";

if (isset($_POST["submit"])) {
    $errors = validateUser();

    if (empty($errors)) {
        addUser();
        header("location: login.php");
    } else {
        $name_response = $errors[0];
        $psswd_response = $errors[1];
        $username_response = $errors[2];
        $conf_psswd_response = $errors[3];
        $image_response = $errors[4];

        $name = htmlspecialchars($_POST["name"]);
        $username = htmlspecialchars($_POST["username"]);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/styles_main_page.css">
    <title>Title</title>
</head>

<body>
<?php include "header.php" ?>

<div class="container">
    <form action="registration.php" method="post" enctype="multipart/form-data">
        <label for="name">Your name</label>
        <input type="text" id="name" name="name" placeholder="Enter your name..." value="<?php echo $name?>"  minlength="4" maxlength="32" required>
        <span><?php echo $name_response?></span>

        <label for="image">Your image</label>
        <input type="file" accept="image/*" id="image" name="image">
        <span><?php echo $image_response?></span>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username..." value="<?php echo $username?>"  minlength="4" maxlength="32" required>
        <span id="username_response"><?php echo $username_response?></span>

        <label for="psswd">Password</label>
        <input type="password" id="psswd" name="psswd" placeholder="Enter your password..." minlength="8" maxlength="32" required>
        <span id="password_response"><?php echo $psswd_response?></span>

        <label for="psswd_conf">Confirm password</label>
        <input type="password" id="psswd_conf" name="psswd_conf" placeholder="Confirm your password..." minlength="8" maxlength="32" required>
        <span id="conf_password_response"><?php echo $conf_psswd_response?></span>

        <input type="submit" id="submit" name="submit" value="Submit">
    </form>

    <script src="../js/validate_passwords.js"></script>
    <script src="../js/username_ajax.js"></script>
</div>
<?php include "footer.html" ?>

</body>
</html>

