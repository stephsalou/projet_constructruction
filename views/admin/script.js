
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