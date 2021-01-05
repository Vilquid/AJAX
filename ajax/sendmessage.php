<?php

require $_SERVER['DOCUMENT_ROOT'] . "/AJAX/require/pageInitialisation.php";

if (!connected()) {
    if (isset($_POST['message']) && isset($_POST['sujet'])) {
        $message = $_POST['message'];
        $sujet_id = $_POST['sujet'];
        if (isset($_POST['parent'])) {
            $parent = $_POST['parent'];
        } else {
            $parent = null;
        }

        if (preg_match("/.{10,}/", $message)) {
            if ($ForumManager->sujetExiste($sujet_id)) {
                if ($parent) {
                    if ($ForumManager->verifMessageSujet($parent, $sujet_id)) {
                        $ForumManager->addMessage($message, $sujet_id, $parent, $connected_user->getId());
                        echo "success";
                    } else {
                        echo "error1";
                    }
                } else {
                    $ForumManager->addMessage($message, $sujet_id, $parent, $connected_user->getId());
                    echo "success";
                }
            } else {
                echo "error2";
            }
        } else {
            echo "error3";
        }
    } else {
        echo "error4";
    }
} else {
    echo "error5";
}
