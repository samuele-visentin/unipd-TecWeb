<?php
require_once("app/global.php");
require_once("components/sidebar.php");

$layout = file_get_contents("templates/layout.html");
$content = file_get_contents("templates/about_layout.html");
$title = 'About | Clue Catchers';
$keywords = 'Chi siamo, Clue Catchers, team di sviluppo, contatti, biografia';
$description = 'Pagina del team di sviluppo di Clue Catchers';
$breadcrumbs = '<p><a href="index.php" lang="en">Home</a> &raquo; Chi siamo</p>';

$page = str_replace("[title]", $title, $layout);
$page = str_replace("[keywords]", $keywords, $page);
$page = str_replace("[description]", $description, $page);
$page = str_replace("[breadcrumbs]", $breadcrumbs, $page);
$page = str_replace("[content]", $content, $page);
$page = str_replace("[sidebar]", getSidebar("ABOUT"), $page);
$page = str_replace("[userToolbar]", getUserToolBar(), $page);
echo $page;
?>