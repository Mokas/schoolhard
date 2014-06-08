<?php

    session_start();
    session_destroy();
    include "classes\db.php";
    include "classes\user.php";
    
    //Gets post vars and slightly filters 
    $username = htmlspecialchars(filter_input(INPUT_POST, "username"));
    $password = htmlspecialchars(filter_input(INPUT_POST, "password"));
    $email = htmlspecialchars(filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL));
    $fname = htmlspecialchars(filter_input(INPUT_POST, "fname"));
    $lname = htmlspecialchars(filter_input(INPUT_POST, "lname"));
    $ip_address = filter_input(INPUT_SERVER, "REMOTE_ADDR");
    
    $userArray = array("username" => $username, "password" => $password , "email" => $email, "fname" => $fname, "lname" => $lname, "ip_address" => $ip_address);
    
    //Get and filter all parameters used byt hte registering function.
    if(!empty($userArray["username"]) && !empty($userArray["password"]) && !empty($userArray["email"]))
    {
        //Checks if user is registred. Returns true if it is.
        if(!isUserInDb($userArray)){
            
            //Encrypts password
            $userArray["password"] = encryptPassword($userArray["password"]);
            
            //Adds user to database.
            addUser($userArray);
            echo "Your account has been created.
                Click <a href=\"index.php\">HERE</a> to return to the homepage.";
        }
        else{
            echo "An account with your username AND/OR email has ALREADY been created. Please recover your account OR create another account.";
        }
    }
    else{
        echo "Please type in all fields necessary.";
    }