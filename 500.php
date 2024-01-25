<?php
    require_once("app/global.php");
    require_once('components/sidebar.php');

    $layout = file_get_contents("templates/layout.html");
    $title = 'Errore 500 | Clue Catchers';
    $keywords = 'Clue Catchers, errore, Errore 500';
    $description = 'Clue Catchers - Pagina di Errore 500';
    $breadcrumbs = '<p><span lang="en">Errore Server</span></p>';
    $content = '
    <h1 class="errorPageTitle"><span lang="en">Error 500</span></h1>
    <h2 class="errorPageVerbose"><span lang="en">Internal Server Error</span></h2>
    <h3 class="errorPageJoke">Oh No! Sembra che il server abbia perso le tracce della pagina! Servirà un <span lang="en">detective</span> bravo per trovarla</h3>
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