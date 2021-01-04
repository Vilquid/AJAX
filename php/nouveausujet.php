<?php
require $_SERVER['DOCUMENT_ROOT'] . "/AJAX/require/pageInitialisation.php";


if (isset($_GET['forum']) && !connected()) {
    if ($ForumManager->forumExiste($_GET['forum'])) {
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
            <link rel="stylesheet" href="/AJAX/css/newSujet.css">
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
                <h2 class="h4 category mb-0 p-4 rounded-top text-light">Nouveau sujet</h2>

                <div class="row">
                    <div class="container-fluid">

                        <div class="col-md-8 mt-3">
                            <div class="text-center" id="submit-warning">
                                une erreur est survenue !
                            </div>
                            <form>
                                <label class="h4 form-control-label">Titre :</label>
                                <input type="text" id="titre" class="form-control" placeholder="Entrez votre titre (requis)" required minlength="10">
                                <small id="titre-help" class="form-text text-danger" style="display:none;">Le titre doit faire au moins 10 caractères</small>
                                <hr>
                                <div class="form-group shadow-textarea">
                                    <label class="h4 form-control-label">Votre message :</label>
                                    <textarea class="form-control z-depth-1" id="message" rows="3" placeholder="Ecrivez ce que vous allez dire" required minlength="20"></textarea>
                                    <small id="message-help" class="form-text text-danger" style="display:none;">Le message doit faire au moins 20 caractères</small>
                                </div>
                            </form>
                            <br>
                            <button type="button" id="submit-sujet" class="btn btn-success" value="Submit">Soumettre le sujet</button>
                        </div>

                    </div>
                </div>
            </div>


            <script src=" https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <script src="/AJAX/bootstrap/js/bootstrap.min.js"></script>
            <script src="https://kit.fontawesome.com/bb5c883aee.js" crossorigin="anonymous"></script>
            <script src="/AJAX/js/XHR.js" type="text/javascript"></script>
            <script src="/AJAX/js/nouveauSujet.js" type="text/javascript"></script>

        </body>

        </html>


<?php
    } else {
        header("Location: /AJAX/php/forums");
    }
} else {
    header("Location: /AJAX/php/forums");
}
?>