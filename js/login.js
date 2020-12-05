function InfoUserExist(field, value, callback){
    let xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
            callback(xhr.responseText);
        }
    };
    xhr.open("POST","/AJAX/ajax/InfoUserExist.php",true);
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xhr.send("field="+field+"&value="+value);
}

function changeEmailValidity(validity){
    email_field = document.querySelector("#ins-email");
    email_help = document.querySelector("#ins-email-help");
    email_icon = document.querySelector("#ins-email-icon");
    switch(validity){
        case "free":
            email_help.style.display = "none";
            email_icon.style.display = "block";
            email_icon.innerHTML = '<i class="fas fa-check"></i>';
            email_icon.setAttribute("class","input-group-text text-white bg-success border-success");
            email_field.setAttribute("class", "form-control border-success");
            break;
        case "invalid":
            email_help.style.display = "block";
            email_help.innerHTML = "Cet email n'est pas valide";
            email_icon.style.display = "block";
            email_icon.innerHTML = '<i class="fas fa-times"></i>';
            email_icon.setAttribute("class","input-group-text text-white bg-danger border-danger");
            email_field.setAttribute("class", "form-control border-danger");
            break;
        case "exist":
            email_help.style.display = "block";
            email_help.innerHTML = "Cet email est déjà pris";
            email_icon.style.display = "block";
            email_icon.innerHTML = '<i class="fas fa-times"></i>';
            email_icon.setAttribute("class","input-group-text text-white bg-danger border-danger");
            email_field.setAttribute("class", "form-control border-danger");
    }
}

function changePseudoValidity(validity){
    pseudo_field = document.querySelector("#ins-pseudo");
    pseudo_help = document.querySelector("#ins-pseudo-help");
    pseudo_icon = document.querySelector("#ins-pseudo-icon");
    switch(validity){
        case "free":
            pseudo_help.style.display = "none";
            pseudo_icon.style.display = "block";
            pseudo_icon.innerHTML = '<i class="fas fa-check"></i>';
            pseudo_icon.setAttribute("class","input-group-text text-white bg-success border-success");
            pseudo_field.setAttribute("class", "form-control border-success");
            break;
        case "invalid":
            pseudo_help.style.display = "block";
            pseudo_help.innerHTML = "Ce pseudo n'est pas valide";
            pseudo_icon.style.display = "block";
            pseudo_icon.innerHTML = '<i class="fas fa-times"></i>';
            pseudo_icon.setAttribute("class","input-group-text text-white bg-danger border-danger");
            pseudo_field.setAttribute("class", "form-control border-danger");
            break;
        case "exist":
            pseudo_help.style.display = "block";
            pseudo_help.innerHTML = "Ce pseudo est déjà pris";
            pseudo_icon.style.display = "block";
            pseudo_icon.innerHTML = '<i class="fas fa-times"></i>';
            pseudo_icon.setAttribute("class","input-group-text text-white bg-danger border-danger");
            pseudo_field.setAttribute("class", "form-control border-danger");
    }
}

function checkEmailValidity(){
    email_field = document.querySelector("#ins-email");
    if(email_field.checkValidity()){
        InfoUserExist("email",email_field.value,changeEmailValidity);
    }else{
        changeEmailValidity("invalid");
    }
}

function checkPseudoValidity(){
    pseudo_field = document.querySelector("#ins-pseudo");
    if(pseudo_field.checkValidity()){
        InfoUserExist("pseudo",pseudo_field.value,changePseudoValidity);
    }else{
        changePseudoValidity("invalid");
    }
}

function bindEvent(){
    document.querySelector("#ins-email").addEventListener("input",checkEmailValidity);
    document.querySelector("#ins-pseudo").addEventListener("input",checkPseudoValidity);
}

window.addEventListener("load",bindEvent);