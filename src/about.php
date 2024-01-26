<?php
    require_once("app/global.php");
    require_once('components/sidebar.php');
    $layout = file_get_contents("templates/layout.html");

    $title = 'Chi siamo | Clue Catchers';
    $keywords = 'Chi siamo Clue Catchers, Clue Catchers, team';
    $description = 'Pagina del team di sviluppo di Clue Catchers';
    $breadcrumbs = '<p><a href="index.php" lang="en">Home</a> &raquo; Chi siamo</p>';
    $content = '
    <h1 id="titoloAbout">Il <span lang="en">team</span> di sviluppo di <span lang="en">Clue Catchers</span>:</h1>
    <dl id="membriTeam">
        <dt>Linda Barbiero</dt>
        <dd>
            <img src="../assets/images/img_placeholder.png" alt="Immagine di profilo temporanea">
            <dl class="membro">
                <dt>Contatti: </dt>
                <dd>linda.barbiero.1@studenti.unipd.it</dd>
                <dt>Biografia: </dt>
                <dd>Studentessa dell&apos;Università di Padova della Laurea Triennale di Informatica</dd>
                <dt>Libro preferito: </dt>
                <dd>CIAO</dd>
            </dl>
        </dd>
        <dt>Andrea Mangolini</dt>
        <dd>
            <img src="../assets/images/img_placeholder.png" alt="Immagine di profilo temporanea">
            <dl class="membro">
                <dt>Contatti: </dt>
                <dd>andrea.mangolini@studenti.unipd.it</dd>
                <dt>Biografia: </dt>
                <dd>Studente dell&apos;Università di Padova della Laurea Triennale di Informatica</dd>
                <dt>Libro preferito: </dt>
                <dd>CIAO</dd>
            </dl>
        </dd>
        <dt>Luca Romio</dt>
        <dd>
            <img src="../assets/images/img_placeholder.png" alt="Immagine di profilo temporanea">
            <dl class="membro">
                <dt>Contatti: </dt>
                <dd>luca.romio@studenti.unipd.it</dd>
                <dt>Biografia: </dt>
                <dd>Studente dell&apos;Università di Padova della Laurea Triennale di Informatica. Appassionato di informatica, libri e videogiochi.</dd>
                <dt>Libro preferito: </dt>
                <dd>Il Mastino dei <span lang="en">Baskerville</span> di <span lang="en">Arthur Conan Doyle</span></dd>
            </dl>
        </dd>
        <dt>Samuele Visentin</dt>    
        <dd>
            <img src="../assets/images/img_placeholder.png" alt="Immagine di profilo temporanea">
            <dl class="membro">
                <dt>Contatti: </dt>
                <dd>CIAO</dd>
                <dt>Biografia: </dt>
                <dd>Studente dell&apos;Università di Padova della Laurea Triennale di Informatica</dd>
                <dt>Libro preferito: </dt>
                <dd>CIAO</dd>
            </dl>
        </dd>
    </dl>
    ';

    $page = str_replace("[title]", $title, $layout);
    $page = str_replace("[keywords]", $keywords, $page);
    $page = str_replace("[description]", $description, $page);
    $page = str_replace("[breadcrumbs]", $breadcrumbs, $page);
    $page = str_replace("[content]", $content, $page);
    $page = str_replace("[sidebar]", getSidebar("ABOUT"), $page);
    $page = str_replace("[userToolbar]", getUserToolBar(), $page);

    echo $page;
?>