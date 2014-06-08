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
$cleanTitle = htmlspecialchars(filter_input(INPUT_POST, "title"));
$cleanContent = htmlspecialchars(filter_input(INPUT_POST, "content"));
$cleanSubject_id = htmlspecialchars(filter_input(INPUT_POST, "subject_id", FILTER_VALIDATE_INT));
$ip_address = filter_input(INPUT_SERVER, "REMOTE_ADDR");

$isSet = isset($_SESSION["validated"]);

if(isset($_SESSION["validated"]) && !empty($cleanTitle) && !empty($cleanContent) && !empty($cleanSubject_id)){
    $U_ID = $_SESSION["U_ID"];
    $isLoggedIn = $_SESSION["validated"];
    
    if(!empty($cleanTitle) && !empty($cleanTitle) && $isLoggedIn)
    {
        if(!doesPostExist($cleanTitle)){
            if(addTitleAndContent($cleanTitle, $cleanContent, $cleanSubject_id, $U_ID, $ip_address)){
                echo "Your post has been added. Click <a href=\"index.php\">HERE</a> to return to the homepage.";
            }
        }
    }
    else if(!$isLoggedIn){
        echo "You need to be logged in to post.
            Click <a href=\"index.php\">HERE</a> to return to the homepage.";
    }
    else{
        echo "Make sure you filled all the required fields.
            Click <a href=\"index.php\">HERE</a> to return to the homepage.";
    }
}
elseif(!isset($_SESSION["validated"])){
    echo "You need to be logged in to post.
    Click <a href=\"login.php\">HERE</a> to return to the homepage.";
}
elseif(isset($_SESSION["validated"]) && empty($cleanTitle) && empty($cleanContent) && empty($cleanSubject_id)){
echo "<div id=\"send_summary\">";
echo "<form action=\"post.php\" method=\"post\">";
echo "<fieldset>";
    echo "<input type=\"text\" name=\"title\"><br>";
    echo "<textarea rows=\"10\" cols=\"50\" name=\"content\"></textarea>";
//Cicles trough all subjects and adds them to checkbox. 
            try{
                $arrayOfSubjectNames = getSubjectNames();
                echo "<select name=\"subject_id\">";
                $i = 0;
                foreach($arrayOfSubjectNames as $subject_name){
                    echo "<option value=".$i.">".$subject_name."</option>";
                    $i++;
                }
                echo "</select>";
                echo "<input type=\"submit\" value=\"Submit Post\">";
            }
            catch(Exception $e){
                Echo "<p>AN ERROR AS OCCURED WHILE ACCESSING THE DATABASE";
            }
       
        echo "</fieldset>";
        echo "</form>";
        echo "</div>";
        
        echo "\t".file_get_contents(getcwd()."\lazy\\send_subject.html");
    }
    

?>