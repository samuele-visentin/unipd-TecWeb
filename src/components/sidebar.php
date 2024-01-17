<?php
    function getSidebar(string $selected, string $caseName = "", string $caseId = "") {
        $needsCaseMenu = array("CASE", "TIMELINE");

        $sidebar = '<p class="menuSection">Generale</p><ul>';
        $sidebar .= '
                    <li id="homeButton" class="menuButton'.($selected == "HOME" ? ' menuSelected"' : '"').'>'
                        .($selected != "HOME" ? '<a href="index.php" lang="en">Home</a>' : 'Home').
                    '</li>';
        
        $sidebar .= '
                    <li id="casesButton" class="menuButton'.($selected == "CASES" ? ' menuSelected"' : '"').'>'
                        .($selected != "CASES" ? '<a href="cases.php" lang="en">I nostri casi</a>' : 'I nostri casi').
                    '</li>';
        
        $sidebar .= '
                    <li id="aboutButton" class="menuButton'.($selected == "ABOUT" ? ' menuSelected"' : '"').'>'
                        .($selected != "ABOUT" ? '<a href="about.php" lang="en">Chi siamo</a>' : 'Chi siamo').
                    '</li>';

        $sidebar .= '
                    <li id="faqButton" class="menuButton'.($selected == "FAQ" ? ' menuSelected"' : '"').'>'
                        .($selected != "FAQ" ? '<a href="faq.php" lang="en"><abbr title="Frequently Asked Questions">FAQ</abbr></a>' : '<abbr title="Frequently Asked Questions">FAQ</abbr>').
                    '</li></ul>';
        
        if(in_array($selected, $needsCaseMenu)) {
            $sidebar .= '<p class="menuSection">'.$caseName.'</p><ul>';
            $sidebar .= '
                        <li id="caseButton" class="menuButton'.($selected == "CASE" ? ' menuSelected"' : '"').'>'
                            .($selected != "CASE" ? '<a href="case.php?id='.$caseId.'">Presentazione</a>' : 'Presentazione').
                        '</li>';
            $sidebar .= '
                        <li id="timelineButton" class="menuButton'.($selected == "TIMELINE" ? ' menuSelected"' : '"').'>'
                            .($selected != "TIMELINE" ? '<a href="timeline.php?id='.$caseId.'">Cronologia</a>' : 'Cronologia').
                        '</li></ul>';
        }
                    
        return $sidebar;
    }
?>