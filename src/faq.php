<?php
    $selected="FAQ";
    include_once('components/sidebar.php');
    $layout = file_get_contents("templates/layout.html");

    $title = '<abbr title="Frequently Asked Questions">FAQ</abbr> | Clue Catchers';
    $keywords = '';
    $description = '';
    $breadcrumbs = '<p><a href="index.php" lang="en">Home</a> &raquo; <abbr title="Frequently Asked Questions">FAQ</abbr></p>';
    $content = '';

    $page = str_replace("[title]", $title, $layout);
    $page = str_replace("[keywords]", $keywords, $page);
    $page = str_replace("[description]", $description, $page);
    $page = str_replace("[breadcrumbs]", $breadcrumbs, $page);
    $page = str_replace("[content]", $content, $page);
    $page = str_replace("[sidebar]", $sidebar, $page);

    echo $page;
?>