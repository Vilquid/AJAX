<?php
require $_SERVER['DOCUMENT_ROOT'] . "/AJAX/require/pageInitialisation.php";

if (!connected()) {
    $connected_user->setEmail($Usermanager->getUserEmail($connected_user->getId()));

?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <title>OuahJax</title>
        <link rel="stylesheet" href="/AJAX/css/forum.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="/AJAX/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="/AJAX/css/compte.css">
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
                        <a class="nav-link" href="/AJAX/php/forums.php"><span><i class="fab fa-wpforms"></i></span> Forum</a>
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
            <h2 class="h4 category mb-0 p-4 rounded-top text-light">Mon compte</h2>


            <div class="row">
                <div class="container-fluid">

                    <div class="col-md-8 mt-3">
                        <form>
                            <!-- pseudo -->
                            <label class="h6 form-control-label">Pseudo</label>
                            <div class="input-group mb-3">
                                <span class="ml-3 form-text"><?php echo $connected_user->getPseudo(); ?></span>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary ml-5 allign-right" value="Submit">Changer</button>
                                </div>
                            </div>
                            <div class="input-group mb-3 change-field">
                                <input type="text" class="form-control" placeholder="Nouveau pseudo" value="<?php echo $connected_user->getPseudo(); ?>" required pattern="[0-9a-zA-Z_]{4,20}">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-success" value="Submit">Envoyer</button>
                                    <button type="button" class="btn btn-danger" value="Submit">Annuler</button>
                                </div>
                            </div>
                            <hr>
                            <!-- email -->
                            <label class="h6 form-control-label">Adresse e-mail</label>
                            <div class="input-group mb-3">
                                <span class="ml-3"><?php echo $connected_user->getEmail(); ?></span>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary ml-5 allign-right" value="Submit">Changer</button>
                                </div>
                            </div>
                            <div class="input-group mb-3 change-field">
                                <input type="text" class="form-control" value="<?php echo $connected_user->getEmail(); ?>">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-success" value="Submit">Envoyer</button>
                                    <button type="button" class="btn btn-danger" value="Submit">Annuler</button>
                                </div>
                            </div>

                            <hr>
                            <!-- password -->
                            <label class="h6 form-control-label">Mot de passe</label>
                            <div class="input-group mb-3">
                                <span class="ml-3 text-muted form-text">************</span>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary ml-5 allign-right" value="Submit">Changer</button>
                                </div>
                            </div>
                            <div class="form-group mb-3 change-field">
                                <input type="text" class="form-control mb-3" placeholder="Ancien mot de passe">
                                <input type="text" class="form-control mb-3" placeholder="Nouveau mot de passe">
                                <input type="text" class="form-control mb-3" placeholder="Confirmer nouveau mot de passe">
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-success" value="Submit">Envoyer</button>
                                    <button type="button" class="btn btn-danger" value="Submit">Annuler</button>
                                </div>
                            </div>

                            <hr>
                            <!-- photo -->
                            <label class="h6 form-control-label">Photo de profil</label>
                            <div class="mb-3">
                                <span class=" mb-3 form-text">
                                    <img id="photo-preview" src="<?php echo $connected_user->getRealPhoto() ?>" alt="" class="d-block ui-w-30 rounded-circle" height="64px" width="64px">
                                </span>
                                <button type="button" class="btn btn-primary mb-3" id="change-photo-button">Changer</button>

                                <div class="input-group mb-3 change-field" id="change-photo-form">
                                    <div class="custom-file">
                                        <input type="file" id="image-upload-input" class="custom-file-input" onchange="loadFile(event)">
                                        <label class="custom-file-label" for="image-upload-input" aria-describedby="image-upload-input-addon">Choisir image</label>
                                    </div>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success" id="upload-photo">Envoyer</button>
                                        <button type="button" class="btn btn-danger" id="cancel-change-photo">Annuler</button>
                                    </div>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>


        <script src=" https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
        </script>
        <script src="/AJAX/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/bb5c883aee.js" crossorigin="anonymous"></script>
        <script src="/AJAX/js/XHR.js"></script>
        <script src="/AJAX/js/compte.js"></script>
    </body>

    </html>

<?php

} else {
    header("Location: /AJAX/php/login.php");
}
?>