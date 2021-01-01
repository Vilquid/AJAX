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

        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse">
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
            <h6 class="breadcrumb-item active"><a href="/AJAX/php/sujets.php" class="font-weight-bold">Index</a></h6>
        </nav>

        <div class="row">
            <div class="col-12">
                <h2 class="h4 category mb-0 p-4 rounded-top text-light">Categorie</h2>
                <table class="table table-striped table-bordered ">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="forum-col">Forum</th>
                            <th scope="col">Sujets</th>
                            <th scope="col">Posts</th>
                            <th scope="col" class="last-post-col">Dernier Posts</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <h3 class="h5 mb-0"><a href="/AJAX/php/post.php">Nom du forum</a></h3>
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Velit, praesentium?</p>
                            </td>
                            <td>
                                <div>0</div>
                            </td>
                            <td>0</td>
                            <td>
                                <h4 class="h6 mb-0"><a href="#"> Nom du post</a></h4>
                                <div> par <a href="#">Nom de l'auteur</a></div>
                                <div> 03 Dec 2020, 16:20</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3 class="h5 mb-0"><a href="#">Nom du forum</a></h3>
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Velit, praesentium?</p>
                            </td>
                            <td>
                                <div>0</div>
                            </td>
                            <td>0</td>
                            <td>
                                <h4 class="h6 mb-0"><a href="#"> Nom du post</a></h4>
                                <div> par <a href="#">Nom de l'auteur</a></div>
                                <div> 03 Dec 2020, 16:20</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3 class="h5 mb-0"><a href="#">Nom du forum</a></h3>
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Velit, praesentium?</p>
                            </td>
                            <td>
                                <div>0</div>
                            </td>
                            <td>0</td>
                            <td>
                                <h4 class="h6 mb-0"><a href="#"> Nom du post</a></h4>
                                <div> par <a href="#">Nom de l'auteur</a></div>
                                <div> 03 Dec 2020, 16:20</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3 class="h5 mb-0"><a href="#">Nom du forum</a></h3>
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Velit, praesentium?</p>
                            </td>
                            <td>
                                <div>0</div>
                            </td>
                            <td>0</td>
                            <td>
                                <h4 class="h6 mb-0"><a href="#"> Nom du post</a></h4>
                                <div> par <a href="#">Nom de l'auteur</a></div>
                                <div> 03 Dec 2020, 16:20</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <script src="/AJAX/bootstrap/js/bootstrap.min.js"></script>
            <script src="https://kit.fontawesome.com/bb5c883aee.js" crossorigin="anonymous"></script>
</body>

</html>