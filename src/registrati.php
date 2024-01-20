<?php
    require_once("app/global.php");
    require_once("components/sidebar.php");

    if(isset($_SESSION["userId"]) && $_SESSION["userId"] !== "") {
        header("Location: cases.php");
        exit();
    }
    $title = 'Registrati | '.$TITLE;
    $layout = file_get_contents("templates/layout.html");
    $content = file_get_contents("templates/registrati_layout.html");
    $keywords = '';
    $description = '';
    $breadcrumbs = '<p><a href="index.php" lang="en">Home</a> &raquo; Registrati</p>';
    $account = '<li id="loginButton"><a href="accedi.php" lang="en">Log in</a></li>';
    $error = '';
    if(isset($_GET["error"]) && $_GET["error"] !== "") {
        $id_error = $_GET["error"];
        $error = '<p id="error-message">';
        $content = str_replace("[aria]", 'aria-invalid="true" aria-describedby="error-message"', $content);
        switch($id_error) {
            case 1:
                $error .= '<span lang="en">Username</span> non valido</p>';
                break;
            case 2:
                $error .= '<span lang="en">Password</span> non valida</p>';
                break;
            case 3:
                $error .= 'Le <span lang="en">password</span> non coincidono</p>';
                break;
            case 4:
                $error .= 'Combila tutti i campi per poterti registrare</p>';
                break;
            case 5:
                $error .= 'Username già in uso</p>';
                break;
            default:
                $error .= 'Qualcosa è andato storto, riprova</p>';
                break;
        }
    } else {
        $content = str_replace("[aria]", "", $content);
    }
    $page = str_replace("[title]", $title, $layout);
    $page = str_replace("[keywords]", $keywords, $page);
    $page = str_replace("[description]", $description, $page);
    $page = str_replace("[breadcrumbs]", $breadcrumbs, $page);
    $page = str_replace("[content]", $content, $page);
    $page = str_replace("[sidebar]", getSidebar(""), $page);
    $page = str_replace("[userToolbar]", $account, $page);
    $page = str_replace("[errorMessage]", $error, $page);
    echo $page;
?>