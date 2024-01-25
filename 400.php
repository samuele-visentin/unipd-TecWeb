<?php
    require_once("app/global.php");
    require_once('components/sidebar.php');

    $layout = file_get_contents("templates/layout.html");
    $title = 'Errore 400 | Clue Catchers';
    $keywords = 'Clue Catchers, errore, Errore 400';
    $description = 'Clue Catchers - Pagina di Errore 400';
    $breadcrumbs = '<p>Errore Server</p>';
    $content = '
    <h1 class="errorPageTitle"<span lang="en">Error 400</span></h1>
    <h2 class="errorPageVerbose"><span lang="en">Bad Request</span></h2>
    <h3 class="errorPageJoke">Oh No! Sembra che il <span lang="en">client<span> abbia formulato un a richiesta anomala</h3>
    ';

    $page = str_replace("[title]", $title, $layout);
    $page = str_replace("[keywords]", $keywords, $page);
    $page = str_replace("[description]", $description, $page);
    $page = str_replace("[breadcrumbs]", $breadcrumbs, $page);
    $page = str_replace("[content]", $content, $page);
    $page = str_replace("[sidebar]", getSidebar("HOME"), $page);
    $page = str_replace("[userToolbar]", getUserToolBar(), $page);
    $page = str_replace('<li id="homeButton" class="menuButton menuSelected">Home</li>', '<li id="homeButton" class="menuButton"><a href="index.php" lang="en">Home</a></li>', $page);

    echo $page;
?>