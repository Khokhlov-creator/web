<header>
    <a href="index.php">BookRev</a>
    <nav>
        <ul>
            <li><a href="#contact">Contacts</a></li>
            <?php
            if(isset($_SESSION["id_user"])) {
                echo " <li><a href='profile.php?id_user=$_SESSION[id_user]'>My profile</a></li>
                       <li><a href='logout.php'>Log out</a></li>";
            } else {
                echo " <li><a href='registration.php'>Registration</a></li>
                       <li><a href='login.php'>Log in</a></li>";
            }
            ?>

        </ul>
    </nav>
</header>

