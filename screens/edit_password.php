<?php
include_once "../assets/connection.php";
include_once "../assets/user_func.php";
include_once "../assets/validation.php";

connect();
session_start();

if (empty($_SESSION["id_user"])) {
    header("location: index.php");
}

$password_response = "";
$conf_password_response = "";

if (isset($_POST["submit"])) {
    $errors = validatePasswordEdit();

    if(empty($errors)){
        editPassword($_SESSION["id_user"]);
        header("location: profile.php?id_user=$_SESSION[id_user]");
    } else {
        $password_response = $errors[0];
        $conf_password_response = $errors[1];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/styles_edit_password.css">
    <title>Edit profile</title>
</head>

<body>
<?php include "header.php" ?>

<div class="container">
    <form action="edit_password.php" method="post" class="edit_password">
        <label for="psswd">Password</label>
        <input type="password" id="psswd" name="psswd" placeholder="Enter your new password...">
        <span><?php echo $password_response ?></span>

        <label for="psswd_conf">Confirm password</label>
        <input type="password" id="psswd_conf" name="psswd_conf" placeholder="Confirm your new password...">
        <span><?php echo $conf_password_response ?></span>

        <input type="submit" name="submit" value="Submit">
    </form>

    <script src="../js/validate_passwords.js"></script>
</div>
<?php include "footer.html" ?>

</body>
</html>

