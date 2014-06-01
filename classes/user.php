<?php
require_once 'db.php';

$PDO = get_PDO();

function getUserDataInArray(){
    $username = htmlspecialchars(filter_input(INPUT_POST, "username"));
    $password = htmlspecialchars(filter_input(INPUT_POST, "password"));
    $email = htmlspecialchars(filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL));
    $fname = htmlspecialchars(filter_input(INPUT_POST, "fname"));
    $lname = htmlspecialchars(filter_input(INPUT_POST, "lname"));
    
    return $userArray = array("username" => $username, "password" => $password , "email" => $email, "fname" => $fname, "lname" => $lname);
   } 
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

function checkLogin()
{
    
}


class userData{
    public function __construct($username, $password, $email, $fname, $lname) {
        $userDataArray = array("username" => $username, "password" => $password , "email" => $email, "fname" => $fname, "lname" => $lname);
        return $userDataArray;
    }
}