<?php

require_once("../app/global.php");

unset($_SESSION["userId"]);
unset($_SESSION["isAdmin"]);
header("Location: ../index.php");

?>