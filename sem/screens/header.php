<header>
    <a href="index.php">BookRev</a>
    <nav>
        <a href="about.php">About</a>
        <?php
        if (isset($_SESSION["id_user"])) {
            echo " <a href='profile.php?id_user=$_SESSION[id_user]'>My profile</a>
                       <a href='logout.php'>Log out</a>";
        } else {
            echo "<a href='registration.php'>Registration</a>
                       <a href='login.php'>Log in</a>";
        }
        ?>
    </nav>
</header>

