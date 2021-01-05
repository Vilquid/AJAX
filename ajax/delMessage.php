<?php

require $_SERVER['DOCUMENT_ROOT'] . "/AJAX/require/pageInitialisation.php";

if (!connected()) {
    if (isset($_POST['type']) && isset($_POST['id'])) {
        $type = $_POST['type'];
        $id = $_POST['id'];
        if ($type == "sujet") {
            $sujet = $ForumManager->getSujetById($id);
            if ($connected_user->getId($id) == $sujet->getUser_id()) {
                $ForumManager->supprimerSujet($id);
                echo "success";
            } else {
                echo "error0";
            }
        } else if ($type == 'message') {
            $message = $ForumManager->getMessageById($id);
            if ($connected_user->getId($id) == $message->getId_user()) {
                $ForumManager->supprimerMessage($id);
                echo "success";
            } else {
                echo "error0,25";
            }
        } else {
            echo "error0,5";
        }
    } else {
        echo "error1";
    }
} else {
    echo "error2";
}
