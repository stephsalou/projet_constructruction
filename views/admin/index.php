<?php session_start();
if(empty($_SESSION)){
    header('Location:login.php');
}
if(isset($_GET)){
include '../../controller/config.inc.php';
require '../../database/database.php';
require '../../autoload/admin_autoload.php';
autoload::register();
$db=database::connect();
$result=user::select_all_user($db,ADMIN_FILE_PATH);
$usercolumn=$result['column'];
$userData=$result['data'];
$result=map::selectJoin('materiaux','*',$db,null,ADMIN_FILE_PATH);
$gestionColumn=$result['column'];
array_splice($gestionColumn,5,1);
$gestionData=$result['data'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />  
   	<script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
    <link rel="stylesheet" href="../static/css/bootstrap.css">
    <link rel="stylesheet" href="../static/css/bootstrap-grid.css">
    <link rel="stylesheet" href="../static/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="../static/css/all.min.css">
    <link rel="stylesheet" href="../static/css/animate.css">
    <link rel="stylesheet" href="../static/css/ihover.css">
    <link rel="stylesheet" href="style.css">
    <title>acceuil</title>
</head>

 

<body>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item mr-3">
        <h4 class="nav-brand" >ISO-BaT</h4>
    </li>   
        <li class="nav-item">
          <a class="nav-link active" id="userAdmin-tab" data-toggle="tab" href="#userAdmin" role="tab" aria-controls="userAdmin" aria-selected="true">administration utilisateur</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="gestionAdmin-tab" data-toggle="tab" href="#gestionAdmin" role="tab" aria-controls="gestionAdmin" aria-selected="false">gestion de materiels</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="mapAdmin-tab" data-toggle="tab" href="#mapAdmin" role="tab" aria-controls="mapAdmin" aria-selected="false">administration Map</a>
        </li>
<li class="nav-item ml-4">
    <button class="btn btn-block btn-outline-danger" id="deconnexion" value="logout" >deconnexion</button>
</li>
</ul>
<header>
   
</header>
    <div class="container">
    <div class="row"> 
            
                  <div class="tab-content" id="conteneur">
                    <div class="tab-pane fade show active" id="userAdmin" role="tabpanel" aria-labelledby="userAdmin-tab">
                        <table class="table table-dark table-striped">
                            <thead class="thead-dark">

                                <tr>
                                    <?php foreach($usercolumn as $key => $value):?>
                                        <th><?=$value?></th>
                                    <?php endforeach ?>
                                    <th>options</th>
                                </tr>

                            </thead>
                            <tbody id="tbody-user">
                            <?php foreach($userData as $keys => $value):?>
                                <tr>
                                    <?php foreach($value as $key => $val):?>
                                    <?php if($key!='image'){ ?>
                                    <td><?=$val?></td>
                                    <?php }else{ ?>
                                    <td><img src="<?= $val ?>" alt="image utilisateur" style="height: 5vh;"  class="img img-fluid"></td>
                                    <?php }    ?>
                                <?php endforeach?>
                                    <td><button class="btn btn-outline-danger deleteUser" value="<?php $value['id']?>">supprimer</button></td>
                                </tr>
                            <?php endforeach?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="gestionAdmin" role="tabpanel" aria-labelledby="gestionAdmin-tab">
                        <table class="table table-light table-striped">
                            <thead class="thead-dark">

                            <tr>
                                <?php foreach($gestionColumn as $key => $value):?>
                                    <th><?=$value?></th>
                                <?php endforeach ?>
                                <th>options</th>
                            </tr>

                            </thead>
                            <tbody id="tbody-outil">
                            <?php foreach($gestionData as $keys => $value):?>
                                <tr>
                                    <?php foreach($value as $key => $val):?>
                                        <?php if($key!='image'){ ?>
                                            <td><?=$val?></td>
                                        <?php }else{ ?>
                                            <td><img src="<?= $val ?>" alt="image utilisateur" style="height: 5vh;"  class="img img-fluid"></td>
                                        <?php }    ?>
                                    <?php endforeach?>
                                    <td><button class="btn btn-outline-danger deleteOutil" value="<?php $value['id']?>">supprimer</button></td>
                                </tr>
                            <?php endforeach?>
                            </tbody>

                        </table>
                    </div>
                    <div class="tab-pane fade" id="mapAdmin" role="tabpanel" aria-labelledby="mapAdmin-tab">
                            <div id="map">
                                    <div class="map-overlay"></div>
                                    <div class="map-container"></div>        
                                </div>
                    </div>
                  </div>
        </div>
    </div>
    <script src="../static/js/jquery-3.3.1.min.js"></script>
    <script src="../static/js/bootstrap.min.js"></script>
    <script src="../static/js/bootstrap.bundle.js"></script>
    <script src="../static/js/jquery.validate.min.js"></script>
    <script src="../static/js/all.js"></script>
   <!-- <script src="script.js"></script>-->
    <script>
        // Animated marker via https://bl.ocks.org/4284949
        /*
         L.Marker.prototype.animateDragging = function () {

         var iconMargin, shadowMargin;

         this.on('dragstart', function () {
         if (!iconMargin) {
         iconMargin = parseInt(L.DomUtil.getStyle(this._icon, 'marginTop'));
         shadowMargin = parseInt(L.DomUtil.getStyle(this._shadow, 'marginLeft'));
         }

         this._icon.style.marginTop = (iconMargin - 15)  + 'px';
         this._shadow.style.marginLeft = (shadowMargin + 8) + 'px';
         });

         return this.on('dragend', function () {
         this._icon.style.marginTop = iconMargin + 'px';
         this._shadow.style.marginLeft = shadowMargin + 'px';
         });
         };*/

        var Map = function(elem, lat, lng) {
            this.$el = $(elem);
            this.$overlay = this.$el.find('.map-overlay');
            this.$map = this.$el.find('.map-container');
            this.init(lat, lng);


        };

        Map.prototype.init = function(lat, lng) {

            this.lat = lat;
            this.lng = lng;

            this.map = L.map(this.$map[0]).setView([lat, lng], 13);

            var osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
            var mapTiles = new L.TileLayer(osmUrl, {
                attribution: 'Map data &copy; '
                + '<a href="http://openstreetmap.org">OpenStreetMap</a> contributors, '
                + '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
                maxZoom: 18
            });

            this.map.addLayer(mapTiles);
        };

        /*Map.prototype.setCircle = function(latLng, meters) {
         if(!this.circle) {
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
         };*/

        Map.prototype.setLatLng = function(latLng) {
            this.lat = latLng.lat;
            this.lng = latLng.lng;

            if(this.circle) {
                this.circle.setLatLng(latLng);
            }
        };

        /*
         Map.prototype.centerOnLocation = function(lat, lng) {

         var self = this;

         this.lat = lat;
         this.lng = lng;

         if(!this.marker) {
         this.marker = L.marker([this.lat, this.lng], {
         draggable: true
         });

         this.marker.on('drag', function(event) {
         self.setLatLng(event.target.getLatLng());
         });

         this.marker
         .animateDragging()
         .addTo(this.map);
         }

         this.map.setView([this.lat, this.lng], 16);
         this.setCircle([this.lat, this.lng], this.milesToMeters(5));
         };
         */

        Map.prototype.getCurrentLocation = function(success, error) {

            var self = this;

            var onSuccess = function(lat, lng) {
                success(new L.LatLng(lat, lng));
            };

            // get location via geoplugin.net.
            // Typically faster than browser's geolocation, but less accurate.
            var geoplugin = function() {
                jQuery.getScript('http://www.geoplugin.net/javascript.gp', function() {
                    onSuccess(geoplugin_latitude(), geoplugin_longitude());
                });
            };

            // get location via browser's geolocation.
            // Typically slower than geoplugin.net, but more accurate.
            var navGeoLoc = function() {
                navigator.geolocation.getCurrentPosition(function(position) {
                    success(new L.LatLng(position.coords.latitude, position.coords.longitude));
                }, function(positionError) {
                    geoplugin();
                    //error(positionError.message);
                });
            };

            if(navigator.geolocation) {
                navGeoLoc();
            }
            else {
                geoplugin();
            }
        };

        Map.prototype.dismissMessage = function() {
            this.$el.removeClass('show-message');
            this.$overlay.html('');
        };

        Map.prototype.showMessage = function(html) {
            this.$overlay.html('<div class="center"><div>' + html + '</div></div>');
            this.$el.addClass('show-message');
        };

        // Conversion Helpers

        Map.prototype.milesToMeters = function(miles) {
            return miles * 1069;
        };

        jQuery(function($) {

            // clear than temporary background image
            $('.map-container').css('background', 'transparent');

            var map = new Map('#map', 51.505, -0.09);

            map.showMessage('<p><span>Acquiring Current Location.</span><br /><br />'
                + '<span>Please ensure the app has permission to access your location.</span></p>');

            map.getCurrentLocation(function(latLng) {
                /* map.centerOnLocation(latLng.lat, latLng.lng);*/
                map.dismissMessage();
            }, function(errorMessage) {
                map.showMessage('<p><span>Location Error:</span><br /><br />'
                    + '<span>' + errorMessage + '</span></p>');
            });
            //ajax get coord
            $.ajax({
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
                                    'lng': user.lng,
                                    'lat': user.lat
                                }
                                let form = `<form class="form-inline"> <div class="form-group"> <div class="form-check form-check-inline"> <label class="form-check-label">valider le terrain <input type='checkbox' class='form-control' class="status" name='status' data-markerId="${user.id}" value='true'  > </label> </div></div> </form><button class='btn btn-outline-warning deleteCoord' name='delete' value="${user.id}">supprimer</button>`;
                                let markerOptions = {
                                    title: form,
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
                                    iconUrl: '../static/img/maps_icons/icone_verte_home.png',
                                    iconSize: [50, 50]
                                })
                                let json = {
                                    'lng': user.lng,
                                    'lat': user.lat
                                }
                                let form = `<form class="form-inline"> <div class="form-group"> <div class="form-check form-check-inline"> <label class="form-check-label">retire le terrain <input type='checkbox' class='form-control status' data-markerId="${user.id}" name='status' value='true' checked > </label> </div></div> </form><button class='btn btn-outline-warning deleteCoord' name='delete' value="${user.id}">supprimer</button>`;
                                let markerOptions = {
                                    title:form,
                                    clickable: true,
                                    draggable: false,
                                    icon: custonIcon
                                }
                                let mark = L.marker([user.lat, user.lng], markerOptions);
                                console.dir(mark)
                                L.marker([json.lat, json.lng], markerOptions).addTo(map.map).bindPopup(mark.options.title).openPopup();
                                let LGrp = L.layerGroup([mark])
                                console.log('LGrp')
                                console.dir(LGrp)
                                LGrp.eachLayer(function (obj) {
                                    console.log('obj')
                                    console.dir(obj)
                                    if (obj instanceof L.Marker) { // test if the object is a marker
                                        // get the position of the marker with getLatLng
                                        // and draw a circle at that position
                                        console.log('true')

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
            $('.status').on('change',function(e){
                e.preventDefault()
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
            })
            $('.deleteCoord').on('click',function(e){
                e.preventDefault()
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
        });
    </script>
</body>
</html>