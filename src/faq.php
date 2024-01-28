<?php
require_once("app/global.php");
require_once("components/sidebar.php");

$layout = file_get_contents("templates/layout.html");
$content = file_get_contents("templates/faq_layout.html");
$title = 'FAQ | Clue Catchers';
$keywords = 'Clue Catchers, FAQ, Frequently Asked Questions';
$description = 'Pagina delle domande più frequenti';
$breadcrumbs = '<p><a href="index.php" lang="en">Home</a> &raquo; <abbr lang="en" title="Frequently Asked Questions">FAQ</abbr></p>';

$page = str_replace("[title]", $title, $layout);
$page = str_replace("[keywords]", $keywords, $page);
$page = str_replace("[description]", $description, $page);
$page = str_replace("[breadcrumbs]", $breadcrumbs, $page);
$page = str_replace("[content]", $content, $page);
$page = str_replace("[sidebar]", getSidebar("FAQ"), $page);
$page = str_replace("[userToolbar]", getUserToolBar(), $page);
echo $page;
?>