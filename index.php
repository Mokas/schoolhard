<?php
    session_start();
    include_once "classes\data.php";
    include_once "classes\db.php";
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
        
        <div id="welcome-page">
            <h1>Welcome to SchoolHard</h1>
            <p>SchoolHard is a website where the TE12C pupils can submit and read course summaries. Not only do we encorage you to upload school related material we also allow you to add your own subject.</p>
        </div>
    </body>
</html>
