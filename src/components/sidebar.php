<?php
    require_once("data/capitolo.php");
    require_once("data/salvataggio.php");
    function getSidebar(string $selected, string $caseName = "", string $caseId = "") {
        $needsCaseMenu = array("CASE", "TIMELINE", "WITNESS", "CLUES", "CHAPTER");

        $sidebar = '<p class="menuSection">Generale</p><ul>';
        $sidebar .= '
                    <li id="homeButton" class="menuButton'.($selected == "HOME" ? ' menuSelected"' : '"').'>'
                        .($selected != "HOME" ? '<a href="index.php" lang="en">Home</a>' : 'Home').
                    '</li>';
            
        $sidebar .= '
                    <li id="casesButton" class="menuButton'.($selected == "CASES" ? ' menuSelected"' : '"').'>'
                        .($selected != "CASES" ? '<a href="cases.php">I nostri casi</a>' : 'I nostri casi').
                    '</li>';
            
        $sidebar .= '
                    <li id="aboutButton" class="menuButton'.($selected == "ABOUT" ? ' menuSelected"' : '"').'>'
                        .($selected != "ABOUT" ? '<a href="about.php">Chi siamo</a>' : 'Chi siamo').
                    '</li>';

        $sidebar .= '
                    <li id="faqButton" class="menuButton'.($selected == "FAQ" ? ' menuSelected"' : '"').'>'
                        .($selected != "FAQ" ? '<a href="faq.php"><abbr lang="en" title="Frequently Asked Questions">FAQ</abbr></a>' : '<abbr lang="en" title="Frequently Asked Questions">FAQ</abbr>').
                    '</li></ul>';
        
        if(in_array($selected, $needsCaseMenu)) {

            $sidebar .= '<div class="menuCases">';

            $sidebar .= '<p class="menuSection">'.$caseName.'</p><ul>';
            $sidebar .= '
                        <li id="caseButton" class="menuButton'.($selected == "CASE" ? ' menuSelected"' : '"').'>'
                            .($selected != "CASE" ? '<a href="case.php?id='.$caseId.'">Presentazione</a>' : 'Presentazione').
                        '</li>';
            $sidebar .= '
                        <li id="timelineButton" class="menuButton'.($selected == "TIMELINE" ? ' menuSelected"' : '"').'>'
                            .($selected != "TIMELINE" ? '<a href="timeline.php?id='.$caseId.'">Cronologia</a>' : 'Cronologia').
                        '</li></ul>';
            $sidebar .= '<p class="menuSection">Prove</p><ul>';
            $sidebar .= '
                        <li id="witnessButton" class="menuButton'.($selected == "WITNESS" ? ' menuSelected"' : '"').'>'
                            .($selected != "WITNESS" ? '<a href="witness.php?id='.$caseId.'">Testimonianze</a>' : 'Testimonianze').
                        '</li>';
            $sidebar .= '
                        <li id="cluesButton" class="menuButton'.($selected == "CLUES" ? ' menuSelected"' : '"').'>'
                            .($selected != "CLUES" ? '<a href="clues.php?id='.$caseId.'">Indizi</a>' : 'Indizi').
                        '</li></ul>';

            $userId = (int)$_SESSION["userId"];
            $lastChapter = getLastCapitoloByUtenteAndIndagine($userId, $caseId);
            if(is_null($lastChapter)) {
                $titolo = "Capitolo 0";
                if(isFinished($userId, $caseId)) {
                    $titolo = "Conclusioni";
                }
            } else {
                $titolo = "Capitolo ".$lastChapter;
            }

            $sidebar .= '<p class="menuSection">Capitoli</p><ul>';

            $sidebar .= '
                        <li id="chapterButton" class="menuButton'.($selected == "CHAPTER" ? ' menuSelected"' : '"').'>'
                            .($selected != "CHAPTER" ? '<a href="chapter.php?id='.$caseId.'">'.$titolo.'</a>' : $titolo).
                        '</li>';

            $sidebar .= '</ul></div>';
            /*
            $userId = (int)$_SESSION["userId"];
            $lastChapter = getLastCapitoloByUtenteAndIndagine($userId, $caseId);
            $nChapters = count(getCapitoliByIndagine($caseId));
            $lastChapter = is_null($lastChapter) ? -1 : array_values($lastChapter)[0];

            // Ultimo capitolo possibile, visto che si va in risoluzione di capitoli successivi 
            $lastChapter = $lastChapter == $nChapters - 1 ? $lastChapter - 1 : $lastChapter;
            
            
            
            for ($i = -1; $i <= $lastChapter; $i++) {
                $sidebar .= '
                            <li id="chapterButton" class="menuButton'.($selected == "CHAPTER".($i+1) ? ' menuSelected"' : '"').'>'
                                .($selected != "CHAPTER".($i+1) ? '<a href="chapter.php?id='.$caseId.'&chapter='.($i+1).'">Capitolo '.($i+1).'</a>' : 'Capitolo '.($i+1)).
                            '</li>';
            }
            $sidebar .= '</ul></div>';*/    
        }
                    
        return $sidebar;
    }
?>