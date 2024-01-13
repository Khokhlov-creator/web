<?php

function isReviewNameValid(string $review_name): string
{
    $review_name_error = "";
    if (strlen($review_name) < 2){
        $review_name_error = "Minimum length is 2 characters!";
    } elseif (strlen($review_name) > 30) {
        $review_name_error = "Maximum length is 3 characters!";
    }
    return $review_name_error;
}

function isReviewTextValid(string $review_text): string
{
    $review_text_error = "";
    if (strlen($review_text) < 2){
        $review_text_error = "Minimum length is 2 characters!";
    } elseif (strlen($review_text) > 30) {
        $review_text_error = "Maximum length is 3 characters!";
    }
    return $review_text_error;
}
function isBookNameValid(string $book_name): string
{
    $book_name_error = "";
    if (strlen($book_name) < 2){
        $book_name_error = "Minimum length is 2 characters!";
    } elseif (strlen($book_name) > 30) {
        $book_name_error = "Maximum length is 3 characters!";
    }
    return $book_name_error;
}

function isAuthorValid(string $author): string
{
    $author_error = "";
    if (strlen($author) < 2){
        $author_error = "Minimum length is 2 characters!";
    } elseif (strlen($author) > 30) {
        $author_error = "Maximum length is 3 characters!";
    }
    return $author_error;
}

function isNameValid(string $name): string
{
    $name_error = "";
    if (strlen($name) < 2){
        $name_error = "Minimum length is 2 characters!";
    } elseif (strlen($name) > 30) {
        $name_error = "Maximum length is 3 characters!";
    }
    return $name_error;
}
function isPasswordValid(string $psswd): string
{
    $psswd_error = "";
    if (strlen($psswd) < 2){
        $psswd_error = "Minimum length is 2 characters!";
    } elseif (strlen($psswd) > 30) {
        $psswd_error = "Maximum length is 3 characters!";
    }
    return $psswd_error;
}
function isUsernameValid(string $username): string
{
    $username_error = "";
    if (strlen($username) < 2){
        $username_error = "Minimum length is 2 characters!";
    } elseif (strlen($username) > 30) {
        $username_error = "Maximum length is 3 characters!";
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
