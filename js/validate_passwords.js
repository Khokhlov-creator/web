const password = document.getElementById("psswd");
const conf_password = document.getElementById("psswd_conf");
const submit = document.getElementById("submit");

const conf_password_response = document.getElementById("conf_password_response");

password.addEventListener("focusout", comparePasswords);
conf_password.addEventListener("focusout", comparePasswords);

function comparePasswords()
{
    if (password.value !== conf_password.value) {
        conf_password_response.innerHTML = "Passwords must be equal!";

        submit.addEventListener("click", block, false)

    } else if (password.value.length !== 0) {
        conf_password_response.innerHTML = "Passwords are equal!";

        submit.removeEventListener("click", block)
    }
}