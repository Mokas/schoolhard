<?php
session_start();

include_once "classes\db.php";
include_once "classes\data.php";
include_once "classes\user.php";

$cleanTitle = htmlspecialchars(filter_input(INPUT_POST, "title"));
$cleanContent = htmlspecialchars(filter_input(INPUT_POST, "content"));
$cleanSubject_id = htmlspecialchars(filter_input(INPUT_POST, "subject_id", FILTER_VALIDATE_INT));
$ip_address = filter_input(INPUT_SERVER, "REMOTE_ADDR");

$isSet = isset($_SESSION["validated"]);

if($isSet){
    $U_ID = $_SESSION["U_ID"];
    $isLoggedIn = $_SESSION["validated"];
    
    if(!empty($cleanTitle) && !empty($cleanTitle) && $isLoggedIn)
    {
        if(!doesPostExist($cleanTitle)){
            if(addTitleAndContent($cleanTitle, $cleanContent, $cleanSubject_id, $U_ID, $ip_address)){
                echo "Your post has been added. Click <a href=\"index.php\">HERE</a> to return to the homepage.";
            }
        }
    }else if(!$isLoggedIn){
        echo "You need to be logged in to post.
            Click <a href=\"index.php\">HERE</a> to return to the homepage.";
    }
    else{
        echo "Make sure you filled all the required fields.
            Click <a href=\"index.php\">HERE</a> to return to the homepage.";
    }
}
else{
    echo "You need to be logged in to post.
    Click <a href=\"index.php\">HERE</a> to return to the homepage.";
}