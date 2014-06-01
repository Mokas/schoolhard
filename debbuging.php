<?php
include "classes\db.php";
$hash = "$2y$10\$WYEh4h.tS3E.4RGXWT2K.uQum";
echo $hash;
$password = "you1";

$encryptedpasss = password_hash($password, PASSWORD_DEFAULT);
echo $encryptedpasss."</br>";

if(password_verify($password, $hash)){
echo "sdasdasrue";
}
 else {
     echo "fasdasdalse";
}
/*
    $PDO = get_PDO();
    
    $loginStatement = $PDO->prepare("SELECT id,uname,password FROM users WHERE uname=:USERNAME");
    $loginStatement->bindParam("USERNAME", $CleanUsername, PDO::PARAM_STR);
    $loginStatement->execute();
    $returnedObject = $loginStatement->fetch();
    echo $returnedObject["password"]."</br>";
    echo $CleanPassword."</br>";

   if(password_verify($CleanPassword, $hash)){
       return "test1";
        return $returnedObject['id'];
    }
*/