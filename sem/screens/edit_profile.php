<?php
include_once "../assets/connection.php";
include_once "../assets/user_func.php";

connect();
session_start();

if (isset($_POST["submit"])) {
    editUser($_SESSION["id_user"]);
    header("location: profile.php?id_user=$_SESSION[id_user]");
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
    <form action="login.php" method="post">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Edit your name...">

        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Edit your username...">

        <input type="submit" name="submit" value="Submit">
    </form>
</div>
<?php include "footer.html" ?>

</body>
</html>

