<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="static/css/bootstrap.css">
    <link rel="stylesheet" href="static/css/bootstrap-grid.css">
    <link rel="stylesheet" href="static/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="static/css/all.min.css">
    <link rel="stylesheet" href="static/css/animate.css">
    <link rel="stylesheet" href="static/css/ihover.css">
    <title>acceuil</title>
</head>
<style>

    header::after {
        content: '';
        clear: both;

    }

    .nav-link {
        color: #000 !important;
    }

    .navbar {
        background: url("static/img/construction_header.jpg") center;
        -webkit-background-size: cover;
        background-size: cover;
        color: #000;
        font-weight: 600;
        border-bottom: solid 3px rgba(0, 0, 0, 0.6);
    }

    .brand-site {
        height: 20px;
        width: 20px;
    }
    /*#profilPic {
        max-width: 100%;
        height: auto;
    }*/
</style>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">IsO BATIMENT <img src="static/img/ankh.png" class="brand-site"/> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active ">
                    <a class="nav-link" href="index.php">acceuil </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="gestion.php">outils de gestion</a>
                </li>
                <li class="nav-item" tabindex="0" data-toggle="popover" data-trigger="blur"
                    title="prenium veuillez vous connecter" data-content="contenu reservver au utilisateur prenium">
                    <?php if (empty($_SESSION)): ?>
                        <a class="nav-link disabled " href="position.php"> outils de localisation</a>
                    <?php else: ?>
                        <a class="nav-link" href="position.php"> outils de localisation</a>
                    <?php endif ?>
                </li>
            </ul>
            <?php if (empty($_SESSION)): ?>
                <form id="connex" class="form-inline my-5 my-lg-0">
                    <div class="row">
                        <div class="input-group col-md-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="email"><i class="fa fa-user-circle"
                                                                             aria-hidden="true"></i> </span>
                            </div>
                            <input class="form-control" form="connex" name="email" type="text"
                                   placeholder="put your mail"
                                   aria-label="Recipient'semail" aria-describedby="email">
                        </div>
                        <div class="input-group col-md-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="password"> <i class="fa fa-user-secret"
                                                                                 aria-hidden="true"></i> </span>
                            </div>
                            <input class="form-control" form="connex" name="password" type="password"
                                   placeholder="put your password"
                                   aria-label="Recipient'spassword" aria-describedby="password">
                        </div>
                        <input type="text" hidden readonly name="action" value="connex"/>
                        <input type="submit" class="btn btn-outline-dark col-md-4" value="CONNEXION">
                    </div>
                </form>
            <?php else: ?>
                <div class="ih-item circle effect11 left_to_right" id="ihover-effect">
                    <a class="navbar-brand mr-lg-5" id="profil" href="profil.php">
                        <div class="img">
                            <img id="profilPic" src="<?= $_SESSION['image'] ?>" class="brand-site img img-fluid " alt="img">
                        </div>
                        <div class="info">
                            <h3><?= $_SESSION['username'] ?></h3>
                        </div>
                    </a>
                </div>
               <!-- <a class="navbar-brand mr-lg-5" id="profil" href="profil.php"><?/*= $_SESSION['username'] */?> <img
                        id="profilPic" src="<?/*= $_SESSION['image'] */?>" class="brand-site img img-fluid "/>
                </a>-->

                <li class="nav-item dropdown" style="list-style: none; margin-right:25vh">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></a>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="profil.php">profil <i class="fa fa-user-circle"
                                                                             aria-hidden="true"></i> </a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" id="deconnexion">deconnexion <i
                                class="fas fa-door-open    "></i></a>
                    </div>
                </li>
            <?php endif ?>
        </div>
    </nav>
</header>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-6">

            <!-- normal -->
            <div class="ih-item square effect15 bottom_to_top"><a href="#">
                    <div class="img"><img src="static/img/architecture-construction-build-building-162557.jpeg"
                                          alt="img"></div>
                    <div class="info">
                        <h3>Heading here</h3>

                        <p>Description goes here</p>
                    </div>
                </a></div>
            <!-- end normal -->

        </div>
    </div>
    <script src="static/js/jquery-3.3.1.min.js"></script>
    <script src="static/js/bootstrap.js"></script>
    <script src="static/js/bootstrap.bundle.js"></script>
    <script src="static/js/jquery.validate.min.js"></script>
    <script src="static/js/all.js"></script>
</body>
</html>