<?php
require $_SERVER['DOCUMENT_ROOT'] . "/AJAX/require/pageInitialisation.php";

if (!connected()) {
    if (isset($_POST['change'])) {
        if ($_POST['change'] == 'photo') {
            if (isset($_FILES['image']['name'])) {
                $filename = $_FILES['image']['name'];
                $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

                $extension_valide = array('png', 'jpg', 'jpeg');
                if (in_array($file_extension, $extension_valide)) {
                    $Usermanager->changePhoto($connected_user->getId(), file_get_contents($_FILES['image']['tmp_name']));
                    echo 'success';
                } else {
                    echo 'wrongformat';
                }
            } else {
                echo 'noimage';
            }
        }else if($_POST['change'] == 'pseudo'){
            if(isset($_POST['value'])){
                $pseudo = $_POST['value'];
                if(preg_match("/[0-9a-zA-Z_]{4,20}/",$pseudo) && !preg_match("/(?:_.*){3,}/",$pseudo)){
                    if($Usermanager->pseudoExist($pseudo)){
                        echo 'alreadyexist';
                    }else{
                        $Usermanager->changePseudo($connected_user->getId(), $pseudo);
                        echo 'success';
                    }
                }else{
                    echo 'error';
                }
            }else{
                echo 'error';
            }
        }else if($_POST['change'] == 'email'){
            if(isset($_POST['value'])){
                $email = $_POST['value'];
                if(preg_match("/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/",$email)){
                    if($Usermanager->emailExist($email)){
                        echo 'alreadyexist';
                    }else{
                        $Usermanager->changeEmail($connected_user->getId(), $email);
                        echo 'success';
                    }
                }else{
                    echo 'error';
                }
            }else{
                echo 'error';
            }
        }else if($_POST['change'] == 'password'){
            if(isset($_POST['value']) && isset($_POST['value2'])){
                $oldpassword = $_POST['value'];
                $newpassword = $_POST['value2'];
                if($Usermanager->changePassword($connected_user->getId(), $oldpassword, $newpassword)){
                    echo 'success';
                }else{
                    echo 'wrong password';
                }
            }else{
                echo 'error';
            }
        }else{
            echo 'error change';
        }
    }else{
        echo 'error';
    }
} else {
    echo 'error';
}
