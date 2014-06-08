<?php
session_start();

include_once "classes\db.php";
include_once "classes\data.php";

$cleanSubjectName = htmlspecialchars(filter_input(INPUT_POST, "subject_name"));
$cleanSubjectScription = htmlspecialchars(filter_input(INPUT_POST, "subject_description"));

$ip_address = filter_input(INPUT_SERVER, "REMOTE_ADDR");

if(isset($_SESSION["validated"])){
    $U_ID = $_SESSION["U_ID"];
    $isLoggedIn = $_SESSION["validated"];
    if(!empty($cleanSubjectName) && !empty($cleanSubjectScription) && $isLoggedIn){
        if(!doesSubjectExist($cleanSubjectName)){
            if(addSubjectAndDesc($U_ID, $cleanSubjectName, $cleanSubjectScription, $ip_address))
            {
                echo "Your subject has been added.
                     Click <a href=\"index.php\">HERE</a> to return to the homepage.";
            }
        }else{
            echo "Another subject with the same name exists already. Click <a href=\"index.php\">HERE</a> to return to the homepage.";
        }
    }
}
else if(empty($cleanSubjectName) || empty($cleanSubjectScription) && !$isLoggedIn){
    echo "You MUST be logged in to add a subject. AND you are required to fill the Subject Name AND Subject Description boxes.";
}
else if(empty($cleanSubjectName) || empty($cleanSubjectScription) && $isLoggedIn){
    echo "You are required to fill the Subject Name AND Subject Description boxes.";
}
else{
    echo "You MUST be logged in to add a subject. Click <a href=\"index.php\">HERE</a> to return to the homepage.";
}
