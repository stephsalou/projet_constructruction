<?php session_start() ?>
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
    <link rel="stylesheet" href="static/brands.svg">
    <title>ACCEUIL</title>
</head>
<style>


    .container-fluid {
        background: url('static/img/Santé-et-sécurité-générale.jpg') center;
        background-size: cover;
    }

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

    footer {
        background: url("static/img/construction_header.jpg") center;
        -webkit-background-size: cover;
        background-size: cover;
    }

    .figure > img {
        border-radius: 100% !important;
        max-width: 100%;
        height: auto;
    }

    .carousel-item {
        height: 500px;
    }

    .carousel-caption > h5, .carousel-caption > p {
        color: #000;
        font-weight: bolder;
        font-family: "Times New Roman", Times, Baskerville, Georgia, serif;

    }

    .carousel-caption {
        background-color: rgba(255, 255, 255, 0.6);
        border-radius: 50%;
    }

    footer {
        background-color: #222;
        color: #fff;
        border-top: solid 3px rgba(0, 0, 0, 0.6);
    }

    #carousel-item-1 {
        background: url('static/img/Projects-Construction_1600x1066_1600_1066_80_s_c1_c_c.jpg') center;
        background-size: cover;
    }

    #carousel-item-2 {
        background: url('static/img/45964319_xxl.jpg') center;
        background-size: cover;
    }

    #carousel-item-3 {
        background: url('static/img/shutterstock_617032220.0.jpg') center;
        background-size: cover;
    }

    .brand-site {
        height: 30px;
        width: 30px;
    }

    #profilPic {
        max-width: 100%;
        height: auto;
        -webkit-border-radius: 100% !important;
        -moz-border-radius: 100% !important;
        border-radius: 100% !important;
    }
    .text_desc{
        color:#080808 ;
        font-weight: bold;
        background-color: rgba(255, 255, 255, 0.3);
    }
    #profil {
        color: #000;
        padding: 20px;
        font-weight: bolder;
        border: outset 6px #000;
        border-bottom-left-radius: 60%;
        border-top-right-radius: 60%;
        border-top-left-radius: 30%;
        border-bottom-right-radius: 30%;
    }
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
                <a class="navbar-brand mr-lg-5" id="profil" href="profil.php"><?= $_SESSION['username'] ?> <img
                        id="profilPic" src="<?= $_SESSION['image'] ?>" class="brand-site img img-fluid "/>
                </a>

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

<div id="carousel-1" class="carousel slide " data-ride="carousel">
    <ol class="carousel-indicators">
        <li class="active" data-target="#carousel-1" data-slide-to="0" aria-current="location"></li>
        <li data-target="#carousel-1" data-slide-to="1"></li>
        <li data-target="#carousel-1" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active" id="carousel-item-1">
            <img class="d-block w-100 img-fluid mx-auto" src="" alt="">

            <div class="carousel-caption d-none d-md-block">
                <h5>VOTRE EPANOUISSEMENT</h5>

                <p>NOTRE SATISFACTION</p>
            </div>
        </div>
        <div class="carousel-item" id="carousel-item-2">
            <img class="d-block w-100 img-fluid mx-auto " style="height:400px;" src="" alt="">

            <div class="carousel-caption d-none d-md-block">
                <h5>LES MEILLEURS DEALS</h5>

                <p>AU MEILLEUR PRIX</p>
            </div>
        </div>
        <div class="carousel-item" id="carousel-item-3">
            <img class="d-block w-100 img-fluid mx-auto" src="" alt="">

            <div class="carousel-caption d-none d-md-block">
                <h5>PLUS DE CONFUSION</h5>

                <p>MOINS DE CONFLITS</p>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carousel-1" data-slide="prev" role="button">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-1" data-slide="next" role="button">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="container-fluid animated zoomIn">
    <div class="row">

        <div class="col-md-6">
            <figure class="figure">
                <img class="figure-img img-fluid rounded m-auto"
                     src="static/img/architecture-construction-build-building-162557.jpeg" alt="">
            </figure>
        </div>
        <div class="col-md-6">
            <h3 class="title_desc">
                lorem ipsum sin dolor
            </h3>

            <p class="text_desc">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta delectus libero quam distinctio!
                Placeat nostrum eveniet aperiam dolorem maxime, soluta aliquid vel earum laudantium itaque ipsum,
                dolores veritatis cum. Unde. Lorem ipsum dolor sit amet, consectetur adipisicing elit. At aut beatae
                consectetur corporis deleniti et exercitationem hic ipsam ipsum molestias placeat possimus provident
                quas repellendus similique tempora temporibus tenetur, voluptatum!
            </p>
        </div>
        <div class="col-md-6">
            <h3 class="title_desc">
                lorem ipsum sin dolor
            </h3>

            <p class="text_desc">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta delectus libero quam distinctio!
                Placeat nostrum eveniet aperiam dolorem maxime, soluta aliquid vel earum laudantium itaque ipsum,
                dolores veritatis cum. Unde. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam commodi
                ducimus hic laborum mollitia soluta. Culpa debitis dignissimos, distinctio eius eos ex, excepturi
                impedit laudantium, nam quis quo ratione voluptate?
            </p>
        </div>
        <div class="col-md-6">
            <figure class="figure">
                <img src="static/img/bigstock-212076514-1200x801.jpg" class="figure-img img-fluid rounded m-auto"
                     alt="">
            </figure>
        </div>
    </div>

</div>


<script src="static/js/jquery-3.3.1.min.js"></script>
<script src="static/js/bootstrap.js"></script>
<script src="static/js/bootstrap.bundle.js"></script>
<script src="static/js/jquery.validate.min.js"></script>
<script src="static/js/all.js"></script>
<script>
    $('#deconnexion').on('click', function (e) {
        e.preventDefault()
        let logout = {
            logout: true
        }
        $.ajax({
            type: 'GET',
            url: '../controller/user_controller.php',
            dataType: 'json',
            data: logout,
            success: function (result) {
                if (result) {
                    window.location.reload(true)
                } else {
                    var alert = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" \><button type=\"button\"  data-dismiss=\"alert\" aria-label=\"alert\"> <span aria-hidden=\"true\">\&times;</span></button> \<a href=\"#\" class=\"alert-link\">impossible de vous deconnecter </div>"
                    $(alert).insertBefore('.container-fluid')
                }
            },
            error: function (e) {
                console.dir(e)
                var alert = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" \><button type=\"button\"  data-dismiss=\"alert\" aria-label=\"alert\"> <span aria-hidden=\"true\">\&times;</span></button> \<a href=\"#\" class=\"alert-link\">impossible de vous deconnecter </div>"
                $(alert).insertBefore('.container-fluid')
            }

        })
    })

    $('#connex').on('submit', function (e) {
        e.preventDefault()
        let formdata = $('#connex').serialize();
        $.ajax({
            type: 'post',
            url: '../controller/user_controller.php',
            dataType: 'json',
            data: formdata,
            success: function (data) {
                if (data.status) {
                    var alert = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" \><button type=\"button\"  data-dismiss=\"alert\" aria-label=\"alert\"> <span aria-hidden=\"true\">\&times;</span></button> \<a href=\"#\" class=\"alert-link\">" + data.message + "\</div>"
                    $(alert).insertBefore('.container-fluid')
                } else {
                    window.location.reload(true)

                }
            },
            error: function (data) {
                var alert = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" \><button type=\"button\"  data-dismiss=\"alert\" aria-label=\"alert\"> <span aria-hidden=\"true\">\&times;</span></button> \<a href=\"#\" class=\"alert-link\">impossible de vous connecter </div>"
                $(alert).insertBefore('.container-fluid')
            }

        })
    })
</script>
</body>
<footer>
    <div class="row">
        <div class=" col-md-5 offset-4">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Officiis fuga sed explicabo aut? Iusto ex at
            asperiores officiis, veniam tenetur explicabo voluptas. Repellat aut obcaecati cum exercitationem fuga
            provident veritatis!
        </div>
        <div class="col-md-3">
            <div class="row jusify">
                <span class="col-md-4"> <i class="fas fa-facebook-f    "></i> </span>
                <span class="col-md-4"> <i class="fas fa-twitter    "></i> </span>
                <span class="col-md-4"> <i class="fas fa-discord    "></i> </span>
            </div>
        </div>
    </div>
</footer>
</html>
