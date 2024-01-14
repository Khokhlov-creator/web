const edit_book = document.getElementById("edit_book");

edit_book.addEventListener("click", editReview);

const submit_book = document.getElementById("book_edit_submit");

const book_name = document.getElementById("book_name");
const author = document.getElementById("author");


function editReview()
{
    book_name.removeAttribute("readonly");
    author.removeAttribute("readonly");

    submit_book.innerHTML = "<input type='submit' name='edit' value='Save'>";
}