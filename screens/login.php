<?php
include_once "../assets/connection.php";
include_once "../assets/user_func.php";

connect();
session_start();

$username_response = "";
$password_response = "";

if (isset($_POST["submit"])) {
    $errors = login();

    if (empty($errors)) {
        header("location: profile.php?id_user=$_SESSION[id_user]");
    } else {
        $username_response = $errors[0];
        $password_response = $errors[1];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/styles_main_page.css">
    <title>Log in</title>
</head>

<body>
<?php include "header.php" ?>

<div class="container">
    <form action="login.php" method="post">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username...">
        <span><?php echo $username_response?></span>

        <label for="psswd">Password</label>
        <input type="password" id="psswd" name="psswd" placeholder="Enter your password...">
        <span><?php echo $password_response?></span>

        <input type="submit" name="submit" value="Submit">
    </form>
</div>
<?php include "footer.html" ?>

</body>
</html>

