<?php

/**
 * <p></p>
 * @param int $id_book
 * @return void
 */
function bookDisplay(int $id_book): void
{
    $book_image = mysqli_fetch_array(getBookInfo($id_book))["book_img"];

    echo "<a href='book.php?id_book=$id_book'>
            <div class='card'>
                <img src='../book_images/$book_image' alt='book_image'>
            </div>
        </a>";
}

/**
 * @param $id_book
 * @return mysqli_result
 */
function getBookInfo($id_book):mysqli_result
{
    global $conn;
    return $conn->query("SELECT * FROM book WHERE id_book = '$id_book'");
}

/**
 * @return void
 */
function getAllBooks(): void
{
    global $conn;
    $result = $conn->query("SELECT id_book FROM book");

    while ($book = mysqli_fetch_assoc($result)) {
        bookDisplay($book["id_book"]);
    }
}

/**
 * @return void
 */
function addBook(): void
{
    global $conn;
    $book_name = mysqli_real_escape_string($conn, $_POST['book_name']);
    $author = mysqli_real_escape_string($conn, $_POST['author_name']);

    $conn->query("INSERT INTO book (book_name, author, book_img) VALUES ('$book_name', '$author', 'smurfs_blankbook2.webp')");

    $id_book = getLastAddedBook();
    setBookImage($id_book);
}

/**
 * @param int $id_book
 * @return bool
 */
function setBookImage(int $id_book): bool
{
    global $conn;
    $image_name = mysqli_real_escape_string($conn, $_FILES["image"]["name"]);
    $image_type = $_FILES["image"]["type"];

    if (!str_starts_with($image_type, "image")) {
        return false;
    }

    $target_dir = "../book_images/";
    $book_image = $id_book . $image_name;
    $target_file = $target_dir . $book_image;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $conn->query("UPDATE book SET book_img = '$book_image' WHERE id_book = '$id_book'");
    return true;
}

/**
 * @return int
 */
function getLastAddedBook(): int
{
    global $conn;
    $result = $conn->query("SELECT MAX(id_book) AS id_book FROM book");
    return mysqli_fetch_array($result)["id_book"];
}

/**
 * @param $id_book
 * @return void
 */
function editBook($id_book):void
{
    global $conn;
    $book_name = mysqli_real_escape_string($conn, $_POST["book_name"]);
    $author = mysqli_real_escape_string($conn, $_POST["author"]);

    setBookName($book_name, $id_book);
    setAuthor($author, $id_book);
}

/**
 * @param string $newName
 * @param $id_book
 * @return void
 */
function setBookName(string $newName, $id_book):void
{
    global $conn;
    $conn->query("UPDATE book SET book_name = '$newName' WHERE id_book = '$id_book'");
}

/**
 * @param string $newAuthor
 * @param $id_book
 * @return void
 */
function setAuthor(string $newAuthor, $id_book):void
{
    global $conn;
    $conn->query("UPDATE book SET author = '$newAuthor' WHERE id_book = '$id_book'");
}

/**
 * @return array
 */
function validateBook(): array
{
    global $conn;
    $book_name = mysqli_real_escape_string($conn, $_POST["book_name"]);
    $author = mysqli_real_escape_string($conn, $_POST["author"]);

    $errors[0] = isBookNameValid($book_name);
    $errors[1] = isAuthorValid($author);

    if (!empty($_FILES["image"]["type"])) {
        $image_type = $_FILES["image"]["type"];
        if (!str_starts_with($image_type, "image")) {
            $errors[2] = "File is not an image!";
        }
    }

    for ($i = 0; $i < 3; $i++) {
        if ($errors[$i] != "") {
            return $errors;
        }
    }

    return [];
}

/**
 * @param $id_book
 * @param $image
 * @return void
 */
function deleteBook($id_book, $image): void
{
    global $conn;
    if ($image != "smurfs_blankbook2.webp") { //перепиши нахуй
        unlink("../book_images/$image");
    }

    $conn->query("DELETE FROM review WHERE id_book = '$id_book'");
    $conn->query("DELETE FROM book WHERE id_book = '$id_book'");
}


