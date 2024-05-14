<?php

    $action = "accueil";

    if (isset($_POST['action'])) {
        $action = $_POST['action'];
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
        }