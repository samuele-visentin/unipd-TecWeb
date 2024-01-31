<?php
require_once("app/global.php");
require_once("components/sidebar.php");
require_once("data/recensione.php");

if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
    header("Location: index.php");
    exit();
}
if (
    !isset($_GET["id"]) || $_GET["id"] === ""
    || !isset($_GET["name"]) || $_GET["name"] === ""
) {
    header("Location: accedi.php");
    exit();
}
$caseId = $_GET["id"];
$name = $_GET["name"];
$recensioni = getRecensioniByIndagine($caseId);

$layout = file_get_contents("templates/layout.html");
$title = $name . ' | ' . $TITLE;
$keywords = 'recensioni, recensioni per l\'indagine, ' . $name . ', Clue Catchers';
$description = 'Visualizza tutte le recensioni per l\'indagine ' . $name . ' di Clue Catchers.';
$breadcrumbs = '<p><a href="index.php" lang="en">Home</a> &raquo; <a href="account.php" lang="en">Account</a> &raquo; '.$name.'</p>';
$account = getUserToolBar();
$content = '<div id="contenitore-recensioni"><h1 id="title-indagine">Recensioni per l\'indagine: ' . $name . '</h1>';
if ($recensioni !== null) {
    $content .= '<table id="indagini" class="recensioni" aria-describedby="sumTabellaRecensioni">';
    $content .= '<caption>Recensioni:</caption>';
    $content .= '<thead><tr><th scope="col">Recensione</th><th scope="col">Data</th><th scope="col">Id utente</th></tr></thead>';
    $content .= '<tbody>';
    foreach ($recensioni as $recensione) {
        $content .= '<tr>';
        $content .= '<td data-title="Recensione">' . $recensione->contenuto . '</td>';
        $content .= '<td data-title="Data">' . $recensione->data->format('d/m/Y') . '</td>';
        $content .= '<td data-title="Id utente">'.$recensione->id_utente.'</td>';
        $content .= '</tr>';
    }
    $content .= '</tbody></table>';
    $content .= '<p id="sumTabellaRecensioni">Tutte le recensioni con il contenuto, data, data modifica e nome utente a loro associati.</p>';
} else {
    $content .= '<p>Non ci sono recensioni per questa indagine.</p>';
}
$content .= '</div>';
$page = str_replace("[title]", $title, $layout);
$page = str_replace("[keywords]", $keywords, $page);
$page = str_replace("[description]", $description, $page);
$page = str_replace("[breadcrumbs]", $breadcrumbs, $page);
$page = str_replace("[content]", $content, $page);
$page = str_replace("[sidebar]", getSidebar(""), $page);
$page = str_replace("[userToolbar]", $account, $page);
echo $page;
