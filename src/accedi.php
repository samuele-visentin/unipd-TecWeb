<?php
require_once("app/global.php");
require_once("components/sidebar.php");

if(isset($_SESSION["userId"]) && $_SESSION["userId"] !== "") {
    header("Location: cases.php");
    exit();
}
$title = 'Accedi | '.$TITLE;
$layout = file_get_contents("templates/layout.html");
$content = file_get_contents("templates/accedi_layout.html");
$keywords = 'Clue Catchers, accedi, login';
$description = 'Accedi a Clue Catchers per giocare ai nostri casi.';
$breadcrumbs = '<p><a href="index.php" lang="en">Home</a> &raquo; Accedi</p>';
$account = '<li id="signupButton"><a href="registrati.php" lang="en">Sign up</a></li>';
$error = '';
if(isset($_GET["error"])) { 
    if($_GET["error"] === "invalid") {
        $error = '<p id="error-message"><span lang="en">Username</span> o <span lang="en">password </span>errati</p>';
    } else if($_GET["error"] === "notLogged") {
        $error = '<p id="error-message">Devi prima accedere per visualizzare la pagina.</p>';
    }
    $content = str_replace("[aria]", 'aria-invalid="true" aria-describedby="error-message"', $content);
} else {
    $error = '';
    $content = str_replace("[aria]", "", $content);
}
$content = str_replace("[errorMessage]", $error, $content);
$target = '';
if(isset($_GET["target"]) && $_GET["target"] !== "") {
    $target = '?target='.$_GET["target"];
}
$content = str_replace("[target]", $target, $content);
$page = str_replace("[title]", $title, $layout);
$page = str_replace("[keywords]", $keywords, $page);
$page = str_replace("[description]", $description, $page);
$page = str_replace("[breadcrumbs]", $breadcrumbs, $page);
$page = str_replace("[content]", $content, $page);
$page = str_replace("[sidebar]", getSidebar(""), $page);
$page = str_replace("[userToolbar]", $account, $page);
echo $page;
?>