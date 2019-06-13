<?php
require '../../database/database.php';
require '../../autoload/admin_autoload.php';
autoload::register();
$db=database::connect();

if(!empty($_POST)){

    $_POST=form_input::checkArray($_POST);
    extract($_POST,EXTR_OVERWRITE);
    $password=form_input::crypt_steph($password);
    $formdata=[
        $username,
        $password
    ];
    $data=db_query::insertData('admin','username,password',$formdata,$db);
    if($data['status']){
        echo 'success enregistrer a l\'id '.$data['data'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>admin adding</title>
    <link rel="stylesheet" href="../static/css/bootstrap.css">
    <link rel="stylesheet" href="../static/css/bootstrap-grid.css">
    <link rel="stylesheet" href="../static/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="../static/css/all.min.css">
    <link rel="stylesheet" href="../static/css/animate.css">
    <link rel="stylesheet" href="../static/css/ihover.css">
</head>
<body>
    <form action="" method="post">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="username">username</span>
            </div>
            <input class="form-control" name="username" type="text" placeholder="entrez le nom d'utilisateur" aria-label="entrez le nom d'utilisateur" aria-describedby="username">
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="password">password</span>
            </div>
            <input class="form-control" name="password" type="password" placeholder="password" aria-label="password" aria-describedby="password">
        </div>
        <input type="submit" class="btn btn-outline-success" value="enregistrer">
    </form>
    <script src="../static/js/jquery-3.3.1.min.js"></script>
    <script src="../static/js/bootstrap.min.js"></script>
    <script src="../static/js/bootstrap.bundle.js"></script>
    <script src="../static/js/jquery.validate.min.js"></script>
    <script src="../static/js/all.js"></script>
</body>
</html>
