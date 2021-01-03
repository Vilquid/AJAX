<?php
session_start();
function chargerClasse($classe)
{
    require $_SERVER['DOCUMENT_ROOT'] . "/AJAX/classes/$classe.php";
}
spl_autoload_register('chargerClasse');
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_id'] != 0) {
        $manager = new UserManager();
        $connected_user = $manager->getUserClientById($_SESSION['user_id']);
    } else {
        $connected_user = null;
    }
} else {
    $connected_user = null;
}

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
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark" ">
        <a class=" navbar-brand" href="/AJAX/index.php">OuahJax</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample03">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">

                    <a class="nav-link" href="/AJAX/index.php"><span><i class="fas fa-home"> </i></span class="sr-only">
                        Accueil</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="/AJAX/php/forums.php"><span><i class="fab fa-wpforms"></i></span>
                        Forum</a>
                </li>
            </ul>

            <?php
            if (!$connected_user) {
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
                                    if ($connected_user->getPhoto()) {
                                        echo '<img src="data:image/png;base64,' . base64_encode($connected_user->getPhoto()) . '" alt="" class="d-block ui-w-30 rounded-circle" height="30px" width="30px">';
                                    } else {
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
                            <a class="dropdown-item" href="/AJAX/php/account.php"><i class="fas fa-user"></i> Profil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item " href="/AJAX/php/deconnexion.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                        </div>
                    </li>
                </ul>

            <?php
            }
            ?>
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
                        <label class="h6 form-control-label">Pseudo</label>
                        <div class="row ">
                            <p class="ml-3">Pseudo du compte connecté ici</p>
                            <button type="button" class="btn btn-primary ml-5 allign-right" value="Submit">Changer</button>
                        </div>
                        <hr>
                        <label class="h6 form-control-label">Adresse e-mail</label>
                        <div class="row ">
                            <p class="ml-3">xxxxx@mail.com</p>
                            <button type="button" class="btn btn-primary ml-5 float-right" value="Submit">Changer</button>
                        </div>

                        <hr>
                        <label class="h6 form-control-label">Mot de passe</label>
                        <div class="row ">
                            <p class="ml-3">************</p>
                            <button type="button" class="btn btn-primary ml-5 float-right" value="Submit">Changer</button>
                        </div>

                        <hr>
                        <label class="h6 form-control-label">Photo de profil</label>
                        <div class="row ">
                            <p class="ml-3">

                                <?php
                                if ($connected_user->getPhoto()) {
                                    echo '<img src="data:image/png;base64,' . base64_encode($connected_user->getPhoto()) . '" alt="" class="d-block ui-w-30 rounded-circle" height="30px" width="30px">';
                                } else {
                                    echo '<img src="https://icons.iconarchive.com/icons/papirus-team/papirus-status/64/avatar-default-icon.png" alt="" class="d-block ui-w-30 rounded-circle" height="100px" width="100px">';
                                }
                                ?>
                            </p>
                            <button type="button" class="btn btn-primary ml-5 float-right" value="Submit">Changer</button>
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
</body>

</html>