<?php
include_once "../assets/connection.php";
include_once "../assets/user_func.php";

connect();
session_start();

if (isset($_POST["submit"])) {
    addUser();
    header("location: login.php");
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
    <form action="registration.php" method="post" enctype="multipart/form-data">
        <label for="name">Your name</label>
        <input type="text" id="name" name="name" placeholder="Enter your name...">

        <label for="image">Your image</label>
        <input type="file" accept="image/*" id="image" name="image">

        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username...">

        <label for="psswd">Password</label>
        <input type="password" id="psswd" name="psswd" placeholder="Enter your password...">

        <label for="psswd_conf">Confirm password</label>
        <input type="password" id="psswd_conf" name="psswd_conf" placeholder="Confirm your password...">

        <input type="submit" name="submit" value="Submit">
    </form>
</div>
<?php include "footer.html" ?>

</body>
</html>

