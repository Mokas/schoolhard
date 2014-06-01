<?php
include "classes\db.php";
include "classes\user.php";

$_SESSION['validated'] = false;
$_SESSION['USERNAME'] = NULL;
$_SESSION['U_ID'] = NULL;

$CleanUsername = htmlspecialchars(filter_input(INPUT_POST, "login_username"));
$CleanPassword = htmlspecialchars(filter_input(INPUT_POST, "login_password"));

if(!empty($CleanPassword) && !empty($CleanUsername))
{
    $U_ID = checkUserPass($CleanUsername, $CleanPassword);
    if($U_ID != NULL){
        UserLogin($U_ID, $CleanUsername);
        header("Location: /schoolhard/index.php");
    }
}