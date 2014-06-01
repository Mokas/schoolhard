<?php

require "classes\db.php";
    
$username = "test1";
$password = "test2";
$email = "testemail";

$PDO = get_PDO();

$statement = $PDO->prepare("select count(id) from users where uname=:username OR email=:email");
$statement->bindParam(":username", $username);
$statement->bindParam(":email", $email);
$statement->execute();

echo ($statement->fetchColumn());
