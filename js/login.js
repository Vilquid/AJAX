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
    switch (validity) {
        case "free":
            applyStyle("email","valid");
            formValidity.email = true;
            break;
        case "invalid":
            applyStyle("email","invalid","Cet email n'est pas valide");
            formValidity.email = false;
            break;
        case "exist":
            applyStyle("email","invalid","Cet email est déjà pris");
            formValidity.email = false;
    }
}

function changePseudoValidity(validity) {
    switch (validity) {
        case "free":
            applyStyle("pseudo","valid");
            formValidity.pseudo = true;
            break;
        case "invalid":
            applyStyle("pseudo","invalid","Ce pseudo n'est pas valide");
            formValidity.pseudo = false;
            break;
        case "exist":
            applyStyle("pseudo","invalid","Ce pseudo est déjà pris");
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
    if (password_field.value === conf_password_field.value) {
        //si les mots de passe sont identique
        applyStyle("conf-password","valid");
        formValidity.password = true;
    } else {
        //si les mots de passe sont différent
        applyStyle("conf-password","invalid","Les mots de passe sont différent");
        formValidity.password = false;
    }
}

//send form
function sendForm() {
    if (formValidity.email && formValidity.pseudo && formValidity.password) {
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
        sendConnexion(document.querySelector("#ins-email").value,document.querySelector("#ins-password").value,connexion);
        document.querySelector("#ins-email").value = "";
        document.querySelector("#ins-pseudo").value = "";
        document.querySelector("#ins-password").value = "";
        document.querySelector("#ins-conf-password").value = "";
        applyStyle("email","neutral");
        applyStyle("pseudo","neutral");
        applyStyle("conf-password","neutral");
        formValidity.password = false;
        formValidity.email = false;
        formValidity.pseudo = false;
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
            help.innerHTML = help_message;
            icon.style.display = "block";
            icon.innerHTML = '<i class="fas fa-times"></i>';
            icon.setAttribute("class", "input-group-text text-white bg-danger border-danger");
            field.setAttribute("class", "form-control border-danger");
            break;
        case "neutral":
            help.style.display = "none";
            help.innerHTML = help_message;
            icon.style.display = "none";
            icon.innerHTML = '';
            icon.setAttribute("class", "input-group-text");
            field.setAttribute("class", "form-control");
            break;
    }
}

// ######################## connexion #################################################################
function sendConnexion(email, password, callback) {
    let xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            callback(xhr.responseText);
        }
    };
    xhr.open("POST", "/AJAX/ajax/connexion.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("email=" + email + "&password=" + password);
}

function checkConnexion(){
    email = document.querySelector("#con-email").value;
    password = document.querySelector("#con-password").value;
    sendConnexion(email,password,connexion);
}

function connexion(state){
    console.log(state);
    if(state == 'success'){
        document.location.href = '/AJAX';
    }
}

function bindEvent() {
    document.querySelector("#ins-email").addEventListener("input", checkEmailValidity);
    document.querySelector("#ins-pseudo").addEventListener("input", checkPseudoValidity);
    document.querySelector("#ins-conf-password").addEventListener("input", checkConfPasswordValidity);
    document.querySelector("#ins-submit").addEventListener("click", sendForm);
    document.querySelector("#con-submit").addEventListener("click", checkConnexion);
}

window.addEventListener("load", bindEvent);