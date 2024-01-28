<?php
require_once("app/global.php");
require_once("components/sidebar.php");
require_once("data/indagine.php");

if(!isset($_SESSION['userId']) || $_SESSION['userId'] === "") {
    header("Location: index.php");
    exit();
}

$layout = file_get_contents("templates/layout.html");
$content = file_get_contents("templates/account_layout.html");
$content = str_replace('[username]', $_SESSION['username'], $content);
$title = 'Account | ' . $TITLE;
$keywords = '';
$description = '';
$breadcrumbs = '<p><a href="index.php" lang="en">Home</a> &raquo; <span lang="en">Account</span></p>';
$account = getUserToolBar(false);
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
$table = '';
$id_title = 'user-title';
if($_SESSION['isAdmin']) {
    $id_title = 'admin-title';
    $table = '<table id="indagini" aria-describedby="sumTabellaIndagini">';
    $table .= '<caption>Indagini:</caption>';
    $table .= '<thead><tr><th scope="col">Titolo</th><th scope="col">Descrizione</th><th scope="col">Data inserimento</th><th scope="col">Recensioni</th></tr></thead>';
    $indagini = getAllIndagine();
    $table .= '<tbody>';
    foreach($indagini as $indagine) {
        $table .= '<tr>';
        $table .= '<th scope="row" data-title="Titolo">' . $indagine->nome . '</th>';
        $table .= '<td data-title="Descrizione">' . $indagine->descrizione . '</td>';
        $table .= '<td data-title="Data">' . $indagine->data_inserimento->format('d/m/Y') . '</td>';
        $table .= '<td data-title="Recensioni"><p><a href="recensioni.php?id='.$indagine->id.'&name='.linkfy($indagine->nome).'">Visualizza recensioni</a></p></td>';
        $table .= '</tr>';
    }
    $table .= '</tbody></table>';
    $table .= '<p id="sumTabellaIndagini">Tutte le indagini con il titolo, descrizione, data e recensioni a loro associati.</p>';
}
$content = str_replace("[idTitle]", $id_title, $content);
$content = str_replace("[ariaUsername]", $ariaUsername, $content);
$content = str_replace("[ariaPassword]", $ariaPassword, $content);
$content = str_replace("[usernameError]", $usernameError, $content);
$content = str_replace("[passwordError]", $passwordError, $content);
$content = str_replace("[table]", $table, $content);

$page = str_replace("[title]", $title, $layout);
$page = str_replace("[keywords]", $keywords, $page);
$page = str_replace("[description]", $description, $page);
$page = str_replace("[breadcrumbs]", $breadcrumbs, $page);
$page = str_replace("[content]", $content, $page);
$page = str_replace("[sidebar]", getSidebar(""), $page);
$page = str_replace("[userToolbar]", $account, $page);
echo $page;
?>