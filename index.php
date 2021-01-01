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

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/AJAX/bootstrap/css/bootstrap.css" rel="stylesheet">

    <title>Forum Projet AJAX</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class=" navbar-brand" href="/AJAX/index.php">OuahJax</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample03">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">

                    <a class="nav-link" href="/AJAX/index.php"><span><i class="fas fa-home"> </i></span class="sr-only"> Accueil</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="/AJAX/php/sujets.php"><span><i class="fab fa-wpforms"></i></span> Forum</a>
                </li>
            </ul>
            <?php
            if (connected()) {
            ?>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item ">
                        <a class="nav-link" href="/AJAX/php/login.php" tabindex="-1" aria-disabled="true">
                            <span><i class="fas fa-sign-in-alt"></i></span> Se connecter / Inscription</a>
                    </li>
                </ul>
            <?php
            } else {
            ?>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <div class="row">
                                <div class="col-4">
                                    <?php
                                    if($connected_user->getPhoto()){
                                        echo '<img src="data:image/png;base64,'.base64_encode($connected_user->getPhoto()).'" alt="" class="d-block ui-w-30 rounded-circle" height="30px" width="30px">';
                                    }else{
                                        echo '<img src="https://icons.iconarchive.com/icons/papirus-team/papirus-status/64/avatar-default-icon.png" alt="" class="d-block ui-w-30 rounded-circle" height="30px" width="30px">';
                                    }
                                    ?>
                                    
                                </div>
                                <div class="col">
                                    <?php echo $connected_user->getPseudo(); ?>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/AJAX/php/account.php" ><i class="fas fa-user"></i> Profil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item " href="/AJAX/php/deconnexion.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                        </div>
                    </li>
                </ul>
                
            <?php
            }
            ?>
        </div>
        <!--
            <input type="checkbox" id="switch" name="theme" />
            <label id="darkmode" for="switch"><span class="fas fa-sun"> / </span> <span class="fas fa-moon"></span></label>
            -->
        </div>
    </nav>

    <h1 class="d-flex justify-content-center">Bienvenue sur OuahJax !</h1>
    <div class="container my-3">
        <div class="row">
            <div class="col-12 col-xl-9">
                <div class="container" style="margin-top: 2%;">
                    <div class="col-12 col-md-12">
                        <div class="card w-1">
                            <div class="card-body">
                                <h3 class="card-title"> <span class="fas fa-sitemap"></span> A propos du site</h3>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed vestibulum diam. Nullam a vulputate massa. Mauris tincidunt tortor et velit pellentesque gravida. Ut tempus sollicitudin nunc eu tempus. Aenean sagittis ante viverra ante malesuada, vel pharetra diam eleifend. Aliquam porta ante eget gravida tristique. Praesent eleifend enim a lorem.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container" style="margin-top: 2%;">
                    <div class="col-12 col-md-12">
                        <div class="card w-1">
                            <div class="card-body">
                                <h3 class="card-title"> <span class="fas fa-sitemap"></span> Selection de sujets</h3>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed vestibulum diam. Nullam a vulputate massa. Mauris tincidunt tortor et velit pellentesque gravida. Ut tempus sollicitudin nunc eu tempus. Aenean sagittis ante viverra ante malesuada, vel pharetra diam eleifend. Aliquam porta ante eget gravida tristique. Praesent eleifend enim a lorem.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-3">
                <aside>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-xl-12">
                            <div class="card mb-3 mb-sm-0 mb-xl-3">
                                <div class="card-body">
                                    <h2 class="h4 card-title">Membres en ligne</h2>
                                    <ul class="list-noStyle mb-0">
                                        <li><a href="#">Nom du membre</a></li>
                                        <li><a href="#">Nom du membre</a></li>
                                        <li><a href="#">Nom du membre</a></li>
                                        <li><a href="#">Nom du membre</a></li>
                                        <li><a href="#">Nom du membre</a></li>

                                    </ul>
                                </div>
                                <div class="card-footer">
                                    <dl class="row mb-0">
                                        <dt class="col-8"> Total :</dt>
                                        <dd class="col-4 mb-0">?</dd>
                                    </dl>
                                    <dl class="row mb-0">
                                        <dt class="col-8"> Membres :</dt>
                                        <dd class="col-4 mb-0">?</dd>
                                    </dl>
                                    <dl class="row mb-0">
                                        <dt class="col-8"> Invitées :</dt>
                                        <dd class="col-4 mb-0">?</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="h4 card-title">Statistiques</h2>
                                    <dl class="row mb-0">
                                        <dt class="col-8"> Forums</dt>
                                        <dd class="col-4 mb-0"><?php echo $ForumManager->getNombreForum();?></dd>
                                    </dl>
                                    <dl class="row mb-0">
                                        <dt class="col-8"> Sujets</dt>
                                        <dd class="col-4 mb-0"><?php echo $ForumManager->getNombreSujet();?></dd>
                                    </dl>
                                    <dl class="row mb-0">
                                        <dt class="col-8"> Membres</dt>
                                        <dd class="col-4 mb-0"><?php echo $Usermanager->getNombreMembre();?></dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="/AJAX/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/bb5c883aee.js" crossorigin="anonymous"></script>

</body>

</html>