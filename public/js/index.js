function clearForm() {
    document.getElementsByTagName("form")[0].reset();
}

function validateFullName() {
    name = document.getElementsByName("fullName")[0].value;
    const pattern = /[A-Za-z]+(\s[A-Za-z]+)+/;
    if (name == "") {
        document
            .getElementsByName("fullName")[0]
            .setCustomValidity("Invalid field.");
        document.getElementsByName("fullNameError")[0].innerHTML = empty_error;
    } else if (pattern.test(name)) {
        document.getElementsByName("fullName")[0].setCustomValidity("");
        document.getElementsByName("fullNameError")[0].innerHTML = "";
    } else {
        document
            .getElementsByName("fullName")[0]
            .setCustomValidity("Invalid field.");

        document.getElementsByName("fullNameError")[0].innerHTML =
            fullname_error;
    }
}

function validateEmail() {
    email = document.getElementsByName("email")[0];

    if (email.value == "") {
        document.getElementsByName("emailError")[0].innerHTML = empty_error;
    } else if (email.checkValidity()) {
        document.getElementsByName("emailError")[0].innerHTML = "";
    } else {
        document.getElementsByName("emailError")[0].innerHTML = email_error;
    }
}

function validatePhone() {
    phone = document.getElementsByName("phone")[0].value;
    const pattern = /01[0 1 2][0-9]{8}/;
    if (phone == "") {
        document
            .getElementsByName("phone")[0]
            .setCustomValidity("Invalid field.");
        document.getElementsByName("phoneError")[0].innerHTML = empty_error;
    } else if (pattern.test(phone)) {
        document.getElementsByName("phone")[0].setCustomValidity("");
        document.getElementsByName("phoneError")[0].innerHTML = "";
    } else {
        document
            .getElementsByName("phone")[0]
            .setCustomValidity("Invalid field.");
        document.getElementsByName("phoneError")[0].innerHTML = phone_error;
    }
}

function validatePassword() {
    pass = document.getElementsByName("password")[0].value;
    const specialChars = /[^\w\d]|_/;
    const number = /[0-9]/;
    if (pass == "") {
        document
            .getElementsByName("password")[0]
            .setCustomValidity("Invalid field.");
        document.getElementsByName("passError")[0].innerHTML = empty_error;
    } else if (
        specialChars.test(pass) &&
        number.test(pass) &&
        pass.length >= 8
    ) {
        document.getElementsByName("password")[0].setCustomValidity("");
        document.getElementsByName("passError")[0].innerHTML = "";
    } else {
        document
            .getElementsByName("password")[0]
            .setCustomValidity("Invalid field.");
        document.getElementsByName("passError")[0].innerHTML = pass_error;
    }
    validateConfirmPassword();
}

function validateConfirmPassword() {
    pass = document.getElementsByName("password")[0].value;
    confirmation = document.getElementsByName("confirmPassword")[0].value;
    if (pass == confirmation) {
        document.getElementsByName("confirmPassword")[0].setCustomValidity("");
        document.getElementsByName("confirmError")[0].innerHTML = "";
    } else {
        document
            .getElementsByName("confirmPassword")[0]
            .setCustomValidity("Invalid field.");
        document.getElementsByName("confirmError")[0].innerHTML = confirm_error;
    }
}

function checkUser(username) {
    var xhr = new XMLHttpRequest();

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "Valid") {
                document.getElementsByName("userName")[0].setCustomValidity("");
                document.getElementsByName("userNameError")[0].innerHTML = "";
            } else {
                document
                    .getElementsByName("userName")[0]
                    .setCustomValidity("Invalid field.");
                document.getElementsByName("userNameError")[0].innerHTML =
                    username_error;
            }
        }
    };
    xhttp.open("GET", "/checkUser/" + username);
    xhttp.send();
}

function validateUserName() {
    name = document.getElementsByName("userName")[0].value;

    if (name == "") {
        document
            .getElementsByName("userName")[0]
            .setCustomValidity("Invalid field.");
        document.getElementsByName("userNameError")[0].innerHTML = empty_error;
    } else {
        checkUser(name);
    }
}
function validateDate() {
    date = document.getElementsByName("birthDate")[0];

    if (date.value == "") {
        document.getElementsByName("birthDateError")[0].innerHTML = empty_error;
    } else if (date.checkValidity()) {
        document.getElementsByName("birthDateError")[0].innerHTML = "";
    } else {
        document.getElementsByName("birthDate")[0].innerHTML = date_error;
    }
}
function validateAddress() {
    address = document.getElementsByName("address")[0];

    if (address.value == "") {
        document.getElementsByName("addressError")[0].innerHTML = empty_error;
    } else {
        document.getElementsByName("addressError")[0].innerHTML = "";
    }
}

function validateAll() {
    validateUserName();
    validateFullName();
    validateEmail();
    validatePhone();
    validatePassword();
    validateConfirmPassword();
    validateDate();
    validateAddress();
}

function getActors() {
    date = document.getElementsByName("birthDate")[0];

    if (!date.checkValidity()) {
        document.getElementsByName("birthDateError")[0].innerHTML = date_error;
        return;
    } else {
        document.getElementsByName("birthDateError")[0].innerHTML = "";
    }

    inputDate = date.value;
    var selectedDate = new Date(inputDate);

    var day = selectedDate.getDate();
    var month = selectedDate.getMonth() + 1;

    var xhr = new XMLHttpRequest();

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            actors = this.responseText.split(",");

            if (actors[0] == "") {
                document.getElementsByName("listItems")[0].innerHTML =
                    "there are no actors born this day ";
            } else {
                document.getElementsByName("listItems")[0].innerHTML = "";
                for (i = 0; i < actors.length; i++) {
                    if (actors[i] == "") continue;
                    document.getElementsByName("listItems")[0].innerHTML +=
                        "<li>" + actors[i] + "</li>";
                }
            }
        }
    };
    xhttp.open("GET", "/getActors/" + month + "/" + day);
    xhttp.send();
}
window.onload = function () {
    clearForm();
    validateAll();
};
