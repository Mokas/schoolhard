<?php

session_start();
require_once 'db.php';

$PDO = get_PDO();


//Asks if db has user and returns false if it does
function isUserInDb($userDataArray)
{
    try{
        global $PDO;

        $statement = $PDO->prepare("select count(id) from users where uname=:username OR email=:email");
        $statement->bindParam(":username", $userDataArray["username"]);
        $statement->bindParam(":email", $userDataArray["email"]);
        $statement->execute();

        $amountOfIds = $statement->fetchColumn();

        if($amountOfIds >= 1 ){
          return true;
        }
        else{
            return false;
        }
    }
    catch(Exception $e){
        throw new Exception("Error while checking if user is in DB.");
    }
}

//Encrypts passwords
function encryptPassword($CleanPassword)
{
    $encrypted_Password = password_hash($CleanPassword, PASSWORD_DEFAULT);
    return $encrypted_Password;
}

function addUser($userDataArray)
{
        global $PDO;
        $statement = $PDO->prepare("INSERT INTO users (uname, password, fname, lname, email, confirmed_email) VALUES (:username, :password, :fname, :lname, :email, 0)");
        $statement->bindParam(":username", $userDataArray["username"]);
        $statement->bindParam(":password", $userDataArray["password"]);
        $statement->bindParam(":fname", $userDataArray["fname"]);
        $statement->bindParam(":lname", $userDataArray["lname"]);
        $statement->bindParam(":email", $userDataArray["email"]);
        $statement->execute();
}

function checkUserPass($CleanUsername, $CleanPassword){
    global $PDO;
    $loginStatement = $PDO->prepare("SELECT id,uname,password FROM users WHERE uname=:USERNAME");
    $loginStatement->bindParam("USERNAME", $CleanUsername, PDO::PARAM_STR);
    $loginStatement->execute();
    $returnedObject = $loginStatement->fetch();
    if(password_verify($CleanPassword, $returnedObject["password"])){
        return $returnedObject['id'];
    }
    else{
        return null;
    }
}

function UserLogin($CleanU_ID, $CleanUsername){
    $_SESSION["validated"] = true;
    $_SESSION["USERNAME"] = $CleanUsername;
    $_SESSION["U_ID"] = $CleantUID;
}

function UserLogOut()
{
    session_destroy();
}

class userData{
    public function __construct($username, $password, $email, $fname, $lname) {
        $userDataArray = array("username" => $username, "password" => $password , "email" => $email, "fname" => $fname, "lname" => $lname);
        return $userDataArray;
    }
}

