<?php
session_start();

include_once "classes\db.php";
include_once "classes\data.php";
include_once "classes\user.php";

$arraytest = getTitleContentU_IDById(5);
echo $arraytest["U_ID"];