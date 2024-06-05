<?php

session_start();

    $action = "accueil";

    if (isset($_POST['action'])) {
        $action = $_POST['action'];
    } else if (isset($_GET['action'])) {
        $action = $_GET['action'];
    }

    require ("./modeles/modele.inc.php");

    switch($action){
        case "accueil":

            $titre = "Accueil";
            require "./vues/vueHeader.php";
            require "./vues/vueAccueil.php";
            break;
        case "connexion":

            $titre = "Connectez-vous";
            $erreur="";
            require "./vues/vueHeader.php";
            require "./vues/vueConnexion.php";
            break;
        case "connexionMAJ":

            $emailUtilisateur = $_POST["emailUtilisateur"];
            $MDPUtilisateur = $_POST["mdpUtilisateur"];

            $utilisateurs = getUtilisateurs();
            $id = verifConnexion($emailUtilisateur,$MDPUtilisateur,$utilisateurs);

            if ($id == 0){
                $titre ="Connexion";
                $erreur ="Pseudo ou mot de passe incorrect";
                require "./vues/vueHeader.php";
                require "./vues/vueConnexion.php";
            }else if($id == -1){
                $titre="Connexion";
                $erreur="Pseudo ou mot de passe incorrect";
                require "./vues/vueHeader.php";
                require "./vues/vueConnexion.php";
            }else {
                $utilisateur = getUtilisateur($id);
                
                $_SESSION['idUtilisateur'] = $id;

                header("Location: index.php");
            }
            break;
        case "deconnexion":
        
            session_destroy();
            header("Location: index.php");
            break;
        case "traitement_formulaire_contact":

            $titre = "Confirmation d'envois";
            require "./vues/vueHeader.php";
            require "./scripts/traitement_formulaire_contact.php";
            require "./vues/vueConfirmationEnvois.php";
            break;
        case "traitement_formulaire_contact_accueil":

            $titre = "Confirmation d'envois";
            require "./vues/vueHeader.php";
            require "./scripts/traitement_formulaire_contact_accueil.php";
            require "./vues/vueConfirmationEnvois.php";
            break;
        case "traitement_formulaire_devis":

            $titre = "Confirmation d'envois";
            require "./vues/vueHeader.php";
            require "./scripts/traitement_formulaire_devis.php";
            require "./vues/vueConfirmationEnvois.php";
            break;
        case "nousContacter":

            $titre ="Nous contacter";
            require "./vues/vueHeader.php";
            require "./vues/vueNousContacter.php";
            break;
        case "devis":

            $titre ="Votre devis gratuit en ligne";
            require "./vues/vueHeader.php";
            require "./vues/vueDevis.php";
            break;
        case "listeServices":

            $titre ="Tout nos services";
            require "./vues/vueHeader.php";
            require "./vues/vueListeService.php";
            break;
        case "detailFenetre":

            $titre ="Fenêtres";
            require "./vues/vueHeader.php";
            require "./vues/vueDetailService.php";
            break;
        case "detailVelux":

            $titre ="Velux";
            require "./vues/vueHeader.php";
            require "./vues/vueDetailService.php";
            break;
        case "toutesNosRealisations":

            $titre ="Toutes nos réalisations";
            require "./vues/vueHeader.php";
            require "./vues/vueToutesNosRealisations.php";
            break;
        case "realisationVelux":

            $titre ="Nos réalisation de pose de velux";
            require "./vues/vueHeader.php";
            require "./vues/vueDetailRealisation.php";
            break;
        case "realisationFenetre":

            $titre ="Nos réalisation de pose de Fenêtre";
            require "./vues/vueHeader.php";
            require "./vues/vueDetailRealisation.php";
            break;    
        }
        require "./vues/vueFooter.php";
        