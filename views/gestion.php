<?php session_start() ?>
<!--<!DOCTYPE html>-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="static/css/bootstrap.css">
    <link rel="stylesheet" href="static/css/bootstrap-grid.css">
    <link rel="stylesheet" href="static/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="static/css/animate.css">
    <title>acceuil</title>
</head>
<style>
    .intro {
        background-color: rgba(255, 255, 255, 0.7);
        margin: 0 auto;
    }

    .disabled {
        cursor: not-allowed;
        pointer-events: none;
    }

    .vertical-divider {

        width: 1px !important;
        border: 1px solid black !important;
        height: 25vh;
        margin: 0 auto !important;
        max-height: 100% !important;
    }

    #profilPic {
        max-width: 100%;
        height: auto;
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

    body {
        background: url('static/img/construction-plan-calculator-hard-hat-project-isto.jpg') center rgba(2555, 2555, 2555, 0.7);
        /*background-color: rgba(2555, 2555, 2555, 0.7);*/
        background-size: cover;
    }

    .col-md-6 > form {
        background-color: rgba(255, 255, 255, 0.5);
    }

    .gestionForms {
        padding: 6vh;
        box-shadow: -10px -10px 10px rgba(0, 0, 0, 0.8);
    }

    .result {
        background-color: rgba(200, 255, 200, 0.5);
        box-shadow: 10px -10px 10px rgba(0, 0, 0, 0.8) !important;
        padding-bottom: 0;
    }

    .brand-site {
        height: 30px;
        width: 30px;
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
        border-top: solid 3px rgba(0, 0, 0, 0.6);
    }

    .nav-link {
        color: #000 !important;
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
                <a class="navbar-brand mr-lg-5" id="profil" href="#"><?= $_SESSION['username'] ?> <img id="profilPic"
                                                                                                       src="<?= $_SESSION['image'] ?>"
                                                                                                       class="brand-site img img-fluid "/>
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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="intro col-md-12 offset-1">
                    <div class="row">
                        <div class="offset-1 col-md-4 offset-1">
                            <h4>
                                probleme avec le contremaitre ou le maitre de chantier ?
                                quoi? encore sur les prix des materiaux de construction ?
                                avez vous des doutes ? voulez-vous des avis d'expert ?
                                IsO-batiment est la pour vous...
                            </h4>
                        </div>
                        <div class="vertical-divider"></div>
                        <div class="offset-1 col-md-4 offset-1 ">
                            <h5>
                                Nous vous proposons d'estimer la quantite de sable, de ciment, de gravier, de bois,etc..
                                dont vous ave besoin pour votre construction et ceux gratuitement notre algorithm a eter
                                concus et verifier par des experts dans le domaine il est donc fiable a 80%!!!!
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <p class="text-lg-center">veuillez remplir ce formulaire pour avoir le devis de votre batiment</p>
                </div>
                <div class="col-md-6 animated bounceInLeft">
                    <h2 class="text-lg-center">Formulaire</h2>

                    <form class="form gestionForms" id="outil" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="etage">Dimension</label>
                            <select class="custom-select  fields" aria-describedby="dimension_help" name="etage"
                                    id="etage">
                                <option selected value="1">Rais de chausser</option>
                                <option value="2">R+1</option>
                                <option value="3">R+2</option>
                                <option value="4">R+3</option>
                            </select>
                            <small id="dimension_help" class="text-muted">selectionner le nombre d'etage que vous
                                souhaiter construire
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="piece">Nombre de pieces</label>
                            <select class="custom-select  fields" aria-describedby="piece_help" name="piece" id="piece">
                                <option selected value="4">4 pieces</option>
                                <option value="5">5 pieces</option>
                                <option value="6">6 pieces</option>
                                <option value="7">7 pieces</option>
                            </select>
                            <small id="piece_help" class="text-muted">selectionner le nombre de pieces que vous
                                souhaiter construire par etage
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="taille">superficie en m2</label>
                            <input type="number" class="form-control fields" value="50" step="50" name="superficie"
                                   aria-describedby="superficie_help" id="taille">
                            <small id="superficie_help" class="text-muted">selectionner la superficie du batiment que
                                vous souhaiter construire en m2
                            </small>
                        </div>
                        <input type="text" id="action" hidden readonly name="action" value="insert">
                        <?php if (!empty($_SESSION)): ?>
                            <input type="submit" class="btn btn-outline-success btn-block" id="valider"
                                   value="ENREGISTRER LES DONNES">
                        <?php else: ?>
                            <input type="submit" class="btn btn-outline-success btn-block disabled" id="valider"
                                   value="ENREGISTRER LES DONNES">
                        <?php endif ?>
                    </form>
                </div>
                <div class="col-md-6 animated bounceInRight">
                    <h2 class="text-lg-center">Resultat</h2>

                    <div class="result gestionForms">
                        <div class="form-group">
                            <label for="sable">sable</label>
                            <input type="text" name="sable" id="sable" class="form-control" readonly disabled
                                   aria-describedby="aide_sable">
                            <small id="aide_sable" class="text-muted">quantite de sable en tonnes</small>
                        </div>
                        <div class="form-group">
                            <label for="ciment">ciment</label>
                            <input type="text" name="ciment" id="ciment" class="form-control" readonly disabled
                                   placeholder=""
                                   aria-describedby="ciment_help">
                            <small id="ciment_help" class="text-muted">quantite de ciment en tonnes</small>
                        </div>
                        <div class="form-group">
                            <label for="gravier">gravier</label>
                            <input type="text" name="gravier" id="gravier" class="form-control" readonly disabled
                                   placeholder=""
                                   aria-describedby="gravier_help">
                            <small id="gravier_help" class="text-muted">quantiter de gravier en tonnes</small>
                        </div>
                        <div class="form-group">
                            <label for="bois">Bois</label>
                            <input type="text" name="bois" id="bois" class="form-control" readonly disabled
                                   placeholder=""
                                   aria-describedby="bois_help">
                            <small id="bois_help" class="text-muted">quantite de bois en tonnes</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="reussite" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo !empty($_SESSION) ? $_SESSION['username'] : 'utilisateur' ; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <h2 style="font-weight: bolder;font-size: 10vh ;">FELICITATION</h2>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary reload" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary reload">Save</button>
            </div>
        </div>
    </div>
</div>

<script src="static/js/jquery-3.3.1.min.js"></script>
<script src="static/js/bootstrap.js"></script>
<script src="static/js/bootstrap.bundle.js"></script>
<script src="static/js/jquery.validate.min.js"></script>
<script src="static/js/all.js"></script>
<script>
    $(function () {

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

        let cimentCal = function (dim=1, piece=1, taille=50) {
            let ciment = ((dim * taille) * 0.002) + ((piece / taille) * 0.02)
            return ciment
        }
        let sableCal = function (dim=1, piece=1, taille=50) {
            let sable = ((dim * taille) * 0.00005) + ((piece / taille) * 0.001) + (taille * 0.0001)
            return sable
        }
        let gravierCal = function (dim=1, piece=1, taille=50) {
            let gravier = ((dim / taille ) * 0.00001) + ((piece / taille) * 0.00002) + ((taille * 0.005) / 3)
            return gravier
        }
        let boisCal = function (dim=1, piece=1, taille=50) {
            let bois = ((dim / taille) * 0.002) + ((piece / taille) / 2) + ((taille * 0.003) * 0.00009)
            return bois
        }
        $('.fields').on('change', function (e) {

            let dim = $('#etage').val()
            let piece = $('#piece').val()
            let taille = $('#taille').val()
            $('#sable').val(sableCal(dim, piece, taille) + ' T')
            $('#ciment').val(cimentCal(dim, piece, taille) + ' T')
            $('#gravier').val(gravierCal(dim, piece, taille) + ' T')
            $('#bois').val(boisCal(dim, piece, taille) + ' T')

        })
        $('#valider').on('click', function (e) {
            e.preventDefault()
            let sable = $('#sable').val()
            let ciment = $('#ciment').val()
            let gravier = $('#gravier').val()
            let bois = $('#bois').val()
            let data={
                sable:sable.substring(0, sable.length - 1),
                ciment:ciment.substring(0,ciment.length -1) ,
                gravier:gravier.substring(0,gravier.length -1),
                bois:bois.substring(0,bois.length -1),
                action:$('#action').val()
            }
            $.ajax({
                url:'../controller/gestion_controller.php',
                type:'POST',
                dataType:'json',
                data:data,
                success:function(result){
                    $('#successModal').modal('show')
                },
                error:function(result){
                    var alert = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" \><button type=\"button\"  data-dismiss=\"alert\" aria-label=\"alert\"> <span aria-hidden=\"true\">\&times;</span></button> \<a href=\"#\" class=\"alert-link\">impossible de sauvegarder vos information </div>"
                    $(alert).insertBefore('.container-fluid')
                }
            })
        })
        $('.reload').on('click',function(e){
            e.preventDefault();
            window.location.reload(true)
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