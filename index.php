<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./bootstrap/css/bootstrap.css" rel="stylesheet">

    <title>Forum Projet AJAX</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark" ">
        <a class=" navbar-brand" href="index.html">OuahJax</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample03">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">

                    <a class="nav-link" href="./index.php"><span><i class="fas fa-home"> </i></span class="sr-only"> Accueil</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="./php/sujets.php"><span><i class="fab fa-wpforms"></i></span> Forum</a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item ">
                    <a class="nav-link" href="./html/admin.html" tabindex="-1" aria-disabled="true">
                        <span><i class="fas fa-sign-in-alt"></i></span> Se connecter / Inscription</a>
                </li>
            </ul>
            <!--
            <input type="checkbox" id="switch" name="theme" />
            <label id="darkmode" for="switch"><span class="fas fa-sun"> / </span> <span class="fas fa-moon"></span></label>
            -->
        </div>
    </nav>

    <h1 id='title1'>Bienvenue sur OuahJax !</h1>

    <div class="container" style="margin-top: 2%;">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="card w-1">
                    <div class="card-body">
                        <h3 class="card-title"> <span class="fas fa-sitemap"></span> A propos du site</h3>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed vestibulum diam. Nullam a vulputate massa. Mauris tincidunt tortor et velit pellentesque gravida. Ut tempus sollicitudin nunc eu tempus. Aenean sagittis ante viverra ante malesuada, vel pharetra diam eleifend. Aliquam porta ante eget gravida tristique. Praesent eleifend enim a lorem.</p>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container" style="margin-top: 2%;">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="card w-1">
                    <div class="card-body">
                        <h3 class="card-title"> <span class="fas fa-sitemap"></span> Selection de sujets</h3>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed vestibulum diam. Nullam a vulputate massa. Mauris tincidunt tortor et velit pellentesque gravida. Ut tempus sollicitudin nunc eu tempus. Aenean sagittis ante viverra ante malesuada, vel pharetra diam eleifend. Aliquam porta ante eget gravida tristique. Praesent eleifend enim a lorem.</p>

                    </div>
                </div>
            </div>

        </div>
    </div>



    <script src="./bootstrap/css/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/bb5c883aee.js" crossorigin="anonymous"></script>

</body>

</html>