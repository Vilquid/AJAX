<?php
require $_SERVER['DOCUMENT_ROOT'] . "/AJAX/require/pageInitialisation.php";

if(connected()){
    echo 'error';
}else{
    if(isset($_POST['titre']) && isset($_POST['message']) && isset($_POST['forum'])){
        $insert = $ForumManager->ajoutSujet($_POST['titre'], $_POST['message'], $_POST['forum'],$connected_user->getId());
        if($insert){
            echo 'success:'.$insert;
        }else{
            echo 'failed';
        }
    }else{
        echo 'error';
    }
}