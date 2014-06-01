<?php

include "classes\db.php";
include "classes\user.php";

UserLogOut();
header("Location: /schoolhard/index.php");
exit();