let formValidity = {
    email: false,
    pseudo: false,
    password: false
};

function InfoUserExist(field, value, callback) {
    let xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            callback(xhr.responseText);
        }
    };
    xhr.open("POST", "/AJAX/ajax/InfoUserExist.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("field=" + field + "&value=" + value);
}

function changeEmailValidity(validity) {
    email_field = document.querySelector("#ins-email");
    email_help = document.querySelector("#ins-email-help");
    email_icon = document.querySelector("#ins-email-icon");
    switch (validity) {
        case "free":
            email_help.style.display = "none";
            email_icon.style.display = "block";
            email_icon.innerHTML = '<i class="fas fa-check"></i>';
            email_icon.setAttribute("class", "input-group-text text-white bg-success border-success");
            email_field.setAttribute("class", "form-control border-success");
            formValidity.email = true;
            break;
        case "invalid":
            email_help.style.display = "block";
            email_help.innerHTML = "Cet email n'est pas valide";
            email_icon.style.display = "block";
            email_icon.innerHTML = '<i class="fas fa-times"></i>';
            email_icon.setAttribute("class", "input-group-text text-white bg-danger border-danger");
            email_field.setAttribute("class", "form-control border-danger");
            formValidity.email = false;
            break;
        case "exist":
            email_help.style.display = "block";
            email_help.innerHTML = "Cet email est déjà pris";
            email_icon.style.display = "block";
            email_icon.innerHTML = '<i class="fas fa-times"></i>';
            email_icon.setAttribute("class", "input-group-text text-white bg-danger border-danger");
            email_field.setAttribute("class", "form-control border-danger");
            formValidity.email = false;
    }
}

function changePseudoValidity(validity) {
    pseudo_field = document.querySelector("#ins-pseudo");
    pseudo_help = document.querySelector("#ins-pseudo-help");
    pseudo_icon = document.querySelector("#ins-pseudo-icon");
    switch (validity) {
        case "free":
            pseudo_help.style.display = "none";
            pseudo_icon.style.display = "block";
            pseudo_icon.innerHTML = '<i class="fas fa-check"></i>';
            pseudo_icon.setAttribute("class", "input-group-text text-white bg-success border-success");
            pseudo_field.setAttribute("class", "form-control border-success");
            formValidity.pseudo = true;
            break;
        case "invalid":
            pseudo_help.style.display = "block";
            pseudo_help.innerHTML = "Ce pseudo n'est pas valide";
            pseudo_icon.style.display = "block";
            pseudo_icon.innerHTML = '<i class="fas fa-times"></i>';
            pseudo_icon.setAttribute("class", "input-group-text text-white bg-danger border-danger");
            pseudo_field.setAttribute("class", "form-control border-danger");
            formValidity.pseudo = false;
            break;
        case "exist":
            pseudo_help.style.display = "block";
            pseudo_help.innerHTML = "Ce pseudo est déjà pris";
            pseudo_icon.style.display = "block";
            pseudo_icon.innerHTML = '<i class="fas fa-times"></i>';
            pseudo_icon.setAttribute("class", "input-group-text text-white bg-danger border-danger");
            pseudo_field.setAttribute("class", "form-control border-danger");
            formValidity.pseudo = false;
    }
}

function checkEmailValidity() {
    email_field = document.querySelector("#ins-email");
    if (email_field.checkValidity()) {
        InfoUserExist("email", email_field.value, changeEmailValidity);
    } else {
        changeEmailValidity("invalid");
    }
}

function checkPseudoValidity() {
    pseudo_field = document.querySelector("#ins-pseudo");
    if (pseudo_field.checkValidity()) {
        InfoUserExist("pseudo", pseudo_field.value, changePseudoValidity);
    } else {
        changePseudoValidity("invalid");
    }
}

function checkConfPasswordValidity() {
    password_field = document.querySelector("#ins-password");
    conf_password_field = document.querySelector("#ins-conf-password");
    conf_password_icon = document.querySelector("#ins-conf-password-icon");
    conf_password_help = document.querySelector("#ins-conf-password-help");
    if (password_field.value === conf_password_field.value) {
        //si les mots de passe sont identique
        conf_password_help.style.display = "none";
        conf_password_icon.style.display = "block";
        conf_password_icon.innerHTML = '<i class="fas fa-check"></i>';
        conf_password_icon.setAttribute("class", "input-group-text text-white bg-success border-success");
        conf_password_field.setAttribute("class", "form-control border-success");
        formValidity.password = true;
    } else {
        //si les mots de passe sont différent
        conf_password_help.style.display = "block";
        conf_password_help.innerHTML = "Les mots de passe sont différent";
        conf_password_icon.style.display = "block";
        conf_password_icon.innerHTML = '<i class="fas fa-times"></i>';
        conf_password_icon.setAttribute("class", "input-group-text text-white bg-danger border-danger");
        conf_password_field.setAttribute("class", "form-control border-danger");
        formValidity.password = false;
    }
}

//send form
function sendForm() {
    if (formValidity.email && formValidity.password && formValidity.password) {
        sendInscription(document.querySelector("#ins-pseudo").value, document.querySelector("#ins-email").value, document.querySelector("#ins-password").value, recieveInscription);
        console.log("form sent");
    }
}

function sendInscription(pseudo, email, password, callback) {
    let xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            callback(xhr.responseText);
        }
    };
    xhr.open("POST", "/AJAX/ajax/addUser.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("pseudo=" + pseudo + "&email=" + email + "&password=" + password);
}

function recieveInscription(data) {
    if (data === "success") {
        console.log("inscription valide, vous pouvez vous connecter");
        document.querySelector("#ins-email").value = "";
        document.querySelector("#ins-pseudo").value = "";
        document.querySelector("#ins-password").value = "";
        document.querySelector("#ins-conf-password").value = "";
    } else if (data === "failed") {
        console.log("l'email ou le pseudo est déjà prit");
    } else {
        console.log("Une erreur est survenue : " + data);
    }
}

//form input style application
function applyStyle(name_field, validity, help_message = "") {
    field = document.querySelector("#ins-" + name_field);
    icon = document.querySelector("#ins-" + name_field + "-icon");
    help = document.querySelector("#ins-" + name_field + "-help");
    switch (validity) {
        case "valid":
            help.style.display = "none";
            icon.style.display = "block";
            icon.innerHTML = '<i class="fas fa-check"></i>';
            icon.setAttribute("class", "input-group-text text-white bg-success border-success");
            field.setAttribute("class", "form-control border-success");
            break;
        case "invalid":
            help.style.display = "block";
            conf_password_help.innerHTML = help_message;
            icon.style.display = "block";
            icon.innerHTML = '<i class="fas fa-times"></i>';
            icon.setAttribute("class", "input-group-text text-white bg-danger border-danger");
            field.setAttribute("class", "form-control border-danger");
        case "neutral":
            help.style.display = "none";
            conf_password_help.innerHTML = help_message;
            icon.style.display = "none";
            icon.innerHTML = '';
            icon.setAttribute("class", "input-group-text");
            field.setAttribute("class", "form-control");
    }
}

function bindEvent() {
    document.querySelector("#ins-email").addEventListener("input", checkEmailValidity);
    document.querySelector("#ins-pseudo").addEventListener("input", checkPseudoValidity);
    document.querySelector("#ins-conf-password").addEventListener("input", checkConfPasswordValidity);
    document.querySelector("#ins-submit").addEventListener("click", sendForm);
}

window.addEventListener("load", bindEvent);