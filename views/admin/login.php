<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../static/css/bootstrap.css">
    <link rel="stylesheet" href="../static/css/bootstrap-grid.css">
    <link rel="stylesheet" href="../static/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="../static/css/all.min.css">

    <title>acceuil</title>
</head>


<style>
    body{
        background-color:#ACACAC;
    }
    .inputs{
        margin: 15px;
    }
    .card{
        margin-top: 40%;
        background-color: rgba(255,255,255,0.5);
    }
    .thumbnail{
        margin:auto auto;
    }
    .Verror {
        height: 100%;
        font-size: 100%;
        box-shadow: 0px 0px 5px 3px  rgba(200,020,050,0.6);
    }
    .Vsuccess {
        height: 100%;
        font-size: 100%;
        box-shadow:0px 0px 5px 3px rgba(22,209,10,0.6);
    }
    .errorTxt{
        margin: auto;
        font-weight: 700;
        font-size: large;
        border-radius: 30% ;
    }
</style>
<body>

<div class="container-fluid">
    <div class="row">
        <div  class=" offset-4 thumbnail animated bounceInDown offset-4">
            <div class="card ">
                <div class="errorTxt">

                </div>
                <div class="card-header">
                    CONNEXION
                </div>
                <div class="card-body">
                    <form id="connex" action="" method="post">
                        <div class="input-group inputs">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-address-card" aria-hidden="true"></i> </span>
                            </div>
                            <input class="form-control" type="text" name="username" placeholder="put your username" aria-label="Recipient's email">
                            <div class="input-group-append">
                                <span class="input-group-text">EMAIL</span>
                            </div>
                        </div>
                        <div class="input-group inputs">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock" aria-hidden="true"></i> </span>
                            </div>
                            <input class="form-control" type="password" name="password" placeholder="put your password" aria-label="Recipient's password">
                            <div class="input-group-append">
                                <span class="input-group-text">PASSWORD</span>
                            </div>
                        </div>
                        <input type="text" class="ignore" hidden readonly name="action" value="connex">
                    </form>
                </div>
                <div class="card-footer">
                    <input class="btn btn-success btn-lg" style="width:100%" type="submit" form="connex" value="SE CONNECTER" >

                </div>
            </div>
        </div>
    </div>


</div>


<script src="../static/js/jquery-3.3.1.min.js"></script>
<script src="../static/js/bootstrap.js"></script>
<script src="../static/js/bootstrap.bundle.js"></script>
<script src="../static/js/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="../static/js/all.js"></script>
<script>
    $(function () {


        $('form#connex').validate({
            debug: true,
            //           onSubmit: false,
            ignore: '.ignore',
            errorClass: 'Verror',
            validClass: 'Vsuccess',
            success: 'valide',
            errorElement : 'div',
            errorLabelContainer: '.errorTxt',
            rules: {
                username: {
                    required: true,
                    minlength: 6,
                    maxlength: 40
                },
                password: {
                    required: true,
                    minlength: 5,
                    maxlength: 100
                }
            },
            messages: {
                email: {
                    required: "vous devez avoir un nom d'utilisateur pour vous connecter",
                    minlength: "vous email doit etre au dessus de 5 characteres",
                    maxlength: 'votre email doit etre en dessous de 40 charactere'
                },
                password: {
                    required: 'le mot de passe est exigez',
                    minlength: 'votre mot de pass doit contenir au moins 5 charactere',
                    maxlength: 'votre mot de pass ne doit pas depasser 100 charactere'
                }
            },
            highlight: function (element, error, success) {
                $(element).addClass('Verror').removeClass('Vsuccess');
            },
            unHighlight: function (element, error, success) {
                $(element).addClass(success).removeClass(error);
            },
            submitHandler: function (form) {
                var formData = new FormData(form);
                $.ajax({
                    url: '../../controller/admin_controller.php',
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    success: function (data) {
                        if(!data.status){
                            $(window.location).attr('href','index.php')
                        }else{
                            var alert="<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" \><button type=\"button\"  data-dismiss=\"alert\" aria-label=\"alert\"> <span aria-hidden=\"true\">\&times;</span></button> \<a href=\"#\" class=\"alert-link\">"+data.message+"\</div>"
                            $(alert).insertBefore('.container-fluid')
                        }
                    },
                    error:function(data){
                        var alert="<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" \><button type=\"button\"  data-dismiss=\"alert\" aria-label=\"alert\"> <span aria-hidden=\"true\">\&times;</span></button> \<a href=\"#\" class=\"alert-link\">impossible de vous connecter </div>"
                        $(alert).insertBefore('.container-fluid')
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            },
            invalidHandler: function (event, validator) {
                var errors = validator.numberOfInvalids();
                if (errors) {
                    var message = errors == 1 ? 'il y\' a  1 champ incorrect veuillez le remplir pour continuer ' : 'vous avez ' + errors + ' chapms incorrect';
                    var alert="<div class=\"alert alert-danger alert-dismissible fade show\" id=\"alert\" role=\"alert\" \><button type=\"button\"  data-dismiss=\"alert\" aria-label=\"alert\"> <span aria-hidden=\"true\">\&times;</span></button> \<a href=\"#\" class=\"alert-link\"> "+message+"\</div>"
                    $(alert).insertBefore('.container-fluid')
                } else {
                    alert('erreur systeme')
                }
            }
        })
    })
</script>

</body>
</html>