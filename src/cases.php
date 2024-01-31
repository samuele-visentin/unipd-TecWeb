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
        $caseImgPath = isset($case->image_path) ? ('assets/'.$case->image_path) : 'assets/images/img_placeholder.png';
        $caseDescription = $case->descrizione;

        $newCase = str_replace("[caseTitle]", $caseTitle, $caseLayout);
        $newCase = str_replace("[caseImgPath]", $caseImgPath, $newCase);
        $newCase = str_replace("[caseDescription]", $caseDescription, $newCase);
        $newCase = str_replace("[caseLink]", 'case.php?id='.$case->id, $newCase);
        $caseArray[] = $newCase;
    }

    /***********************************
        impostazione layout PAGE
    ***********************************/
    require_once("components/sidebar.php");
    $layout = file_get_contents("templates/layout.html");

    $title = 'I nostri casi | Clue Catchers';
    $keywords = 'Clue Catchers, i nostri casi, casi di Clue Catchers';
    $description = 'Visualizza tutti i casi di Clue Catchers';
    $breadcrumbs = '<p><a href="index.php" lang="en">Home</a> &raquo; I nostri casi</p>';    
    $content = '<h1>I nostri casi</h1>';
    foreach($caseArray as $case) {
        $content = $content.$case;
    }
    $page = str_replace("[title]", $title, $layout);
    $page = str_replace("[keywords]", $keywords, $page);
    $page = str_replace("[description]", $description, $page);
    $page = str_replace("[breadcrumbs]", $breadcrumbs, $page);
    $page = str_replace("[content]", $content, $page);
    $page = str_replace("[sidebar]", getSidebar("CASES"), $page);
    $page = str_replace("[userToolbar]", getUserToolBar(), $page);

    echo $page;
?>