<?php

function get_PDO(){
    $dbhost = "127.0.0.1";
    $dbname = "summary";
    $dbusername = "root";
    $dbpassword = "test";
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbusername);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $pdo;
}//TODO add error managemnt