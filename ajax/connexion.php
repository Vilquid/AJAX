<?php
require $_SERVER['DOCUMENT_ROOT'] . "/AJAX/classes/UserManager.php";
session_start();
if(isset($_POST["email"]) && isset($_POST["password"])) {
    $manager = new UserManager();
    $user_id = $manager->connexion($_POST["email"], $_POST["password"]);
    if($user_id){
        $_SESSION["user_id"] = $user_id;
        echo 'success';
    }else{
        echo 'fail';
    }
}else{
    echo "error";
}
