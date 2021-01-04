var container = document.getElementById("TextAreaLocation");
var sendbutton = document.getElementById("Send");
var revertbutton = document.getElementById("RevertChange");
var answerbutton = document.getElementById("answerbutton");

var area = document.createElement("textarea");

function showEditBox() {
    if (container) {
        area.setAttribute("class", "form-control mb-4");
        area.removeAttribute("placeholder");
        container.appendChild(area);
    } else {
        alert("error");
    }
}

function showEditBox2() {
    if (container) {
        area.setAttribute("class", "form-control mb-4");
        area.setAttribute("placeholder", "Répondre à xxxxxxxx");
        container.appendChild(area);

    } else {
        alert("error");
    }
}

function showSendButton() {
    sendbutton.innerHTML = "Envoyer la réponse";
    sendbutton.setAttribute("class", "btn btn-primary btn-success btn-lg btn-block");
    sendbutton.setAttribute("onclick", "sendAnswer()");

    revertbutton.innerHTML = "Annuler";
    revertbutton.setAttribute("class", "btn btn-primary btn-secondary btn-lg btn-block");
    revertbutton.setAttribute("style", "display:block;");
    revertbutton.setAttribute("onclick", "revertChange()");

    answerbutton.removeAttribute("onclick");

}


function revertChange() {

    sendbutton.innerHTML = "Répondre au sujet";
    sendbutton.setAttribute("class", "btn btn-primary btn-danger btn-lg btn-block");

    area.value = "";
    area.remove();

    revertbutton.setAttribute("style", "display:none;");

    sendbutton.setAttribute("onclick", "test1()");
    answerbutton.setAttribute("onclick", "test2()");

}

function sendAnswer() {

}


function test1() {
    showEditBox();
    showSendButton();
}

function test2() {
    showEditBox2();
    showSendButton();
}