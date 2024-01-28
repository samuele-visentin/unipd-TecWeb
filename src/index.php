<?php
    require_once("app/global.php");
    require_once('components/sidebar.php');

    $layout = file_get_contents("templates/layout.html");
    $title = 'Home | Clue Catchers';
    $keywords = 'Clue Catchers, risolvere misteri, [CaseTitle]';
    $description = 'Pagina iniziale del sito Clue Catchers, dove puoi provare l&apos esperienza di detective';
    $breadcrumbs = '<p><span lang="en">Home</span></p>';
    $featuredCaseTitle = 'Omicidio al Buio';
    $featuredCaseImg = '<img src="assets/images/indagine1/capitolo0/villa.jpg" alt="Immagine di copertina del caso [CaseTitle]">';
    $featuredCaseDesc = '<h3 class="frontPageCaseDesc">Un omicidio durante una cena al buio, in una villa lussuosa. Solo un vero <span lang="en">Clue Catcher</span> sarà in grado di risolvere il mistero...</h3>';
    $content = '
    <section class="frontPageContent">
        <h2 class="frontPageTitles">Immergiti in appassionanti storie</h2>
        <h3>Hai mai sognato di fare il <span lang="en">detective</span>? Di risolvere misteri? Hai la passione per i gialli? <span lang="en">Clue Catchers</span> è il posto giusto per voi.
        Risolvi casi investigativi tramite semplici domande alle quali dovrai rispondere grazie agli indizi che scopri.</h3>
    <section>

    <section class="frontPageContent">
        <h2 class="frontPageTitles">
        Il nostro ultimo caso:
        <span id="frontPageTitle">[CaseTitle]</span></h2>
        [CaseImg]
        [CaseDesc]
    <section>

    ';

    $page = str_replace("[title]", $title, $layout);
    $page = str_replace("[keywords]", $keywords, $page);
    $page = str_replace("[description]", $description, $page);
    $page = str_replace("[breadcrumbs]", $breadcrumbs, $page);
    $page = str_replace("[content]", $content, $page);
    $page = str_replace("[sidebar]", getSidebar("HOME"), $page);
    $page = str_replace("[userToolbar]", getUserToolBar(), $page);
    $page = str_replace("[CaseTitle]", $featuredCaseTitle, $page);
    $page = str_replace("[CaseImg]", $featuredCaseImg, $page);
    $page = str_replace("[CaseDesc]", $featuredCaseDesc, $page);

    echo $page;
?>