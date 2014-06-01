<?php

$userPasswordAndLoginArray = array();

$userPasswordAndLoginArray["username"] = htmlspecialchars(filter_input(INPUT_POST, "login_username"));
$userPasswordAndLoginArray["password"] = htmlspecialchars(filter_input(INPUT_POST, "login_password"));

echo($userPasswordAndLoginArray["username"]);
echo($userPasswordAndLoginArray["password"]);