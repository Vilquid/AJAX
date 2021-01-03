<?php
require $_SERVER['DOCUMENT_ROOT'] . "/AJAX/require/pageInitialisation.php";
require $_SERVER['DOCUMENT_ROOT'] . "/AJAX/require/HTMLgenerator.php";
require $_SERVER['DOCUMENT_ROOT'] . "/AJAX/require/dateFormater.php";

if(isset($_GET['forum'])){
    if($_GET['forum'] > 0){
        $forum = $_GET['forum'];
        ?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <title>OuahJax</title>
    <link rel="stylesheet" href="/AJAX/css/forum.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/AJAX/bootstrap/css/bootstrap.css">
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
            <!-- connexion / utilisateur-->
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
                                <div class="col-2">
                                    <img src="<?php echo $connected_user->getRealPhoto() ?>" alt="" class="d-block ui-w-30 rounded-circle" height="30px" width="30px">
                                </div>
                                <div class="col">
                                    <?php echo $connected_user->getPseudo(); ?>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/AJAX/php/account.php"><i class="fas fa-user"></i> Profil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item " href="/AJAX/php/deconnexion.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                        </div>
                    </li>
                </ul>

            <?php
            }
            ?>
            <!-- fin connexion / utilisateur-->
        </div>
        <!--
            <input type="checkbox" id="switch" name="theme" />
            <label id="darkmode" for="switch"><span class="fas fa-sun"> / </span> <span class="fas fa-moon"></span></label>
            -->
        </div>
    </nav>

    <div class="container my-3">
        <nav class="breadcrumb ">
            <h6 class="breadcrumb-item active"><a href="/AJAX/php/forums.php">Forums</a> &nbsp;/&nbsp; <a href="/AJAX/php/sujets?forum=<?php echo $forum;?>.php" class="font-weight-bold"><?php echo $ForumManager->getForumName($forum);?></a> </h6>
        </nav>

        <div class="row">

            <div class="container-fluid mt-100">

                <?php
                if (!$connected_user) {
                ?>
                    <a href="/AJAX/php/login.php">
                        <button type="button" class="btn btn-shadow btn-wide btn-primary">
                            <span class="btn-icon-wrapper pr-2 opacity-7"> <i class="fa fa-plus fa-w-20"></i> </span> Nouveau sujet
                        </button>
                    </a>

                <?php
                } else {
                ?>
                    <a href="/AJAX/php/newpost.php">
                        <button type="button" class="btn btn-shadow btn-wide btn-primary">
                            <span class="btn-icon-wrapper pr-2 opacity-7"> <i class="fa fa-plus fa-w-20"></i> </span> Nouveau sujet
                        </button>
                    </a>
                <?php
                }
                ?>


                <div class="card mt-3 mb-3">
                    <div class="card-header pl-0 prf-0">
                        <div class="row no-gutters w-100 align-items-center">
                            <div class="col ml-3">Sujets</div>
                            <div class="col-4 text-muted">
                                <div class="row no-gutters align-items-center">
                                    <div class="col-4">Réponses</div>
                                    <div class="col-8">Dernière réponse</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php

                    $listeSujet = $ForumManager->getSujetByForum($_GET['forum']);

                    if ($listeSujet) {
                        for ($i = 0; $i < count($listeSujet); $i++) {
                            $user = $Usermanager->getUserClientById($listeSujet[$i]->getUser_id());
                            $lastPost = $ForumManager->getLastPostSujet($listeSujet[$i]->getId());
                            if ($lastPost) {
                                $userReponse = $Usermanager->getUserClientById($lastPost['id_user']);
                                $photoReponse = $userReponse->getRealPhoto();
                                $dateReponse = getDureeAvecDateTime($lastPost['date']);
                                $pseudoReponse = $userReponse->getPseudo();
                            } else {
                                $photoReponse = null;
                                $dateReponse = null;
                                $pseudoReponse = null;
                            }

                            echo getSujetLigne($listeSujet[$i]->getTitre(), $listeSujet[$i]->getId(), getDureeAvecDateTime($listeSujet[$i]->getDate_post()), $user->getPseudo(), $ForumManager->getNombreReponsesSujet($listeSujet[$i]->getId()), $photoReponse, $dateReponse, $pseudoReponse);
                            if ($i < count($listeSujet) - 1) {
                                echo '<hr class="m-0">';
                            }
                        }
                    }
                    ?>






                </div>
                <nav>
                    <ul class="pagination mb-5">
                        <li class="page-item disabled"><a class="page-link" href="javascript:void(0)" data-abc="true">«</a></li>
                        <li class="page-item active"><a class="page-link" href="javascript:void(0)" data-abc="true">1</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)" data-abc="true">2</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)" data-abc="true">3</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)" data-abc="true">»</a></li>
                    </ul>
                </nav>
            </div>





        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="/AJAX/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/bb5c883aee.js" crossorigin="anonymous"></script>
</body>

</html>

<?php
    }else{
        header("Location: /AJAX/php/forums");
    }
}else{
    header("Location: /AJAX/php/forums");
}
?>