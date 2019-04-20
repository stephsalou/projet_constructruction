<?php
session_start();
if (empty($_SESSION)) {
    header('Location:connexion.php');
}
?>

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
    <link rel="icon" type="icon/png" href="static/img/maps_icons/icon-1.png">
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css"/>
    <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
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

    footer {
        background: url("static/img/construction_header.jpg") center;
        -webkit-background-size: cover;
        background-size: cover;
    }

    footer {
        background-color: #222;
        color: #fff;
        border-top: solid 3px rgba(0, 0, 0, 0.6);
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

    .profilPics {
        width: 100% !important;
        max-width: 100%;
        height: auto;
        border: outset 6px ivory;
        /* -webkit-border-radius: 100% !important;
        -moz-border-radius: 100% !important;
        border-radius: 100% !important; */
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
    .outils{
        background-color: hsl(79deg, 29%, 81%);
        height:100%;
        max-height: auto;
        padding-bottom: 0px;
    }

    /*map style*/
    #map {
        /*position: absolute;*/
        margin: 0 auto;
        top: 35px;
        bottom: 25px;
        right: 25px;
        height: 80vh;
        width: 150vh;
        max-width: 100%;
        left: 25px;
        box-shadow: 0 4px 16px 0 black;
    }

    #map > div {
        /*position: absolute;*/
        /*top: 0;*/
        max-width: 100%;
        width: 100%;
        height: 100%;
        z-index: 0;
    }

    #map.show-message {
        pointer-events: none;
    }

    #map.map-overlay {
        display: none;
        z-index: 2;
    }

    #map.show-message .map-overlay {
        display: block;
        background: rgba(0, 0, 0, 0.5);
        text-align: center;
        color: #eee;
        text-shadow: 0 -1px 1px black;
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
                <form class="form-inline my-5 my-lg-0">
                    <div class="row">
                        <div class="input-group col-md-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="email"><i class="fa fa-user-circle"
                                                                             aria-hidden="true"></i> </span>
                            </div>
                            <input class="form-control" type="text" placeholder="put your mail"
                                   aria-label="Recipient'semail" aria-describedby="email">
                        </div>
                        <div class="input-group col-md-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="password"> <i class="fa fa-user-secret"
                                                                                 aria-hidden="true"></i> </span>
                            </div>
                            <input class="form-control" type="password" placeholder="put your password"
                                   aria-label="Recipient'spassword" aria-describedby="password">
                        </div>
                        <input type="text" hidden readonly name="action" value="connex">
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


<div class="container">
    <div class="row">
        <div class="col-md-5 animated fadeInLeftBig ">
            <div id="map">
                <div class="map-overlay"></div>
                <div class="map-container"></div>
            </div>
        </div>
        <div class="col-md-4 animated fadeInDownBig">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h5 class="display-5">Email: <?= $_SESSION['email'] ?></h5>

                    <p class="lead">username :<?= $_SESSION['username'] ?> </p>
                    <hr class="my-2">
                    <img src="<?= $_SESSION['image'] ?>" class="img img-fluid profilPics mb-3" alt="">

                    <p class="lead">
                        <button class="btn btn-primary btn-lg btn-block" role="button">Modifier votre profil</button>
                    </p>
                    <p class="lead">
                        date d'inscription:<?= $_SESSION['date_inscrit'] ?>
                    </p>
                </div>
                <input id="userId" value="<?= $_SESSION['id'] ?>" disabled readonly hidden/>
            </div>
        </div>
        <div class="col-md-3 outils animated fadeInRightBig ">

        </div>
    </div>
</div>


<script src="static/js/jquery-3.3.1.min.js"></script>
<script src="static/js/bootstrap.js"></script>
<script src="static/js/bootstrap.bundle.js"></script>
<script src="static/js/jquery.validate.min.js"></script>
<script src="static/js/all.js"></script>
<script>
    ///map script///
    ////  static simple map
    var Map = function (elem, lat, lng) {
        this.$el = $(elem);
        this.$overlay = this.$el.find('.map-overlay');
        this.$map = this.$el.find('.map-container');
        this.init(lat, lng);


    };
    Map.prototype.init = function (lat, lng) {

        this.lat = lat;
        this.lng = lng;

        this.map = L.map(this.$map[0]).setView([lat, lng], 13);

        var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
        var mapTiles = new L.TileLayer(osmUrl, {
            attribution: 'Map data &copy; '
            + '<a href="http://openstreetmap.org">OpenStreetMap</a> contributors, '
            + '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
            maxZoom: 18
        });

        this.map.addLayer(mapTiles);
    };
    Map.prototype.setLatLng = function (latLng) {
        this.lat = latLng.lat;
        this.lng = latLng.lng;

        if (this.circle) {
            this.circle.setLatLng(latLng);
        }
    };
    Map.prototype.getCurrentLocation = function (success, error) {

        var self = this;

        var onSuccess = function (lat, lng) {
            success(new L.LatLng(lat, lng));
        };

        // get location via geoplugin.net.
        // Typically faster than browser's geolocation, but less accurate.
        var geoplugin = function () {
            jQuery.getScript('http://www.geoplugin.net/javascript.gp', function () {
                onSuccess(geoplugin_latitude(), geoplugin_longitude());
            });
        };

        // get location via browser's geolocation.
        // Typically slower than geoplugin.net, but more accurate.
        var navGeoLoc = function () {
            navigator.geolocation.getCurrentPosition(function (position) {
                success(new L.LatLng(position.coords.latitude, position.coords.longitude));
            }, function (positionError) {
                geoplugin();
                error(positionError.message);
            });
        };

        if (navigator.geolocation) {
            navGeoLoc();
        }
        else {
            geoplugin();
        }
    };

    Map.prototype.dismissMessage = function () {
        this.$el.removeClass('show-message');
        this.$overlay.html('');
    };

    Map.prototype.showMessage = function (html) {
        this.$overlay.html('<div class="center"><div>' + html + '</div></div>');
        this.$el.addClass('show-message');
    };

    // Conversion Helpers

    Map.prototype.milesToMeters = function (miles) {
        return miles * 1069;
    };

    jQuery(function ($) {

        // clear than temporary background image
        $('.map-container').css('background', 'transparent');

        var map = new Map('#map', 51.505, -0.09);

        map.showMessage('<p><span>Acquiring Current Location.</span><br /><br />'
            + '<span>Please ensure the app has permission to access your location.</span></p>');

        map.getCurrentLocation(function (latLng) {
            map.dismissMessage();
        }, function (errorMessage) {
            map.showMessage('<p><span>Location Error:</span><br /><br />'
                + '<span>' + errorMessage + '</span></p>');
        });

        var s = $('select').on('change', function (e) {
            var value = $(this).val();
            var meters = map.milesToMeters(value);
            map.setCircle([map.lat, map.lng], meters);
        });
        $(function () {
// ajax recuperation marker user position
            let id = $('#userId').val()
            $.ajax({
                type: 'POST',
                url: '../controller/map_controller.php',
                dataType: 'json',
                data: {action: 'selectUser', id: id},
                success: function (data) {
                    let Mdata = data.data
                    if (Mdata.length != 0) {
                        Mdata.forEach(function (user) {
                            if (user.status == 0) {
                                let custonIcon = L.icon({
                                    iconUrl: 'static/img/maps_icons/icon-3.png',
                                    iconSize: [50, 50]
                                })
                                let json = {
                                    'lng': user.lng,
                                    'lat': user.lat
                                }
                                let markerOptions = {
                                    title: 'en attente de confirmation',
                                    clickable: true,
                                    draggable: false,
                                    icon: custonIcon
                                }
                                let mark = L.marker([user.lat, user.lng], markerOptions);
                                console.dir(mark)
                                L.marker([json.lat, json.lng], markerOptions).addTo(map.map).bindPopup(mark.options.title).openPopup();
                                let LGrp = L.layerGroup([mark])
                                LGrp.eachLayer(function (obj) {
                                    if (obj instanceof L.Marker) { // test if the object is a marker
                                        // get the position of the marker with getLatLng
                                        // and draw a circle at that position

                                        L.circle(obj.getLatLng(), 35, {
                                            color: 'blue',
                                            fillColor: 'blue'
                                        }).addTo(map.map);
                                    }
                                })
                            } else {
                                let custonIcon = L.icon({
                                    iconUrl: 'static/img/maps_icons/icone_verte_home.png',
                                    iconSize: [50, 50]
                                })
                                let json = {
                                    'lng': user.lng,
                                    'lat': user.lat
                                }
                                let markerOptions = {
                                    title: user.pseudo,
                                    clickable: true,
                                    draggable: false,
                                    icon: custonIcon
                                }
                                let mark = L.marker([user.lat, user.lng], markerOptions);
                                console.dir(mark)
                                L.marker([json.lat, json.lng], markerOptions).addTo(map.map).bindPopup(mark.options.title).openPopup();
                                let LGrp = L.layerGroup([mark])
                                LGrp.eachLayer(function (obj) {
                                    if (obj instanceof L.Marker) { // test if the object is a marker
                                        // get the position of the marker with getLatLng
                                        // and draw a circle at that position

                                        L.circle(obj.getLatLng(), 35, {
                                            color: 'blue',
                                            fillColor: 'blue'
                                        }).addTo(map.map);
                                    }
                                })
                            }
                        })
                    } else {
                        console.log('donnes vide')
                    }
                },
                error: function () {
                    alert('error')
                }
            })
            //////user script//

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


        })
//ajax recuperation des probabiliter de materiaux
        let id=$('#userId').val()
        $.ajax({
            type:'GET',
            url:'../controller/gestion_controller.php',
            dataType:'json',
            data:id,
            success:function(result){
                let i=1
                console.dir(result)
                result.data.forEach(function(outils){
                  let p="<p> projet-"+i+"</p><p> sable: "+outils.sable+" T </p><p> ciment: "+outils.ciment+" T</p><p> gravier: "+outils.gravier+" T</p><p> bois: "+outils.bois+" T</p>"
                  $(p).appendTo('.outils')
                    console.log('fuck')
                    i++;
                })
            },
            error:function(err){
                console.dir(err)
                console.log(err.message)
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
