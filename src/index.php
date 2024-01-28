<?php
    require_once("app/global.php");
    require_once('components/sidebar.php');
    require_once("data/indagine.php");

    $layout = file_get_contents("templates/layout.html");
    $title = 'Clue Catchers';
    $keywords = 'Clue Catchers, home, risolvere misteri, [CaseTitle], detective, indizi, gialli, appassionanti storie';
    $description = 'Home del sito Clue Catchers, dove puoi immergerti nell&apos;esperienza di detective';
    $breadcrumbs = '<p><span lang="en">Home</span></p>';
    $content = file_get_contents("templates/index_layout.html");
    $lastIndagine = getLastIndagine();
    $featuredCaseImg = '<img height="600" src="assets'.$lastIndagine->image_path.'" alt="">';  

    $page = str_replace("[title]", $title, $layout);
    $page = str_replace("[keywords]", $keywords, $page);
    $page = str_replace("[description]", $description, $page);
    $page = str_replace("[breadcrumbs]", $breadcrumbs, $page);
    $page = str_replace("[content]", $content, $page);
    $page = str_replace("[sidebar]", getSidebar("HOME"), $page);
    $page = str_replace("[userToolbar]", getUserToolBar(), $page);
    $page = str_replace("[CaseTitle]", $lastIndagine->nome, $page);
    $page = str_replace("[CaseImg]", $featuredCaseImg, $page);
    $page = str_replace("[CaseDesc]", $lastIndagine->descrizione, $page);
    echo $page;
?>