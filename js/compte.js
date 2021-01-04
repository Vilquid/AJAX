let tempPhoto = '';
let origin = true;

// fonction modifié de https://stackoverflow.com/questions/4459379/preview-an-image-before-it-is-uploaded#answer-27165977
var loadFile = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById('photo-preview');
        if (origin) {
            tempPhoto = output.getAttribute('src');
            origin = 0;
        }
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
};

function resetPhoto() {
    if (!origin) {
        let output = document.getElementById('photo-preview');
        output.setAttribute('src', tempPhoto);
        origin = 1;
    }
}

function cancelChangePhoto() {
    resetPhoto();
    document.querySelector('#change-photo-form').style.display = 'none';
    document.querySelector('#change-photo-button').style.display = 'block';
    document.querySelector('#image-upload-input').value = '';
}

function changePhoto() {
    document.querySelector('#change-photo-form').style.display = 'flex';
    document.querySelector('#change-photo-button').style.display = 'none';
}

function sendChange(formData, url, callback) {
    let xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            callback(xhr.responseText);
        }
    };
    xhr.open("POST", url, true);
    xhr.send(formData);
}

function sendPhoto() {
    let files = document.querySelector('#image-upload-input').files;
    if (files.length > 0) {
        let file = files[0];
        if (!file.type.match(/image.*/)) {
            alert("Vous n'avez pas sélectionner une image !");
        } else {
            let formData = new FormData();
            formData.append('change', 'photo');
            formData.append('image', file, file.name);
            sendChange(formData, '/AJAX/ajax/changeUser.php', receivePhotoConfirmation);
        }

    } else {
        alert('vous n\'avez pas sélectionner d\'image');
    }
}

function receivePhotoConfirmation(data) {
    console.log(data);
    if (data == 'success') {
        document.location.reload();
    } else if (data == 'wrongformat') {
        document.querySelector('#image-upload-input').value = '';
        alert('uniquement les formats : png, jpg et jpeg sont acceptés !');
    }
}

function checkPseudo() {
    let pseudo_field = document.querySelector('#pseudo-field');
    if (pseudo_field.checkValidity()) {
        if (!(/(?:_.*){3,}/).test(pseudo_field.value)) {
            let formData = new FormData();
            formData.append('change', 'pseudo');
            formData.append('value', pseudo_field.value);
            sendChange(formData, '/AJAX/ajax/changeUser.php', receivePseudoConfirmation);
        }else{
            alert('Le pseudo doit être alphanumérique avec au plus deux `_` ente 4 et 20 caractères reg');
        }
    }else{
        alert('Le pseudo doit être alphanumérique avec au plus deux `_` ente 4 et 20 caractères');
    }
}

function checkEmail() {
    let email_field = document.querySelector('#email-field');
    if (email_field.checkValidity()) {
        let formData = new FormData();
        formData.append('change', 'email');
        formData.append('value', email_field.value);
        sendChange(formData, '/AJAX/ajax/changeUser.php', receiveEmailConfirmation);
    }else{
        alert('le mail n\'est pas valide !');
    }
}

function checkPassword() {
    let old_password_field = document.querySelector('#old-password-field');
    let new_password_field = document.querySelector('#new-password-field');
    let new_conf_password_field = document.querySelector('#new-conf-password-field');
    if (new_password_field.checkValidity() && new_password_field.checkValidity() && old_password_field.checkValidity()) {
        if (new_password_field.value == new_conf_password_field.value) {
            let formData = new FormData();
            formData.append('change', 'password');
            formData.append('value', old_password_field.value);
            formData.append('value2', new_password_field.value);
            sendChange(formData, '/AJAX/ajax/changeUser.php', receivePasswordConfirmation);
        } else {
            alert('Les mots de passe sont différents !');
        }
    } else {
        alert('le mot de passe doit faire au minimum 6 caractères !');
    }
}

function receivePseudoConfirmation(data) {
    console.log(data);
    if (data == 'success') {
        document.location.reload();
    }else if(data == 'alreadyexist'){
        alert('Ce pseudo existe déjà !');
    }
}

function receiveEmailConfirmation(data) {
    console.log(data);
    if (data == 'success') {
        document.location.reload();
    }else if(data == 'alreadyexist'){
        alert('Cet email existe déjà !');
    }
}

function receivePasswordConfirmation(data) {
    console.log(data);
    if (data == 'success') {
        document.location.reload();
    }else if(data == 'wrong password'){
        alert('Mauvais mot de passe !');
    }
}

function changePseudo() {
    document.querySelector('#static-pseudo').style.display = 'none';
    document.querySelector('#change-pseudo-form').style.display = 'flex';
}
function cancelChangePseudo() {
    document.querySelector('#static-pseudo').style.display = 'flex';
    document.querySelector('#change-pseudo-form').style.display = 'none';
}

function changeEmail() {
    document.querySelector('#static-email').style.display = 'none';
    document.querySelector('#change-email-form').style.display = 'flex';
}
function cancelChangeEmail() {
    document.querySelector('#static-email').style.display = 'flex';
    document.querySelector('#change-email-form').style.display = 'none';
}

function changePassword() {
    document.querySelector('#static-password').style.display = 'none';
    document.querySelector('#change-password-form').style.display = 'block';
}
function cancelChangePassword() {
    document.querySelector('#static-password').style.display = 'flex';
    document.querySelector('#change-password-form').style.display = 'none';
}

//pseudo
document.querySelector('#change-pseudo-button').addEventListener('click', changePseudo);
document.querySelector('#cancel-change-pseudo').addEventListener('click', cancelChangePseudo);
document.querySelector("#upload-pseudo").addEventListener('click', checkPseudo);

//email
document.querySelector('#change-email-button').addEventListener('click', changeEmail);
document.querySelector('#cancel-change-email').addEventListener('click', cancelChangeEmail);
document.querySelector("#upload-email").addEventListener('click', checkEmail);

//password
document.querySelector('#change-password-button').addEventListener('click', changePassword);
document.querySelector('#cancel-change-password').addEventListener('click', cancelChangePassword);
document.querySelector("#upload-password").addEventListener('click', checkPassword);

//photo
document.querySelector("#change-photo-button").addEventListener('click', changePhoto);
document.querySelector("#cancel-change-photo").addEventListener('click', cancelChangePhoto);
document.querySelector("#upload-photo").addEventListener('click', sendPhoto);
