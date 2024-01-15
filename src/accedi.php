<?php
    require_once("app/global.php");
    if($_SESSION["userId"] !== null) {
        header("Location: cases.php");
        exit();
    }
    $layout = file_get_contents("templates/layout.html");
    $keywords = '';
    $description = '';
    $breadcrumbs = '<p><a href="index.php" lang="en">Home</a> >> Accedi</p>';
    $content = file_get_contents("templates/accedi_template.html");
    $menu = '
    <p class="menuSection">Generale</p>
    <ul>
        <li class="menuSelected" id="menuButton-home"><span lang="en">Home</span></li>
        <li id="menuButton-cases"><a href="cases.php">I nostri casi</a></li>
        <li id="menuButton-about"><a href="about.html">Chi siamo</a></li>
        <li id="menuButton-faq"><a href="faq.html" lang="en"><abbr title="Frequently Asked Questions">FAQ</abbr></a></li>
    </ul>
    ';

    $page = str_replace("[title]", $TITLE, $layout);
    $page = str_replace("[keywords]", $keywords, $page);
    $page = str_replace("[description]", $description, $page);
    $page = str_replace("[breadcrumbs]", $breadcrumbs, $page);
    $page = str_replace("[content]", $content, $page);
    $page = str_replace("[menu]", $menu, $page);

    echo $page;

?>