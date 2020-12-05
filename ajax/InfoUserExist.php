<?php
require $_SERVER['DOCUMENT_ROOT'] . "/AJAX/classes/UserManager.php";
if (isset($_POST["field"]) && isset($_POST["value"])) {
    if ($_POST["field"] == "email") {
        $manager = new UserManager();
        echo $manager->emailExist($_POST["value"]) ? "exist" : "free";
    }else if($_POST["field"] == "pseudo"){
        $manager = new UserManager();
        echo $manager->pseudoExist($_POST["value"]) ? "exist" : "free";
    }else{
        echo "error";
    }
} else {
    echo "error";
}
