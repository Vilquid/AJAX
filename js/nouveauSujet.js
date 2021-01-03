function sendSujet(titre, message,forum, callback) {
    let xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            callback(xhr.responseText);
        }
    };
    xhr.open("POST", "/AJAX/ajax/addSujet.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("titre=" + titre + "&message=" + message + "&forum=" + forum);
}

function checkSujetValidity(){
    let titre_field = document.querySelector('#titre');
    let message_field = document.querySelector('#message');
    let check = 1;
    if(!titre_field.checkValidity()){
        document.querySelector('#titre-help').style.display = 'block';
        check = 0;
    }else{
        document.querySelector('#titre-help').style.display = 'none';
    }
    if(!message_field.checkValidity()){
        document.querySelector('#message-help').style.display = 'block';
        check = 0;
    }else{
        document.querySelector('#message-help').style.display = 'none';
    }
    if(check){
        document.querySelector('#titre-help').style.display = 'none';
        document.querySelector('#message-help').style.display = 'none';
        let urlParser = new URLSearchParams(document.location.search);
        sendSujet(titre_field.value, message_field.value, urlParser.get('forum'), retourConfirmation);
    }else{
        console.log('champs invalides');

    }
}

function retourConfirmation(data){
    console.log(data);
    let frag = data.split(':');
    if(frag[0] == 'success'){
        document.location.href = '/AJAX/php/posts.php?sujet=' + frag[1];
    }
}

document.querySelector('#submit-sujet').addEventListener('click',checkSujetValidity);