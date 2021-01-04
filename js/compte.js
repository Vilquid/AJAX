let tempPhoto = '';
let origin = true;

// modifié depuis https://stackoverflow.com/questions/4459379/preview-an-image-before-it-is-uploaded#answer-27165977
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

function sendPhoto(){
    let files = document.querySelector('#image-upload-input').files;
    if(files.length > 0){
        let file = files[0];
        if(!file.type.match(/image.*/)){
            alert("Vous n'avez pas sélectionner une image !");
        }else{
            let formData = new FormData();
            formData.append('image',file,file.name);
            sendChange(formData,'/AJAX/ajax/changePhoto.php',receivePhotoConfirmation);
        }

    }else{
        alert('vous n\'avez pas sélectionner d\'image');
    }
}

function receivePhotoConfirmation(data){
    console.log(data);
    if(data == 'success'){
        document.location.reload();
    }else if(data == 'wrongformat'){
        document.querySelector('#image-upload-input').value = '';
        alert('uniquement les formats : png, jpg et jpeg sont acceptés !');
    }
}




document.querySelector("#change-photo-button").addEventListener('click', changePhoto);
document.querySelector("#cancel-change-photo").addEventListener('click', cancelChangePhoto);
document.querySelector("#upload-photo").addEventListener('click', sendPhoto);
