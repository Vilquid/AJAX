var container = document.getElementById("TextAreaLocation");
var sendbutton = document.getElementById("Send");
var revertbutton = document.getElementById("RevertChange");

var functionchange1 = document.getElementById("functionchange1");
var functionchange2 = document.getElementById("functionchange2");
var functionchange3 = document.getElementById("functionchange3");

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


    revertbutton.innerHTML = "Annuler";
    revertbutton.setAttribute("class", "btn btn-primary btn-secondary btn-lg btn-block");
    revertbutton.setAttribute("style", "display:block;");


    functionchange1.setAttribute("onclick", "sendAnswer()");
    functionchange2.removeAttribute("onclick");

    functionchange3.setAttribute("onclick", "revertChange()");

}


function revertChange() {

    sendbutton.innerHTML = "Répondre au sujet";
    sendbutton.setAttribute("class", "btn btn-primary btn-danger btn-lg btn-block");

    area.value = "";
    area.remove();

    revertbutton.setAttribute("style", "display:none;");

    functionchange1.setAttribute("onclick", "test1()");
    functionchange2.setAttribute("onclick", "test2()");

}

function test1() {
    showEditBox();
    showSendButton();
}

function test2() {
    showEditBox2();
    showSendButton();
}