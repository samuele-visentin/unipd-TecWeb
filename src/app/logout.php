<?php

require_once("global.php");

unset($_SESSION["userId"]);
unset($_SESSION["isAdmin"]);
unset($_SESSION["username"]);
//FIXME: session_destroy();
header("Location: ../index.php");

?>