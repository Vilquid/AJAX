<?php
session_start();
function chargerClasse($classe)
{
    require $_SERVER['DOCUMENT_ROOT'] . "/AJAX/classes/$classe.php";
}
spl_autoload_register('chargerClasse');
$Usermanager = new UserManager();
$ForumManager = new ForumManager();
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_id'] != 0) {
        $connected_user = $Usermanager->getUserClientById($_SESSION['user_id']);
    } else {
        $connected_user = null;
    }
} else {
    $connected_user = null;
}

function connected(){
    return (!$GLOBALS['connected_user'])?true:false;
}