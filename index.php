<?php
    session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>SchoolCheat</title>
        <link type="text/css" rel="stylesheet" href="style.css"
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
                    <textarea rows="10" cols="50" name="summary">
                        
                    </textarea>
                    <table>
                        <tr>
                            <td>
                            <input type="radio" name="subject_id" value="1">Maths
                            </td>
                            <td>
                            <input type="radio" name="subject_id" value="2">English
                            </td>
                            <td>
                            <input type="radio" name="subject_id" value="3">Engineering
                            </td>
                            <td>
                            <input type="radio" name="subject_id" value="4">Physics
                            </td>
                            <td>
                            <input type="radio" name="subject_id" value="5">P.E
                            </td>
                            <input type="submit" value="Submit">
                        </tr>
                    </table>
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
    </body>
</html>
