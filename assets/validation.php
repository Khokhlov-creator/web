<?php

function isReviewNameValid(string $review_name): string
{
    $review_name_error = "";
    if (strlen($review_name) < 4){
        $review_name_error = "Minimum length is 4 characters!";
    } elseif (strlen($review_name) > 32) {
        $review_name_error = "Maximum length is 32 characters!";
    }
    return $review_name_error;
}

function isReviewTextValid(string $review_text): string
{
    $review_text_error = "";
    if (strlen($review_text) < 3){
        $review_text_error = "Minimum length is 3 characters!";
    } elseif (strlen($review_text) > 100) {
        $review_text_error = "Maximum length is 100 characters!";
    }
    return $review_text_error;
}
function isBookNameValid(string $book_name): string
{
    $book_name_error = "";
    if (strlen($book_name) < 4){
        $book_name_error = "Minimum length is 4 characters!";
    } elseif (strlen($book_name) > 32) {
        $book_name_error = "Maximum length is 32 characters!";
    }
    return $book_name_error;
}

function isAuthorValid(string $author): string
{
    $author_error = "";
    if (strlen($author) < 3){
        $author_error = "Minimum length is 3 characters!";
    } elseif (strlen($author) > 32) {
        $author_error = "Maximum length is 32 characters!";
    }
    return $author_error;
}

function isNameValid(string $name): string
{
    $name_error = "";
    if (strlen($name) < 3){
        $name_error = "Minimum length is 3 characters!";
    } elseif (strlen($name) > 32) {
        $name_error = "Maximum length is 32 characters!";
    }
    return $name_error;
}
function isPasswordValid(string $psswd): string
{
    $psswd_error = "";
    $uppercase = preg_match('@[A-Z]@', $psswd);
    $lowercase = preg_match('@[a-z]@', $psswd);
    $number    = preg_match('@[0-9]@', $psswd);
    $specialChars = preg_match('@[^\w]@', $psswd);

    //if (!$uppercase || !$lowercase || !$number || !$specialChars) {
    //    $psswd_error = "Password should include at least one upper case letter, one number, and one special character.";
    //} elseif (strlen($psswd) < 8) {
    if(strlen($psswd) < 3){

        $psswd_error = "Password should be at least 8 characters in length.";
    } elseif (strlen($psswd) >32){
        $psswd_error = "Password should be less than 32 characters in length.";
    }
    return $psswd_error;
}
function isUsernameValid(string $username): string
{
    $username_error = "";
    if (strlen($username) < 6){
        $username_error = "Minimum length is 6 characters!";
    } elseif (strlen($username) > 32) {
        $username_error = "Maximum length is 32 characters!";
    }
    return $username_error;
}

function arePasswordsSame (string $psswd, string $psswd_conf): string
{
    $conf_passwords_error = "";
    if ($psswd !== $psswd_conf){
        $conf_passwords_error = "Passwords are not the same.";
    }
    return $conf_passwords_error;
}
