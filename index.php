<?php
    session_start();
    include_once "classes\data.php";
    include_once "classes\db.php";
    
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
        <div id="register">
            <form action="register.php" method="post">
                <fieldset>
                        <label for="username">Username:</label> <input type="text" name="username"  title="Please don't type in stupid shit"><br>
                        <label for="password">Password: </label>  <input type="password" name="password"  title="Please don't type in stupid shit"><br>
                        <label for="fname"> First Name:</label>  <input type="text" name="fname"  title="Please don't type in stupid shit"><br>
                        <label for="lname">Last Name:</label>  <input type="text" name="lname"  title="Please don't type in stupid shit"><br>
                        <label for="email">Email:</label>  <input type="text" name="email"  title="Please don't type in stupid shit"><br>
                        <input type="submit"></tr>
                </fieldset>
            </form>
        </div>
        
        <div id="send_summary">
            <form action="post.php" method="post">
                <fieldset>
                    <input type="text" name="title"><br>
                    <textarea rows="10" cols="50" name="content"></textarea>
                    <?php //Cicles trough all subjects and adds them to checkbox. 
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
                    ?>
                </fieldset>
            </form>
        </div>
        
        <div id="login_box">
            <form action="login.php" method="post">
                <fieldset>
                    <label for="login_username">Username:</label><input type="text" name="login_username"><br>
                    <label for="login_password">Password:</label><input type="password" name="login_password">
                    <input type="submit" value="Login">
                </fieldset>
            </form>
        </div>
        
        
        
        <?php
            
        if(!empty($_SESSION['validated']) && $_SESSION['validated']){
                echo ("LOGGED IN <fieldset><form action=\"logout.php\" method=\"post\"> <input type=\"submit\" value=\"Logout\"> </form></fieldset>");
            }
            
           else{
                echo "NOT LOGGED IN";
           }
        ?>
        
        <div id="add_subject">
            <form action="addsubject.php" method="post">
                <fieldset>
                    <label for="subject_name">Subject Name:</label><input type="text" name="subject_name"><br>
                    <label for="subject_description">Small description(max 250 bokstaver):</label>
                    <textarea rows="10" cols="50" name="subject_description"></textarea>
                    <input type="submit" value="Add subject">
                </fieldset>
            </form>
        </div>
        
    </body>
</html>
