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

// Overlay message methods
/////my own script

    /////////////////surely let see

    //marker
    /*var custonIcon = L.icon({
        iconUrl: 'iso_nan.png',
        iconSize: [50, 50]
    })
    let json = {
        'lng': -3.9626517,
        'lat': 5.4018045
    }
    var markerOptions = {
        title: "nom proprio",
        clickable: true,
        draggable: false,
        icon: custonIcon
    }
    let mark = L.marker([json.lat, json.lng], markerOptions);
    console.dir(mark)
    // Creating a marker
    L.marker([json.lat, json.lng], markerOptions).addTo(map.map).bindPopup(mark.options.title).openPopup();
*/
///my ajax
    $.ajax({
        type: 'POST',
        url: '../../controller/map_controller.php',
        dataType: 'json',
        data: {action: 'select'},
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
                        let form = `<form class="form-inline"> <div class="form-group"> <div class="form-check form-check-inline"> <label class="form-check-label">valider le terrain <input type='checkbox' class='form-control' name='status' data-markerId="${user.id}" value='true'  > </label> </div></div> </form><button class='btn btn-outline-warning deleteCoord' name='delete' value="${user.id}">supprimer</button>`;
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
                        let form = `<form class="form-inline"> <div class="form-group"> <div class="form-check form-check-inline"> <label class="form-check-label">retire le terrain <input type='checkbox' class='form-control' data-markerId="${user.id}" name='status' value='true' checked > </label> </div></div> </form><button class='btn btn-outline-warning deleteCoord' name='delete' value="${user.id}">supprimer</button>`;
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
            window.location.reload()
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
/////requires script