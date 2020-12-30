<?php
require $_SERVER['DOCUMENT_ROOT'] . "/AJAX/classes/UserManager.php";
if(isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password'])){
    $manager = new UserManager();
    if(preg_match("/[0-9a-zA-Z_]{4,20}/",$_POST['pseudo']) && !preg_match("/(?:_.*){3,}/",$_POST['pseudo']) && preg_match("/.{6,}/",$_POST['password']) && preg_match("/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/",$_POST["email"])){
        if($manager->addUser($_POST['pseudo'], $_POST['email'], $_POST['password'])){
            echo 'success';
        }else{
            echo 'failed';
        }
    }else{
        echo 'failed';
    }
}else{
    echo 'error';
}