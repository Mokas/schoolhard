<?php
session_start();

include_once "classes\db.php";
include_once "classes\data.php";
include_once "classes\user.php";

echo searchPost("testniklas")[0]["TITLE"];