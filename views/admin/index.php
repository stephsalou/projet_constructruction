<?php session_start();
if (empty($_SESSION)) {
    header('Location:login.php');
}
if (isset($_GET)) {
    include '../../controller/config.inc.php';
    require '../../database/database.php';
    require '../../autoload/admin_autoload.php';
    autoload::register();
    $db = database::connect();
    $result = user::select_all_user($db, ADMIN_FILE_PATH);
    $usercolumn = $result['column'];
    $userData = $result['data'];
    $result = map::selectJoin('materiaux', 'sable,ciment,gravier,bois,user.username,user.image', $db, null, ADMIN_FILE_PATH);
    $gestionColumn = $result['column'];
    $gestionData = $result['data'];
}
?>

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
    <link rel="stylesheet" href="../static/css/animate.css">
    <link rel="stylesheet" href="../static/css/ihover.css">
    <title>acceuil</title>
</head>


<body>

<header>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item mr-3">
            <h4 class="nav-brand">ISO-BaT</h4>
        </li>
        <li class="nav-item">
            <a class="nav-link active" id="userAdmin-tab" data-toggle="tab" href="#userAdmin" role="tab"
               aria-controls="userAdmin" aria-selected="true">administration utilisateur</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="gestionAdmin-tab" data-toggle="tab" href="#gestionAdmin" role="tab"
               aria-controls="gestionAdmin" aria-selected="false">gestion de materiels</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " id="gestionAdmin-tab" href="admin_map.php" >carte administrateur</a>
        </li>
        <li class="nav-item ml-4">
            <button class="btn btn-block btn-outline-danger" id="deconnexion" value="logout">deconnexion</button>
        </li>
    </ul>
</header>
<div class="container">
    <div class="row">

        <div class="tab-content" id="conteneur">
            <div class="tab-pane fade show active" id="userAdmin" role="tabpanel" aria-labelledby="userAdmin-tab">
                <table class="table table-dark table-striped">
                    <thead class="thead-dark">

                    <tr>
                        <?php foreach ($usercolumn as $key => $value): ?>
                            <th><?= $value ?></th>
                        <?php endforeach ?>
                        <th>options</th>
                    </tr>

                    </thead>
                    <tbody id="tbody-user">
                    <?php foreach ($userData as $keys => $value): ?>
                        <tr>
                            <?php foreach ($value as $key => $val): ?>
                                <?php if ($key != 'image') { ?>
                                    <td><?= $val ?></td>
                                <?php } elseif($key!='id') { ?>
                                    <td><img src="<?= $val ?>" alt="image utilisateur" style="height: 5vh;"
                                             class="img img-fluid"></td>
                                <?php } ?>

                            <?php endforeach ?>
                            <td>
                                <button class="btn btn-outline-danger deleteUser" value="<?=$value['id'] ?>">
                                    supprimer
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="gestionAdmin" role="tabpanel" aria-labelledby="gestionAdmin-tab">
                <table class="table table-light table-striped">
                    <thead class="thead-dark">

                    <tr>
                        <?php foreach ($gestionColumn as $key => $value): ?>
                            <th><?= $value ?></th>
                        <?php endforeach ?>
                        <th>options</th>
                    </tr>

                    </thead>
                    <tbody id="tbody-outil">
                    <?php foreach ($gestionData as $keys => $value): ?>
                        <tr>
                            <?php foreach ($value as $key => $val): ?>
                                <?php if ($key != 'image') { ?>
                                    <td><?= $val ?></td>
                                <?php } else { ?>
                                    <td><img src="<?= $val ?>" alt="image utilisateur" style="height: 5vh;"
                                             class="img img-fluid"></td>
                                <?php } ?>

                            <?php endforeach ?>
                            <td>
                                <button class="btn btn-outline-danger deleteOutil" value="<?= $value['id'] ?>">
                                    supprimer
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
<script src="../static/js/jquery-3.3.1.min.js"></script>
<script src="../static/js/bootstrap.min.js"></script>
<script src="../static/js/bootstrap.bundle.js"></script>
<script src="../static/js/all.js"></script>
<!-- <script src="script.js"></script>-->
<script>
    $(function () {
        $('.deleteUser').on('click', function (e) {
            e.preventDefault();
            let id = $(this).val();
            $.ajax({
                url: '../../controller/admin_user_controller.php',
                dataType: 'json',
                type: 'POST',
                data: {action: 'delete', userId: id},
                success: function (data) {
                    if (data.status) {
                        window.location.reload()
                    } else {
                        var alert = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" \><button type=\"button\"  data-dismiss=\"alert\" aria-label=\"alert\"> <span aria-hidden=\"true\">\&times;</span></button> \<a href=\"#\" class=\"alert-link\">" + data.message + "\</div>"
                        $(alert).insertBefore('.container-fluid')
                    }
                },
                    error:function (err) {
                        var alert = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" \><button type=\"button\"  data-dismiss=\"alert\" aria-label=\"alert\"> <span aria-hidden=\"true\">\&times;</span></button> \<a href=\"#\" class=\"alert-link\"> erreur systeme \</div>"
                        $(alert).insertBefore('.container-fluid')
                    }

            })
        })
        $('.deleteOutil').on('click', function (e) {
            e.preventDefault();
            let id = $(this).val();
            $.ajax({
                url: '../../controller/admin_gestion_controller.php',
                dataType: 'json',
                type: 'POST',
                data: {action: 'delete', id: id},
                success: function (data) {
                    if (data.status) {
                        window.location.reload()
                    } else {
                        var alert = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" \><button type=\"button\"  data-dismiss=\"alert\" aria-label=\"alert\"> <span aria-hidden=\"true\">\&times;</span></button> \<a href=\"#\" class=\"alert-link\">" + data.message + "\</div>"
                        $(alert).insertBefore('.container-fluid')
                    }
                     },
                    error:function (err) {
                        var alert = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" \><button type=\"button\"  data-dismiss=\"alert\" aria-label=\"alert\"> <span aria-hidden=\"true\">\&times;</span></button> \<a href=\"#\" class=\"alert-link\"> erreur systeme \</div>"
                        $(alert).insertBefore('.container-fluid')
                    }


            })
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