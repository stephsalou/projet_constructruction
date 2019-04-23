<?php
session_start();
if (empty($_SESSION)) {
    header('Location:login.php');
}

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>test</title>
    <link rel="stylesheet" href="../static/css/bootstrap.css">
    <link rel="stylesheet" href="../static/css/bootstrap-grid.css">
    <link rel="stylesheet" href="../static/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="../static/css/all.min.css">
    <link rel="stylesheet" href="../static/css/animate.css">
    <link rel="stylesheet" href="../static/css/ihover.css">
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
    <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
</head>
<body>
<style>
    html, body {
        margin: 0;
        width: 100%;
        height: 100%;
        position: relative;
    }

    #map {
        position: absolute;
        top: 35px;
        bottom: 25px;
        right: 25px;
        left: 25px;
        box-shadow: 0 4px 16px 0 black;
    }

    #map > div {
        position: absolute;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
    }

    #map.show-message {
        pointer-events: none;
    }

    #map .map-overlay {
        display: none;
        z-index: 2;
    }

    #map.show-message .map-overlay {
        display: block;
        background: rgba(0,0,0,0.5);
        text-align: center;
        color: #eee;
        text-shadow: 0 -1px 1px black;
    }

    .center {
        width: 100%;
        height: 100%;
        display: table;
        text-align: center;
    }

    .center > div {
        display: table-cell;
        vertical-align: middle;
    }

    .leaflet-marker-icon,
    .leaflet-marker-shadow {
        -webkit-transition: margin 0.2s;
        -moz-transition: margin 0.2s;
        -o-transition: margin 0.2s;
        transition: margin 0.2s;
    }

    .map-container {
        background-image: url('https://dl.dropbox.com/u/14898/Photos/leaflet-screenshot.png');
        background-size: cover;
    }
    tr{
        height: 5vh !important;
    }
    .userProfilPics{
        height:auto !important;
        max-width: 100% !important;
    }
</style>
<header>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item mr-3">
            <h4 class="nav-brand">ISO-BaT</h4>
        </li>
        <li class="nav-item">
            <a class="nav-link " id="userAdmin-tab"  href="index.php" >administration utilisateur</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="gestionAdmin-tab"  href="index.php" >gestion de materiels</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" id="gestionAdmin-tab" href="admin_map.php" >gestion de materiels</a>
        </li>
        <li class="nav-item ml-4">
            <button class="btn btn-block btn-outline-danger" id="deconnexion" value="logout">deconnexion</button>
        </li>

    </ul>
</header>
<div id="map">
    <div class="map-overlay"></div>
    <div class="map-container"></div>
</div>
<script src="../static/js/jquery-3.3.1.min.js"></script>
<script src="../static/js/bootstrap.min.js"></script>
<script src="../static/js/bootstrap.bundle.js"></script>
<script src="../static/js/all.js"></script>
<script>

    var func;
    $(function(){
        // Animated marker via https://bl.ocks.org/4284949
        func = function setStatus(){
            console.log('reel')
            let id=$(this).data('markerId');
            let val=$(this).checked();
            if(val){
                $.ajax({
                    url:'../../controller/admin_map_controller.php',
                    type:'POST',
                    dataType:'json',
                    data:{action:'success',markerId:id},
                    success:function(data){
                        window.location.reload()
                    },
                    error:function(err){
                        alert('erreur systeme')
                    }
                })
            }else if(!val){
                $.ajax({
                    url:'../../controller/admin_map_controller.php',
                    type:'POST',
                    dataType:'json',
                    data:{action:'remove',markerId:id},
                    success:function(data){
                        window.location.reload()
                    },
                    error:function(err){
                        alert('erreur systeme')
                    }
                })
            }
        }
        L.Marker.prototype.animateDragging = function () {

            var iconMargin, shadowMargin;

            this.on('dragstart', function () {
                if (!iconMargin) {
                    iconMargin = parseInt(L.DomUtil.getStyle(this._icon, 'marginTop'));
                    shadowMargin = parseInt(L.DomUtil.getStyle(this._shadow, 'marginLeft'));
                }

                this._icon.style.marginTop = (iconMargin - 15) + 'px';
                this._shadow.style.marginLeft = (shadowMargin + 8) + 'px';
            });

            return this.on('dragend', function () {
                this._icon.style.marginTop = iconMargin + 'px';
                this._shadow.style.marginLeft = shadowMargin + 'px';

            });
        };

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

        Map.prototype.setCircle = function (latLng, meters) {
            if (!this.circle) {
                this.circle = L.circle(latLng, meters, {
                    color: 'red',
                    fillColor: '#f03',
                    fillOpacity: 0.3
                }).addTo(this.map);
            }
            else {
                this.circle.setLatLng(latLng);
                this.circle.setRadius(meters);
                this.circle.redraw();
            }
            this.map.fitBounds(this.circle.getBounds());
        };

        Map.prototype.setLatLng = function (latLng) {
            this.lat = latLng.lat;
            this.lng = latLng.lng;

            if (this.circle) {
                this.circle.setLatLng(latLng);
            }
        };

        Map.prototype.centerOnLocation = function (lat, lng) {

            var self = this;

            this.lat = lat;
            this.lng = lng;

            if (!this.marker) {
                this.marker = L.marker([this.lat, this.lng], {
                    draggable: false
                });

                this.marker.on('drag', function (event) {
                    self.setLatLng(event.target.getLatLng());
                });

                this.marker
                    .animateDragging()
                    .addTo(this.map);
            }

            this.map.setView([this.lat, this.lng], 16);
            this.setCircle([this.lat, this.lng], this.milesToMeters(0.1));
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
                    //error(positionError.message);
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


        // clear than temporary background image
        $('.map-container').css('background', 'transparent');

        var map = new Map('#map', 51.505, -0.09);

        map.showMessage('<p><span>recuperation de votre position.</span><br /><br />' + '<span>verifier que vous avez autoriser l\'api a obtenir votre position.</span></p>');
        map.getCurrentLocation(function (latLng) {
            map.centerOnLocation(latLng.lat, latLng.lng);
            map.dismissMessage();
        }, function (errorMessage) {
            map.showMessage('<p><span>Location Error:</span><br /><br />'
                + '<span>' + errorMessage + '</span></p>');
        });
        //ajax get coord
        $.ajax({
            type:'POST',
            dataType:'json',
            url:'../../controller/map_controller.php',
            data:{action:'selectAll'},
            success:function(response){
                let data=response.data;
                if(data.length!=0){
                    data.forEach(function(user){
                        if (user.status == 0) {
                            console.dir(user)
                            let invalideIcon = L.icon({
                                iconUrl: '../static/img/maps_icons/icon-3.png',
                                iconSize: [50, 50]
                            })
                            let json = {
                                lng:parseFloat(user.lng),
                                lat:parseFloat(user.lat)
                            }
                            let form =`<form class=\"form-inline\" id=\"valider\" method="post" action="mapStatus.php"> <div class=\"form-group\"> <div class=\"form-check form-check-inline\"> <label class=\"form-check-label\">enregistrer ma position<input name='action' id='action' class='btn btn-outline-success btn-sm' type='submit'  value='confirmer'> <input type="text" name="validate"  hidden readonly value="${user.id}"> </label> </div></div> </form>`
                            let markerOptions = {
                                title: form,
                                clickable: true,
                                draggable: false,
                                icon: invalideIcon
                            }
                            let mark = L.marker([json.lat, json.lng], markerOptions);
                            L.marker([json.lat, json.lng], markerOptions).addTo(map.map).bindPopup(mark.options.title).openPopup();
                        }else{
                            console.dir(user)
                            let valideIcon = L.icon({
                                iconUrl: '../static/img/maps_icons/icone_verte_home.png',
                                iconSize: [50, 50]
                            })
                            let json = {
                                lng:parseFloat(user.lng),
                                lat:parseFloat(user.lat)
                            }
                            let form = `<form class="form-inline" id=\"devalider\" method="post" action="mapStatus.php" > <div class="form-group"> <div class="form-check form-check-inline"> <label class="form-check-label">retire le terrain <input type='checkbox' class='form-control status' name='status' value='true' checked > </label> </div></div> <button class='btn btn-outline-warning deleteCoord' type='submit' form='devalider' id="deleteCoord" name='delete' value="${user.id}">supprimer</button></form>`;
                            let markerOptions = {
                                title: form,
                                clickable: true,
                                draggable: false,
                                icon: valideIcon
                            }
                            let mark = L.marker([json.lat, json.lng], markerOptions);
                            console.dir(mark)
                            L.marker([json.lat, json.lng], markerOptions).addTo(map.map).bindPopup(mark.options.title).openPopup();
                        }
                    })
                }else{
                    console.log('erreur systeme')
                }
            },
            error:function(err){
                alert(err)
            }
        })
        $('#action').on('click',function(e){
            e.preventDefault()
            let latitude=map.lat;
            let longitude=map.lng;
            $.ajax({
                type:'POST',
                url:'../controller/map_controller.php',
                dataType:'json',
                data:{action:'insert',lat:latitude,lng:longitude},
                success:function(data){
                    window.location.reload()
                },
                error:function(){
                    alert('error')
                }
            })
        })
        /* $.ajax({
         type: 'POST',
         url: '../../controller/map_controller.php',
         dataType: 'json',
         data: {action: 'selectAll'},
         success: function (data) {
         let Mdata = data.data
         if (Mdata.length != 0) {
         Mdata.forEach(function (user) {
         if (user.status == 0) {
         let custonIcon = L.icon({
         iconUrl: '../static/img/maps_icons/icon-3.png',
         iconSize: [50, 50]
         })
         let json = {
         lng:parseFloat(user.lng),
         lat:parseFloat(user.lat)
         }
         let form = `<form class="form-inline"> <div class="form-group"> <div class="form-check form-check-inline"> <label class="form-check-label">valider le terrain <input type='checkbox' class='form-control' class="status" name='status' data-markerId="${user.id}" value='true'  > </label> </div></div> </form><button class='btn btn-outline-warning deleteCoord' name='delete' value="${user.id}">supprimer</button>`;
         let markerOptions = {
         title: form,
         clickable: true,
         draggable: false,
         icon: custonIcon
         }
         let mark = L.marker([user.lat, user.lng], markerOptions);
         L.marker([json.lat, json.lng], markerOptions).addTo(map.map).bindPopup(mark.options.title).openPopup();
         } else {
         let customIcon = L.icon({
         iconUrl: '../static/img/maps_icons/icone_verte_home.png',
         iconSize: [50, 50]
         })
         let json = {
         lng:parseFloat(user.lng),
         lat:parseFloat(user.lat)
         }
         let form = `<form class="form-inline"> <div class="form-group"> <div class="form-check form-check-inline"> <label class="form-check-label">retire le terrain <input type='checkbox' class='form-control status' data-markerId="${user.id}" name='status' value='true' checked > </label> </div></div> </form><button class='btn btn-outline-warning deleteCoord' name='delete' value="${user.id}">supprimer</button>`;
         let markerOptions = {
         title:form,
         clickable: true,
         draggable: false,
         icon: customIcon
         };

         let mark = L.marker([json.lat, json.lng], markerOptions);
         L.marker([json.lat, json.lng], markerOptions).addTo(map.map).bindPopup(mark.options.title).openPopup();
         }
         })
         }else {
         console.log('donnes vide')
         }
         },
         error: function () {
         alert('error')
         }
         })*/

        $('#deleteCoord').on('click',function(e){
            e.preventDefault()
            console.log('sauvage')
            let id=$(this).val()
            $.ajax({
                url:'../../controller/admin_map_controller.php',
                type:'POST',
                dataType:'json',
                data:{action:'delete',markerId:id},
                success:function(data){
                    window.location.reload()
                },
                error:function(err){
                    alert('erreur systeme')
                }
            })
        })
        $(".leaflet-marker-icon").on('click',function(e){
            alert('click')
        })
        $('#devalider').on('submit',function(e){
            e.preventDefault()
            alert('devalider')
        })
        $('form').on('submit',function(e){
            e.preventDefault()
            alert('submit')
        })
        $('#deconnexion').on('click', function (e) {
            e.preventDefault()
            let logout = {
                logout: true
            }
            $.ajax({
                type: 'GET',
                url: '../../controller/admin_controller.php',
                dataType: 'json',
                data: logout,
                success: function (result) {
                    if (result) {
                        window.location.reload()
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
    })
</script>
</body>
</html>