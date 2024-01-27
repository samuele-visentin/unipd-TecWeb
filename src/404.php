<?php
    require_once("app/global.php");
    require_once('components/sidebar.php');

    $layout = file_get_contents("templates/error_layout.html");
    $title = 'Errore 404 | Clue Catchers';
    $keywords = 'Clue Catchers, errore, Errore 404';
    $description = 'Clue Catchers - Pagina di Errore 404';
    $content = '
    <h1 class="errorPageTitle"<span lang="en">Error 404</span></h1>
    <h2 class="errorPageVerbose">Questa pagina &egrave scomparsa!</h2>
    <h3 class="errorPageJoke">Oh No! Sembra che non abbiamo piste per trovare questa pagina. Meglio ricontrollare i nostri passi</h3>
    <img class="errorPageImg" alt="" src="assets/images/legoDetectiveError.jpg">
    ';

    $page = str_replace("[title]", $title, $layout);
    $page = str_replace("[keywords]", $keywords, $page);
    $page = str_replace("[description]", $description, $page);
    $page = str_replace("[content]", $content, $page);
    $page = str_replace("[sidebar]", getSidebar("ERROR"), $page);
    $page = str_replace("[userToolbar]", getUserToolBar(), $page);

    echo $page;
?>