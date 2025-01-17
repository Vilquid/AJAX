<?php
session_start();
function chargerClasse($classe)
{
    require $_SERVER['DOCUMENT_ROOT'] . "/AJAX/classes/$classe.php";
}
spl_autoload_register('chargerClasse');
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == 0) {
?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/AJAX/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/AJAX/css/login.css" rel="stylesheet">
        <title>Connexion / Inscription</title>
    </head>

    <body>
        <!-- navbar-->
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <a class=" navbar-brand" href="/AJAX/index.php">OuahJax</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample03">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">

                        <a class="nav-link" href="/AJAX/index.php"><span><i class="fas fa-home"> </i></span>
                            Accueil</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/AJAX/php/forums.php"><span><i class="fab fa-wpforms"></i></span>
                            Forum</a>
                    </li>

                </ul>

            </div>
        </nav>

        <div class="container-fluid h-100">
            <!-- formulaire connexion -->
            <div class="row row-col-6 h-100 align-items-center">
                <!-- connexion-->
                <div class="col-sm-0 col-md-2 col-lg-1"></div>
                <div class="col-sm-12 col-md-8 col-lg-4 text-dark">
                    <h3 class="display-4 text-center">Connexion</h3>
                    <div class="text-center" id="connexionWarning">
                        L'email ou le mot de passe est invalide
                    </div>
                    <form onSubmit="return false;">
                        <div class="form-group">
                            <label for="con-email">Email</label>
                            <input class="form-control" type="email" id="con-email" name="con-email" required="" />
                        </div>
                        <div class="form-group">
                            <label for="con-password">Mot de passe</label>
                            <input class="form-control" type="password" id="con-password" name="con-password" required="" />
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" id="con-submit" class="btn btn-outline-primary">Se connecter</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-0 col-md-2 col-lg-1"></div>
                <!-- inscription-->
                <div class="col-sm-0 col-md-2 col-lg-1"></div>
                <div class="col-sm-12 col-md-8 col-lg-4 text-dark">
                    <h3 class="display-4 text-center">Inscription</h3>
                    <!-- form -->
                    <form onSubmit="return false;">
                        <div class="form-group">
                            <label for="ins-pseudo">Pseudo</label>
                            <div class="input-group">
                                <input class="form-control" type="text" id="ins-pseudo" name="ins-pseudo" required="" pattern="[0-9a-zA-Z_]{4,20}" />
                                <div class="input-group-append">
                                    <div id="ins-pseudo-icon" class="input-group-text validity-icon"></div>
                                </div>
                            </div>
                            <small id="ins-pseudo-help" class="form-text input-help-message"></small>
                        </div>
                        <div class="form-group">
                            <label for="ins-email">Email</label>
                            <div class="input-group">
                                <input class="form-control" type="email" id="ins-email" name="ins-email" required="" pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$" />
                                <div class="input-group-append">
                                    <div id="ins-email-icon" class="input-group-text validity-icon"></div>
                                </div>
                            </div>
                            <small id="ins-email-help" class="form-text input-help-message"></small>
                        </div>
                        <div class="form-group">
                            <label for="ins-password">Mot de passe</label>
                            <div class="input-group">
                                <input class="form-control" type="password" id="ins-password" name="ins-password" required="" minlength="6" />
                                <div class="input-group-append">
                                    <div id="ins-password-icon" class="input-group-text validity-icon"></div>
                                </div>
                            </div>
                            <small id="ins-password-help" class="form-text input-help-message"></small>
                        </div>
                        <div class="form-group">
                            <label for="ins-conf-password">Confirmer mot de passe</label>
                            <div class="input-group">
                                <input class="form-control" type="password" id="ins-conf-password" name="ins-conf-password" required="" minlength="6" />
                                <div class="input-group-append">
                                    <div id="ins-conf-password-icon" class="input-group-text validity-icon"></div>
                                </div>
                            </div>
                            <small id="ins-conf-password-help" class="form-text input-help-message"></small>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" id="ins-submit" class="btn btn-outline-primary">S'inscrire</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-0 col-md-2 col-lg-1"></div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
        </script>
        <script src="/AJAX/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/bb5c883aee.js" crossorigin="anonymous"></script>
        <script src="/AJAX/js/XHR.js" type="text/javascript"></script>
        <script src="/AJAX/js/login.js" type="text/javascript"></script>

    </body>

    </html>
<?php
} else {
    header("Location: /AJAX");
}
