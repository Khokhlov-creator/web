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