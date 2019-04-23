<?php
session_start();
if(empty($_SESSION)){
   header('Location: login.php');
}
require '../../database/database.php';
require '../../autoload/admin_autoload.php';
autoload::register();
$db=database::connect();
if(isset($_POST) && !empty($_POST)){

    $_POST=form_input::checkArray($_POST);
    extract($_POST,EXTR_OVERWRITE);
    if(isset($delete) && !empty($delete)){
        $cond=[
            'npq'=>'id=\''.$delete.'\''
        ];
        $data=map::delete_coord($db,$cond);
        header('Location: admin_map.php');
    }elseif(isset($action) && $action=='confirmer' && isset($validate)){
        $_POST=form_input::checkArray($_POST);
        extract($_POST,EXTR_OVERWRITE);
        $cond=[
          'npq'=>'id=\''.$validate.'\''
        ];
        $data=map::set_status($db,[1],$cond);
        header('Location: admin_map.php');
    }else{
        header('Location: index.php');
    }

}else{
    header('Location: index.php');
}