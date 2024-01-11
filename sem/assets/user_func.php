<?php

function getUserInfo($id_user): mysqli_result
{
    global $conn;
    return $conn->query("SELECT * FROM user WHERE id_user = '$id_user'");
}

function addUser(): void
{
    global $conn;
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $psswd = password_hash(mysqli_real_escape_string($conn, $_POST['psswd']), PASSWORD_DEFAULT);
    $username = mysqli_real_escape_string($conn, $_POST['username']);

    $conn->query("INSERT INTO user (name, psswd, username, image, isAdmin) VALUES ('$name', '$psswd','$username', 'blankUser.jpg', 0)");

    $id_user = getLastAddedUser();
    setUserImage($id_user);
}

function setUserImage(int $id_user): bool
{
    global $conn;
    $image_name = mysqli_real_escape_string($conn, $_FILES["image"]["name"]);
    $image_type = $_FILES["image"]["type"];

    if (!str_starts_with($image_type, "image")) {
        return false;
    }

    $target_dir = "../user_images/";
    $user_image = $id_user . $image_name;
    $target_file = $target_dir . $user_image;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $conn->query("UPDATE user SET image = '$user_image' WHERE id_user = '$id_user'");
    return true;
}

function getLastAddedUser(): int
{
    global $conn;
    $result = $conn->query("SELECT MAX(id_user) AS id_user FROM user");
    return mysqli_fetch_array($result)["id_user"];
}


function login(): void
{
    global $conn;

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $psswd = mysqli_real_escape_string($conn, $_POST['psswd']);

    $user = $conn->query("SELECT id_user, psswd, isAdmin FROM user WHERE username = '$username'");
    $data = mysqli_fetch_array($user);

    if (mysqli_num_rows($user) != 0) {
        if (password_verify($psswd, $data["psswd"])) {
            $_SESSION["id_user"] = $data["id_user"];

            if ($data["isAdmin"] == 1) {
                $_SESSION["admin"] = true;
            }
        }
    }
}

function editUser($id_user): void
{
    global $conn;
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);

    setName($name, $id_user);
    setUsername($username, $id_user);
}

function setName(string $newName, $id_user): void
{
    global $conn;
    $conn->query("UPDATE user SET name = '$newName' WHERE id_user = '$id_user'");
}

function setUsername(string $newUsername, $id_user): void
{
    global $conn;
    $conn->query("UPDATE user SET username = '$newUsername' WHERE id_user = '$id_user'");
}