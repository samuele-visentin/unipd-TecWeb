<?php
    require_once("app/global.php");
    require_once("data/indagine.php");

    /***********************************
        impostazione layout CASE
    ***********************************/
    $caseLayout = file_get_contents("templates/case_layout.html");
    $caseArray = array();
    $cases = getAllIndagine();
    
    foreach($cases as $case) {
        $caseTitle = $case->nome;
        $caseImgPath = isset($case->image_path) ? ($case->image_path) : 'assets/images/img_placeholder.png';
        $caseDescription = $case->descrizione;

        $newCase = str_replace("[caseTitle]", $caseTitle, $caseLayout);
        $newCase = str_replace("[caseImgPath]", $caseImgPath, $newCase);
        $newCase = str_replace("[caseDescription]", $caseDescription, $newCase);
        $caseArray[] = $newCase;
    }

    /***********************************
        impostazione layout PAGE
    ***********************************/

    $layout = file_get_contents("templates/layout.html");

    $title = 'I nostri casi | Clue Catchers';
    $keywords = '';
    $description = '';
    $breadcrumbs = '<p><a href="index.php" lang="en">Home</a> &raquo; I nostri casi</p>';    
    $content = '<h2>I nostri casi</h2>';
    foreach($caseArray as $case) {
        $content = $content.$case;
    }
    $menu = '
        <p class="menuSection">Generale</p>
        <ul>
            <li id="menuButton-home"><a href="index.php" lang="en">Home</a></li>
            <li class="menuSelected" id="menuButton-cases">I nostri casi</li>
            <li id="menuButton-about"><a href="about.html">Chi siamo</a></li>
            <li id="menuButton-faq"><a href="faq.html" lang="en"><abbr title="Frequently Asked Questions">FAQ</abbr></a></li>
        </ul>
    ';

    $page = str_replace("[title]", $title, $layout);
    $page = str_replace("[keywords]", $keywords, $page);
    $page = str_replace("[description]", $description, $page);
    $page = str_replace("[breadcrumbs]", $breadcrumbs, $page);
    $page = str_replace("[content]", $content, $page);
    $page = str_replace("[menu]", $menu, $page);
    $page = str_replace("[userToolbar]", getUserToolBar(), $page);

    echo $page;
?>