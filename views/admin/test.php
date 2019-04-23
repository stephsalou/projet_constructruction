<?php session_start();
session_destroy();
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../static/css/bootstrap.css">
    <link rel="stylesheet" href="../static/css/bootstrap-grid.css">
    <link rel="stylesheet" href="../static/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="../static/css/all.min.css">
    <link rel="stylesheet" href="../static/css/animate.css">
    <link rel="icon" type="icon/png" href="../static/img/maps_icons/icon-1.png">
    <title>test</title>
</head>
<body>
<form action="" method="post" id="testform">
    <input type="text" name="password">
    <input type="submit">
</form>

<script src="../static/js/jquery-3.3.1.min.js"></script>
<script src="../static/js/bootstrap.js"></script>
<script src="../static/js/bootstrap.bundle.js"></script>
<script src="../static/js/jquery.validate.min.js"></script>
<script src="../static/js/all.js"></script>
<script>
    $(function(){
    let id=31
        $('#testform').on('submit',function(e){
            e.preventDefault()
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
                        $(p).appendTo('#testform')
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

        $.ajaxStart({function(e){
            alert('chargement ajax')
        } })
    })
</script>
</body>
</html>
