<?php
if(isset($_POST["pseudo"]) && isset($_POST["pass"])){
    if($_POST["pseudo"]=="pseudo" && $_POST["pass"]=="pass"){ // verif bdd
        echo "OK";
    }else{
        echo "KO";
    }
}