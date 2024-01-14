const username = document.getElementById("username");
const username_response = document.getElementById("username_response");

username.addEventListener("focusout", isUsernameValid);

function isUsernameValid() {
    let http = new XMLHttpRequest();
    http.open("GET", "../js/ajax.php?username=" + encodeURI(username.value), true);

    http.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            username_response.innerHTML = this.responseText;

            if (this.responseText !== "") {
                submit.addEventListener("click", block, false)
            } else {
                submit.removeEventListener("click", block)
            }
        }
    }
    http.send();
}

function block (event) {
    event.preventDefault();
}
