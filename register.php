<?php
    include "classes\db.php";
    include "classes\user.php";
    
    //Gets post vars and slightly filters 
    $userArray = getUserDataInArray();
    
    //Get and filter all parameters used byt hte registering function.
    if(!empty($userArray["username"]) && !empty($userArray["password"]) && !empty($userArray["email"]))
    {
        //Checks if user is registred. Returns true if it is.
        if(!isUserInDb($userArray)){
            echo("Your account has been created. An activation email has been sent to your email.");
            //Adds user to database.
            addUser($userArray);
        }
        else
        {
            echo "An account with your username AND/OR email has ALREADY been created. Please recover your account OR create another account.";
            //TODO: Add recover function.
        }
    }
    else
    {
        echo "Please type in all fields necessary.";
        //header("Location: /schoolhard/index.php");
        //exit();
        
    }
    
    /*header("Location: /index.php");
    exit();*/
?>
