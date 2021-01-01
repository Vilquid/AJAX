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
        $connected_user = $manager->getPseudoById($_SESSION['user_id']);
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

                    <a class="nav-link" href="/AJAX/index.php"><span><i class="fas fa-home"> </i></span class="sr-only"> Accueil</a>
                </li>


                <li class="nav-item active">
                    <a class="nav-link" href="/AJAX/php/sujets.php"><span><i class="fab fa-wpforms"></i></span> Forum</a>
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
                            <img src="https://icons.iconarchive.com/icons/papirus-team/papirus-status/64/avatar-default-icon.png" alt="" class="d-block ui-w-30 rounded-circle" height="30px" width="30px">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/AJAX/php/account.php"><i class="fas fa-user"></i> Profil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item " href="/AJAX/php/deconnexion.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                        </div>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item">
                        <a class="nav-link" href="#" tabindex="-1" aria-disabled="true"><?php echo $connected_user; ?></a>
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
        <nav class="breadcrumb ">
            <h6 class="breadcrumb-item active"><a href="/AJAX/php/sujets.php">Index</a> &nbsp;/&nbsp; <a href="/AJAX/php/post.php" class="font-weight-bold">Nom du forum</a> </h6>
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
                    <div class="card-header pl-0 pr-0">
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
                    <div class="card-body py-3">
                        <div class="row no-gutters align-items-center">
                            <div class="col"> <a href="/AJAX/php/thread.php" class="text-big" data-abc="true">Les origines de OuahJax</a>
                                <div class="text-muted small mt-1">Commencé il y a 5 jours &nbsp;·&nbsp; <a href="javascript:void(0)" class="text-muted" data-abc="true">David Gousserand</a></div>
                            </div>
                            <div class="d-none d-md-block col-4">
                                <div class="row no-gutters align-items-center">
                                    <div class="col-4">1</div>
                                    <div class="media col-8 align-items-center"> <img src="https://icons.iconarchive.com/icons/papirus-team/papirus-status/64/avatar-default-icon.png" alt="" class="d-block ui-w-30 rounded-circle">
                                        <div class="media-body flex-truncate ml-2">
                                            <div class="line-height-1 text-truncate">Il y a 1 jour</div> <a href="javascript:void(0)" class="text-muted small text-truncate" data-abc="true">par Random du net</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="m-0">
                    <div class="card-body py-3">
                        <div class="row no-gutters align-items-center">
                            <div class="col"> <a href="javascript:void(0)" class="text-big" data-abc="true">Comment gérer partiels et projet ?</a>
                                <div class="text-muted small mt-1">Commencé il y a 5 jours &nbsp;·&nbsp; <a href="javascript:void(0)" class="text-muted" data-abc="true">Jean Roland</a></div>
                            </div>
                            <div class="d-none d-md-block col-4">
                                <div class="row no-gutters align-items-center">
                                    <div class="col-4">0</div>
                                    <div class="media col-8 align-items-center"> <img src="https://icons.iconarchive.com/icons/papirus-team/papirus-status/64/avatar-default-icon.png" alt="" class="d-block ui-w-30 rounded-circle">
                                        <div class="media-body flex-truncate ml-2">
                                            <div class="line-height-1 text-truncate">Il y a 1 jour</div> <a href="javascript:void(0)" class="text-muted small text-truncate" data-abc="true">by Hacker du turfu</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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