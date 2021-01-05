var container = document.getElementById("TextAreaLocation");
var container2 = document.getElementById("AnswerContainer");
var sendbutton = document.getElementById("Send");
var revertbutton = document.getElementById("RevertChange");
var answerbutton = document.getElementById("answerbutton");

var area = document.createElement("textarea");
area.setAttribute("minlength", "10");
area.setAttribute("required", "");

function showEditBox() {
    if (container) {
        area.setAttribute("class", "form-control mb-4");
        area.removeAttribute("placeholder");
        container.appendChild(area);
    } else {
        alert("error");
    }
}

function showEditBox2(id) {
    if (container) {
        let message = document.getElementById(id).getElementsByClassName("message")[0].innerHTML;
        area.setAttribute("class", "form-control mb-4");
        area.setAttribute("placeholder", "Répondre à : " + message);
        container2.innerHTML = "Répondre à : " + message;
        container2.style.display = "block";
        container.appendChild(area);

    } else {
        alert("error");
    }
}

function showSendButton(id = "") {
    sendbutton.innerHTML = "Envoyer la réponse";
    sendbutton.setAttribute("class", "btn btn-primary btn-success btn-lg btn-block");
    sendbutton.setAttribute("onclick", "sendAnswer(" + id + ")");

    revertbutton.innerHTML = "Annuler";
    revertbutton.setAttribute("class", "btn btn-primary btn-secondary btn-lg btn-block");
    revertbutton.setAttribute("style", "display:block;");
    revertbutton.setAttribute("onclick", "revertChange()");


}


function revertChange() {

    sendbutton.innerHTML = "Répondre au sujet";
    sendbutton.setAttribute("class", "btn btn-primary btn-danger btn-lg btn-block");

    area.value = "";
    area.remove();

    container2.innerHTML = "";
    container2.style.display = "none";

    revertbutton.setAttribute("style", "display:none;");

    sendbutton.setAttribute("onclick", "test1()");

}

function sendAnswer(id = null) {
    if (area.checkValidity()) {
        let newformdata = new FormData();
        newformdata.append("message", area.value);
        let urlParser = new URLSearchParams(document.location.search);
        newformdata.append("sujet", urlParser.get("sujet"));
        if (id) {
            newformdata.append("parent", id);
        }
        sendAJAX(newformdata, "/AJAX/ajax/sendmessage.php", receiveMessageConfirmation);

    }

}

function receiveMessageConfirmation(data) {
    console.log(data);
    if (data == 'success') {
        document.location.reload();
    }
}

function receiveDeleteMessage(data) {
    console.log(data);
    if (data == 'success') {
        //document.location.reload();
    }
}

function receiveDeleteSujet(data) {
    console.log(data);
    if (data == 'success') {
        document.location.href = document.getElementById("listesujets").getAttribute("href");
    }
}

function sendAJAX(formData, url, callback) {
    let xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            callback(xhr.responseText);
        }
    };
    xhr.open("POST", url, true);
    xhr.send(formData);
}


function supprimerMessage(id) {
    let newformdata = new FormData();
    newformdata.append("type", "message");
    newformdata.append("id", id);
    sendAJAX(newformdata, "/AJAX/ajax/delMessage.php", receiveDeleteMessage);

}

function supprimerSujet(id) {
    let newformdata = new FormData();
    newformdata.append("type", "sujet");
    newformdata.append("id", id);
    sendAJAX(newformdata, "/AJAX/ajax/delMessage.php", receiveDeleteSujet);

}

function test1() {
    showEditBox();
    showSendButton();
}

function test2(id) {
    showEditBox2(id);
    showSendButton(id);
}