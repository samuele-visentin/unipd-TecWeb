<?php
require_once("app/global.php");
require_once("components/sidebar.php");

if(!isset($_SESSION['userId']) || $_SESSION['userId'] === "") {
    header("Location: index.php");
    exit();
}

$layout = file_get_contents("templates/layout.html");
$content = file_get_contents("templates/account_layout.html");
$content = str_replace("[username]", $_SESSION['username'], $content);
$title = 'Accedi | ' . $TITLE;
$keywords = '';
$description = '';
$breadcrumbs = '<p><a href="index.php" lang="en">Home</a> &raquo; <span lang="en">Account</span></p>';
$account = getUserToolBar();
$usernameError = '';
$passwordError = '';
$ariaUsername = '';
$ariaPassword = '';
if(isset($_GET['error'])) {
    if($_GET['error'] === "username") {
        $usernameError = "<p id='error-message'>L'<span lang='en'>username</span> non rispetta i criteri.</p>";
        $ariaUsername = 'aria-invalid="true" aria-describedby="error-message"';
    } else if($_GET['error'] === "passwordNotSame") {
        $passwordError = "<p id='error-message'>Le <span lang='en'>password</span> non corrispondono</p>";
        $ariaPassword = 'aria-invalid="true" aria-describedby="error-message"';
    } else if($_GET['error'] === "password") {
        $passwordError = "<p id='error-message'>La <span lang='en'>password</span> non rispetta i criteri.</p>";
        $ariaPassword = 'aria-invalid="true" aria-describedby="error-message"';
    } else if($_GET['error'] === "userNotValide") {
        $usernameError = "<p id='error-message'>L'<span lang='en'>username</span> non è disponibile.</p>";
        $ariaUsername = 'aria-invalid="true" aria-describedby="error-message"';
    }
}
$content = str_replace("[ariaUsername]", $ariaUsername, $content);
$content = str_replace("[ariaPassword]", $ariaPassword, $content);
$content = str_replace("[usernameError]", $usernameError, $content);
$content = str_replace("[passwordError]", $passwordError, $content);

$page = str_replace("[title]", $title, $layout);
$page = str_replace("[keywords]", $keywords, $page);
$page = str_replace("[description]", $description, $page);
$page = str_replace("[breadcrumbs]", $breadcrumbs, $page);
$page = str_replace("[content]", $content, $page);
$page = str_replace("[sidebar]", getSidebar(""), $page);
$page = str_replace("[userToolbar]", $account, $page);
echo $page;
?>