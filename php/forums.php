<?php
require $_SERVER['DOCUMENT_ROOT'] . "/AJAX/require/pageInitialisation.php";
require $_SERVER['DOCUMENT_ROOT'] . "/AJAX/require/dateFormater.php";
require $_SERVER['DOCUMENT_ROOT'] . "/AJAX/require/HTMLgenerator.php";

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
                <li class="nav-item">

                    <a class="nav-link" href="/AJAX/index.php"><span><i class="fas fa-home"> </i></span> Accueil</a>
                </li>


                <li class="nav-item active">
                    <a class="nav-link" href="/AJAX/php/forums.php"><span><i class="fab fa-wpforms"></i></span class="sr-only"> Forum</a>
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
                                <div class="col-1">
                                    <img src="<?php echo $connected_user->getRealPhoto() ?>" alt="" class="d-block ui-w-30 rounded-circle" height="30px" width="30px">
                                </div>
                                <div class="col text-center">
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
            <h6 class="breadcrumb-item active"><a href="/AJAX/php/forums.php" class="font-weight-bold">Forums</a></h6>
        </nav>

        <div class="row">
            <div class="col-12">
                <h2 class="h4 category mb-0 p-4 rounded-top text-light">Forums</h2>
                <table class="table table-striped table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="forum-col">Forum</th>
                            <th scope="col">Sujets</th>
                            <th scope="col">Posts</th>
                            <th scope="col" class="last-post-col">Dernier Posts</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $listeForum = $ForumManager->getListeForums();
                        if ($listeForum) {
                            for ($i = 0; $i < count($listeForum); $i++) {

                                $nbSujets = $ForumManager->getNombreSujetForum($listeForum[$i]['id']);
                                $nbPost = $ForumManager->getNombrePostForum($listeForum[$i]['id']);
                                $lastPost = $ForumManager->getLastPostForum($listeForum[$i]['id']);
                                if ($lastPost) {
                                    $nomLastSujet = $lastPost['titre'];
                                    $idLastSujet = $lastPost['id_sujet'];
                                    $dateReponse = getDureeAvecDateTime($lastPost['date']);
                                    $userReponse = $Usermanager->getUserClientById($lastPost['id_user']);
                                    $pseudoReponse = $userReponse->getPseudo();
                                } else {
                                    $nomLastSujet = null;
                                    $idLastSujet = null;
                                    $dateReponse = null;
                                    $pseudoReponse = null;
                                }

                                echo getForumLigne($listeForum[$i]['titre'], $listeForum[$i]['id'], $listeForum[$i]['description'], $nbSujets, $nbPost, $nomLastSujet, $idLastSujet, $pseudoReponse, $dateReponse);
                            }
                        }
                        ?>
                        
                    </tbody>
                </table>
            </div>

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <script src="/AJAX/bootstrap/js/bootstrap.min.js"></script>
            <script src="https://kit.fontawesome.com/bb5c883aee.js" crossorigin="anonymous"></script>
</body>

</html>