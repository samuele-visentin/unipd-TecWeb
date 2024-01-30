<?php
require_once("global.php");
if(!isset($_SESSION["userId"])) {
    header("Location: ../index.php");
    exit();
}
unset($_SESSION["userId"]);
unset($_SESSION["isAdmin"]);
unset($_SESSION["username"]);
header("Location: ../index.php");
?>