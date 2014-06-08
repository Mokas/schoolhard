<?php
    session_start();
    include "classes\db.php";
    include "classes\user.php";
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
    //Gets post vars and slightly filters 
    $username = htmlspecialchars(filter_input(INPUT_POST, "username"));
    $password = htmlspecialchars(filter_input(INPUT_POST, "password"));
    $email = htmlspecialchars(filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL));
    $fname = htmlspecialchars(filter_input(INPUT_POST, "fname"));
    $lname = htmlspecialchars(filter_input(INPUT_POST, "lname"));
    $ip_address = filter_input(INPUT_SERVER, "REMOTE_ADDR");
    
    $cleanlogin_username = htmlspecialchars(filter_input(INPUT_POST, "login_username"));
    $cleanlogin_password = htmlspecialchars(filter_input(INPUT_POST, "login_password"));
    
    $userArray = array("username" => $username, "password" => $password , "email" => $email, "fname" => $fname, "lname" => $lname, "ip_address" => $ip_address);
    
    //Get and filter all parameters used by the registering function. Also check does login procedure
    if(!empty($userArray["username"]) && !empty($userArray["password"]) && !empty($userArray["email"]))
    {
        //Checks if user is registred. Returns true if it is.
        if(!isUserInDb($userArray)){
            
            //Encrypts password
            $userArray["password"] = encryptPassword($userArray["password"]);
            
            //Adds user to database.
            addUser($userArray);
            echo "Your account has been created.
                Click <a href=\"register.php\">HERE</a> to login.";
        }
        else{
            echo "An account with your username AND/OR email has ALREADY been created. Please click <a href=\"register.php\">HERE</a> to create another account.";
        }
    }
    elseif(!empty($cleanlogin_password) && !empty($cleanlogin_username))
        {
            if(checkUserPass($cleanlogin_username, $cleanlogin_password)){
                $U_ID = getUserId($cleanlogin_username);
                $_SESSION["validated"] = true;
                $_SESSION["USERNAME"] = $cleanlogin_username;
                $_SESSION["U_ID"] = $U_ID;
                header("Location: /schoolhard/index.php");
            }
            else{
                echo "The password AND/OR username was INCORRECT. Click <a href=\"index.php\">HERE</a> to return to the homepage.";
                session_destroy();
            }
        }
    elseif((!empty($cleanlogin_password) && empty ($cleanlogin_username)) || (empty($cleanlogin_password) && !empty($cleanlogin_username) )){
        echo "Please type in all fields necessary. to login Click <a href=\"register.php\">HERE</a> to return.";
    }
    elseif(isset($_SESSION["validated"])){
        echo "Already logged in";
    }
    elseif(empty($_POST)){
        echo "\xA<div id=\"registerlogin\">\xA";
        echo "\t".file_get_contents(getcwd()."\lazy\\login.html")."\xA";
        echo "\t".file_get_contents(getcwd()."\lazy\\register.html");
        echo "\xA</div>";
    }