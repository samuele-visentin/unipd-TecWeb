<?php
    require_once("app/global.php");
    require_once('components/sidebar.php');

    $layout = file_get_contents("templates/layout.html");

    $title = 'FAQ | Clue Catchers';
    $keywords = 'Clue Catchers, FAQ, Frequently Asked Questions';
    $description = 'Pagina delle domande più frequenti';
    $breadcrumbs = '<p><a href="index.php" lang="en">Home</a> &raquo; <abbr title="Frequently Asked Questions">FAQ</abbr></p>';
    $content = '
    <h1 id="titoloFAQ"><abbr title="Frequently Asked Questions">FAQ</abbr></h1>
    <section class="singleFAQ">
        <img src="assets/icons/darkicons/search.svg" tabindex=-1>
        <strong>Cos&apos;è <span lang="en">Clue Catchers</span>?</strong>
        <p><span lang="en">Clue Catchers</span> è un nuovo modo di scoprire storie di mistero grazie ad un&apos;interfaccia interattiva che ti guida nella risoluzione dei casi, come un vero <span lang="en"> detective.</span></p>
    </section>
    <section class="singleFAQ">
        <img src="assets/icons/darkicons/search.svg" tabindex=-1>
        <strong>Perchè devo registrarmi su <span lang="en">Clue Catchers</span> per provare l&apos;esperienza?</strong>
        <p>La registrazione è necessaria per garantire al <span lang="en">detective</span> in erba di avere la possibilità di salvare i progressi e continuare il caso più avanti.
        Un utente registrato è anche in grado di fornire una valutazione dell&apos;esperienza dopo aver concluso la storia, cosa necessaria al continuo miglioramento del sito.</p>
    </section>
    <section class="singleFAQ">
        <img src="assets/icons/darkicons/search.svg" tabindex=-1>
        <strong>Che tipo di dati raccogliete sui vostri utenti?</strong>
        <p>Nonostante il tema del nostro sito, i vostri dati sono al sicuro! Il <span lang="en">team</span> di <span lang="en">Clue Catchers</span> si batte per mantenere la <span lang="en">privacy</span> dell&apos;utente chiedendo solo il minimo necessario per la registrazione (un semplice indirizzo di posta elettronica).</p>
    </section>
    <section class="singleFAQ">
        <img src="assets/icons/darkicons/search.svg" tabindex=-1>
        <strong>Quante storie sono pensate o in programma?</strong>
        <p>Il nostro <span lang="en">team</span> è sempre al lavoro per fornire più storie e sfide ai propri utenti. Questo avviene tramite nuove storie, storie più complesse e collaborazioni con scrittori famosi (<span lang="en">Coming soon!</span>).</p>
    </section>
    <section class="singleFAQ">
        <img src="assets/icons/darkicons/search.svg" tabindex=-1>
        <strong>Un libro che mi piace tantissimo sarebbe perfetto per <span lang="en">Clue Catchers</span>, potreste adattarlo?</strong>
        <p>In futuro prevediamo la possibilità che i nostri utenti più attivi siano in grado di suggerire libri tramite sondaggi e suggerimenti liberi. Questa funzione non è al momento disponibile ma è in cima alla lista delle nostre priorità.</p>
    </section>
    <section class="singleFAQ">
        <img src="assets/icons/darkicons/search.svg" tabindex=-1>
        <strong><span lang="en">Clue Catchers</span> per varie ragioni non è usufribile da un mio conoscente, come si pone il <span lang="en">team</span> di <span lang="en">Clue Catchers</span>?</strong>
        <p>Il nostro team punta a creare un&apos;esperienza utente il più accessibile possibile ma a volte questo non basta. Una sezione di <span lang="en">feedback</span> mirata è in sviluppo per dimostrare la volontà del <span lang="en">team</span> di mantenere questo impegno.</p>
    </section>
    ';

    $page = str_replace("[title]", $title, $layout);
    $page = str_replace("[keywords]", $keywords, $page);
    $page = str_replace("[description]", $description, $page);
    $page = str_replace("[breadcrumbs]", $breadcrumbs, $page);
    $page = str_replace("[content]", $content, $page);
    $page = str_replace("[sidebar]", getSidebar("FAQ"), $page);
    $page = str_replace("[userToolbar]", getUserToolBar(), $page);

    echo $page;
?>