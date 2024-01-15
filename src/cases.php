<?php
    require_once("app/global.php");

    $selected="CASES";
    include_once('components/sidebar.php');
    $layout = file_get_contents("templates/layout.html");

    $title = 'I nostri casi | Clue Catchers';
    $keywords = '';
    $description = '';
    $breadcrumbs = '<p><a href="index.php" lang="en">Home</a> &raquo; I nostri casi</p>';
    $content = '';

    $page = str_replace("[title]", $title, $layout);
    $page = str_replace("[keywords]", $keywords, $page);
    $page = str_replace("[description]", $description, $page);
    $page = str_replace("[breadcrumbs]", $breadcrumbs, $page);
    $page = str_replace("[content]", $content, $page);
    $page = str_replace("[sidebar]", $sidebar, $page);
    $page = str_replace("[userToolbar]", getUserToolBar(), $page);

    echo $page;
?>