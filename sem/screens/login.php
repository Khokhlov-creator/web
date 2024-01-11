<?php
include_once "../assets/connection.php";
include_once "../assets/user_func.php";

connect();
session_start();

if (isset($_POST["submit"])) {
    login();
    header("location: profile.php?id_user=$_SESSION[id_user]");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/styles.css">
    <title>Log in</title>
</head>

<body>
<?php include "header.php" ?>

<div class="container">
    <form action="login.php" method="post">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username...">

        <label for="psswd">Password</label>
        <input type="password" id="psswd" name="psswd" placeholder="Enter your password...">

        <input type="submit" name="submit" value="Submit">
    </form>
</div>
<?php include "footer.html" ?>

</body>
</html>

