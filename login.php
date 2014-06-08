<?php
session_start();
include "classes\db.php";
include "classes\user.php";

$_SESSION["validated"] = false;
$_SESSION["USERNAME"] = NULL;
$_SESSION["U_ID"] = NULL;


//Filters variables for login procedure.
$CleanUsername = htmlspecialchars(filter_input(INPUT_POST, "login_username"));
$CleanPassword = htmlspecialchars(filter_input(INPUT_POST, "login_password"));


//Login procedure. MAKE SURE TO FILTER ALL VARS
if(!empty($CleanPassword) && !empty($CleanUsername))
{
    if(checkUserPass($CleanUsername, $CleanPassword)){
        $U_ID = getUserId($CleanUsername);
        $_SESSION["validated"] = true;
        $_SESSION["USERNAME"] = $CleanUsername;
        $_SESSION["U_ID"] = $U_ID;
        header("Location: /schoolhard/index.php");
    }
    else{
        echo "The password AND/OR username was INCORRECT. Click <a href=\"index.php\">HERE</a> to return to the homepage.";
        session_destroy();
    }
}
else{
    echo "Please type in all fields necessary. Click <a href=\"index.php\">HERE</a> to return.";
    session_destroy();
}