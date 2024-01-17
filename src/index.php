<?php
    require_once("app/global.php");
    require_once('components/sidebar.php');

    $layout = file_get_contents("templates/layout.html");
    $title = 'Clue Catchers';
    $keywords = '';
    $description = '';
    $breadcrumbs = '<p><span lang="en">Home</span></p>';
    $content = '<h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1><h1>ciao</h1>';

    $page = str_replace("[title]", $title, $layout);
    $page = str_replace("[keywords]", $keywords, $page);
    $page = str_replace("[description]", $description, $page);
    $page = str_replace("[breadcrumbs]", $breadcrumbs, $page);
    $page = str_replace("[content]", $content, $page);
    $page = str_replace("[sidebar]", getSidebar("HOME"), $page);
    $page = str_replace("[userToolbar]", getUserToolBar(), $page);

    echo $page;
?>