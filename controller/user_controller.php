<?php
/**
 * Created by PhpStorm.
 * User: steph
 * Date: 13/04/2019
 * Time: 20:10
 */

require '../database/database.php';
require '../autoload/autoload.php';
require '../autoload/core_loader.php';
if(isset($_POST) && !empty($_POST)){
$db=database::connect();
switch($_POST['action']){
    case 'register':
         extract($_POST,EXTR_OVERWRITE);
        $email=form_input::checkInput($email);
        $password=form_input::checkInput($password);

}


}