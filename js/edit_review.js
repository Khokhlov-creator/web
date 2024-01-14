const edit_review = document.getElementById("edit_review");

edit_review.addEventListener("click", editReview);

const submit_review = document.getElementById("review_edit_submit");

const review_name = document.getElementById("review_name");
const review_text = document.getElementById("review_text");


function editReview()
{
    review_name.removeAttribute("readonly");
    review_text.removeAttribute("readonly");

    submit_review.innerHTML = "<input type='submit' name='submit' value='Save'>";
}