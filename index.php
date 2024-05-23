<?php

    $action = "accueil";

    if (isset($_POST['action'])) {
        $action = $_POST['action'];
    } else if (isset($_GET['action'])) {
        $action = $_GET['action'];
    }

    require ("./modeles/modele.inc.php");

    switch($action){
        case "accueil":
            session_start();
            $titre = "Accueil";
            require "./vues/vueHeader.php";
            require "./vues/vueAccueil.php";
            require "./vues/vueFooter.php";
            break;
        case "traitement_formulaire":
            session_start();
            $titre = "Confirmation d'envois";
            require "./vues/vueHeader.php";
            require "./scripts/traitement_formulaire.php";
            require "./vues/vueConfirmationEnvois.php";
            require "./vues/vueFooter.php";
            break;
        case "nousContacter":
            session_start();
            $titre ="Nous contacter";
            require "./vues/vueHeader.php";
            require "./vues/vueNousContacter.php";
            require "./vues/vueFooter.php";
            break;
        }
        