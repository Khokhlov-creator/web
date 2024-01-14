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


function login(): array
{
    global $conn;

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $psswd = mysqli_real_escape_string($conn, $_POST['psswd']);

    $user = $conn->query("SELECT id_user, psswd, isAdmin FROM user WHERE username = '$username'");
    $data = mysqli_fetch_array($user);

    $errors[0] = "";
    $errors[1] = "";

    if (mysqli_num_rows($user) != 0) {
        if (password_verify($psswd, $data["psswd"])) {
            $_SESSION["id_user"] = $data["id_user"];

            if ($data["isAdmin"] == 1) {
                $_SESSION["admin"] = true;
            }
        } else {
            $errors[1] = "Wrong password!";
        }
    } else {
        $errors[0] = "Wrong username!";
    }

    for ($i = 0; $i < 2; $i++) {
        if ($errors[$i] != "") {
            return $errors;
        }
    }

    return [];
}

function editUser($id_user): void
{
    global $conn;
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);

    setName($name, $id_user);
    setUsername($username, $id_user);
}

function editPassword($id_user): void
{
    global $conn;
    $password = password_hash(mysqli_real_escape_string($conn, $_POST["name"]), PASSWORD_DEFAULT);
    setPassword($password, $id_user);
}

function setPassword(string $newPassword, $id_user): void
{
    global $conn;
    $conn->query("UPDATE user SET psswd = '$newPassword' WHERE id_user = '$id_user'");
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

function validateUser(): array
{
    global $conn;
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $psswd = mysqli_real_escape_string($conn, $_POST["psswd"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $conf_psswd = mysqli_real_escape_string($conn, $_POST["psswd_conf"]);

    $errors[0] = isNameValid($name);
    $errors[1] = isPasswordValid($psswd);
    $errors[2] = isUsernameValid($username);
    $errors[3] = arePasswordsSame($psswd, $conf_psswd);
    $errors[4] = "";

    if (!empty($_FILES["image"]["type"])) {
        $image_type = $_FILES["image"]["type"];
        if (!str_starts_with($image_type, "image")) {
            $errors[4] = "File is not an image!";
        }
    }

    for ($i = 0; $i < 5; $i++) {
        if ($errors[$i] != "") {
            return $errors;
        }
    }

    return [];
}

function validateUserEdit(): array
{
    global $conn;
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);

    $errors[0] = isNameValid($name);
    $errors[1] = isUsernameValid($username);

    for ($i = 0; $i < 2; $i++) {
        if ($errors[$i] != "") {
            return $errors;
        }
    }
    return [];
}

function usernameExists(string $username): bool
{
    global $conn;
    $result = $conn->query("SELECT * FROM user WHERE username = '$username'");

    if (mysqli_num_rows($result) == 0){
        return false;
    }
    return true;
}

function deleteUser($id_user, $image): void
{
    global $conn;
    if ($image != "blankUser.jpg") { //перепиши нахуй
        unlink("../user_images/$image");
    }

    $conn->query("DELETE FROM review WHERE id_user = '$id_user'");
    $conn->query("DELETE FROM user WHERE id_user = '$id_user'");
}

function validatePasswordEdit(): array
{
    global $conn;
    $password = mysqli_real_escape_string($conn, $_POST["psswd"]);
    $conf_password = mysqli_real_escape_string($conn, $_POST["psswd_conf"]);

    $errors[0] = isPasswordValid($password);
    $errors[1] = "";

    if ($errors[0] == "") {
        if ($password != $conf_password) {
            $errors[1] = "Passwords must be equal!";
        }
    }

    for ($i = 0; $i < 2; $i++) {
        if ($errors[$i] != "") {
            return $errors;
        }
    }

    return [];
}


