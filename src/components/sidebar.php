<?php
    function getSidebar(string $selected) {
        $sidebar = '<p class="menuSection">Generale</p><ul>';
        $sidebar .= '
                    <li '.($selected == "HOME" ? 'class="menuSelected"' : ""). '>
                        <span class="menuButton" id="iconHome'.($selected == "HOME" ? '-selected' : "").'"></span>'
                        .($selected != "HOME" ? '<a href="index.php" lang="en">Home</a>' : 'Home').
                    '</li>';
        
        $sidebar .= '
                    <li '.($selected == "CASES" ? 'class="menuSelected"' : ""). '>
                        <span class="menuButton" id="iconCases'.($selected == "CASES" ? '-selected' : "").'"></span>'
                        .($selected != "CASES" ? '<a href="cases.php" lang="en">I nostri casi</a>' : 'I nostri casi').
                    '</li>';
        
        $sidebar .= '
                    <li '.($selected == "ABOUT" ? 'class="menuSelected"' : ""). '>
                        <span class="menuButton" id="iconAbout'.($selected == "ABOUT" ? '-selected' : "").'"></span>'
                        .($selected != "ABOUT" ? '<a href="about.php" lang="en">Chi siamo</a>' : 'Chi siamo').
                    '</li>';

        $sidebar .= '
                    <li '.($selected == "FAQ" ? 'class="menuSelected"' : ""). '>
                        <span class="menuButton" id="iconFAQ'.($selected == "FAQ" ? '-selected' : "").'"></span>'
                        .($selected != "FAQ" ? '<a href="faq.php" lang="en"><abbr title="Frequently Asked Questions">FAQ</abbr></a>' : '<abbr title="Frequently Asked Questions">FAQ</abbr>').
                    '</li></ul>';
        return $sidebar;
    }
?>