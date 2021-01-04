<?php
require $_SERVER['DOCUMENT_ROOT'] . "/AJAX/require/pageInitialisation.php";

if(!connected()){
    if(isset($_FILES['image']['name'])){
        $filename = $_FILES['image']['name'];
        $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

        $extension_valide = Array('png', 'jpg', 'jpeg');
        if(in_array($file_extension, $extension_valide)){
            $Usermanager->changePhoto($connected_user->getId(),file_get_contents($_FILES['image']['tmp_name']));
            echo 'success';
        }else{
            echo 'wrongformat';
        }
    }else{
        echo 'noimage';
    }
}else{
    echo 'error';
}