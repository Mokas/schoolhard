<?php
session_start();

include_once "classes\db.php";
include_once "classes\data.php";
include_once "classes\user.php";
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>SchoolHARD -HOMEPAGE-</title>
        <link type="text/css" rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="http://i.imgur.com/RiVU41l.png"> <!--
        Credits to Martz90
        http://www.iconarchive.com/show/circle-icons-by-martz90/books-icon.html
        Distributed under CC's license 
        http://creativecommons.org/licenses/by-nc-nd/3.0/
        -->
    </head>
    
    <body>
        <header>
            <nav id="topbar">
                <a href="index.php"><p>Home</p></a>
                <a href="reader.php"><p>Read</p></a>
                <a href="register.php"><p>Login/Register</p></a>
                <?php 
                    if(isset($_SESSION["validated"]))
                    {
                        echo "<h6 id=\"username\">Welcome ".getUserById($_SESSION["U_ID"])." </h6>";
                        echo "<a id=\"post_Box\"href=\"post.php\"><p>Post</p></a>";
                        echo "<a id=\"logout_Box\"href=\"logout.php\"><p>Logout</p></a>";
                    }
                ?>
            </nav>
        </header>
<?php
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
