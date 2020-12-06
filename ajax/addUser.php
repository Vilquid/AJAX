<?php
require $_SERVER['DOCUMENT_ROOT'] . "/AJAX/classes/UserManager.php";
if(isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password'])){
    $manager = new UserManager();
    if($manager->addUser($_POST['pseudo'], $_POST['email'], $_POST['password'])){
        echo 'success';
    }else{
        echo 'failed';
    }
}else{
    echo 'error';
}