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
        case "gestion":
            if (isset($_SESSION['idUtilisateur'])) {
                $id = $_SESSION['idUtilisateur'];

                $utilisateur = getUtilisateur($id);
                $utilisateurs = getUtilisateurs();

                $nom = $utilisateur['nomUtilisateur'];
                $prenom = $utilisateur['prenomUtilisateur'];

                $titre = "Gestion";
                $bienvenue = "Bienvenue <br> $prenom $nom";
                require "./vues/vueHeader.php";
                require "./vues/vueGestion.php";
                require "./scripts/modifierUtilisateur.php";
                require "./scripts/supprimerUtilisateur.php";
                require "./scripts/ajouterUtilisateur.php";
            } else {
                $titre = "Erreur";
                require "./vues/vueHeader.php";
                require "./vues/vueErreur.php";
            }
            break;
        case "modifierUtilisateur":
            ob_clean();
            header('Content-Type: application/json'); 
        
            // Récupère les données JSON envoyées dans la requête HTTP et les décode en tableau associatif
            $data = json_decode(file_get_contents('php://input'), true);
        
            // Vérifier si l'ID utilisateur est présent
            if (!empty($data['id'])) {
                $id = $data['id'];
                $utilisateur = getUtilisateur($id);
        
                // Mettre à jour les champs utilisateur
                $nom = !empty($data['nom']) ? $data['nom'] : $utilisateur['nomUtilisateur'];
                $prenom = !empty($data['prenom']) ? $data['prenom'] : $utilisateur['prenomUtilisateur'];
                $email = !empty($data['email']) ? $data['email'] : $utilisateur['emailUtilisateur'];
                $mdp = !empty($data['mdp']) ? password_hash($data['mdp'], PASSWORD_DEFAULT) : $utilisateur['MDPUtilisateur'];  // Hacher le mot de passe uniquement si modifié
        
                // Mettre à jour l'utilisateur
                $success = modifierUtilisateur($id, $nom, $prenom, $email, $mdp);
        
                // Renvoyer la réponse JSON
                echo json_encode(['success' => $success]);
            } else {
                echo json_encode(['success' => false, 'message' => 'ID utilisateur manquant']);
            }
            exit();
        case "supprimerUtilisateur":
            ob_clean();
            header('Content-Type: application/json'); 
        
            // Récupère les données JSON envoyées dans la requête HTTP et les décode en tableau associatif
            $data = json_decode(file_get_contents('php://input'), true);
            
            // Récupère tous les utilisateurs de la base de données
            $utilisateurs = getUtilisateurs();
        
            // Vérifie s'il y a un seul utilisateur restant
            if (count($utilisateurs) <= 1) {
                // Renvoie un message d'erreur si c'est le dernier utilisateur
                echo json_encode(['success' => false, 'message' => 'Vous ne pouvez pas supprimer le dernier utilisateur restant.']);
            } else if (!empty($data['id'])) {
                // Si l'ID de l'utilisateur à supprimer est fourni
                $id = $data['id'];
        
                // Appelle la fonction pour supprimer l'utilisateur avec l'ID spécifié
                $success = supprimerUtilisateur($id);
        
                // Renvoie un message de succès ou d'échec en fonction du résultat de la suppression
                echo json_encode(['success' => $success]);
            } else {
                // Si l'ID n'est pas fourni, renvoie un message d'erreur
                echo json_encode(['success' => false]);
            }
            exit();
        case "ajouterUtilisateur":
            ob_clean();
            header('Content-Type: application/json');
        
            // Récupère les données JSON envoyées dans la requête HTTP et les décode en tableau associatif
            $data = json_decode(file_get_contents('php://input'), true);
        
            // Vérifie que les données nécessaires sont présentes
            if (!empty($data['nom']) && !empty($data['prenom']) && !empty($data['email']) && !empty($data['mdp'])) {
                // Récupère les valeurs des données
                $nom = $data['nom'];
                $prenom = $data['prenom'];
                $email = $data['email'];
                // Hachage du mot de passe pour le stockage sécurisé
                $mdp = password_hash($data['mdp'], PASSWORD_DEFAULT);
        
                // Vérifie si l'email existe déjà dans la base de données
                if (emailExiste($email)) {
                    // Renvoie un message d'erreur si l'email est déjà utilisé
                    echo json_encode(['success' => false, 'message' => 'Cet email est déjà utilisé']);
                } else {
                    // Appel de la fonction pour ajouter l'utilisateur dans la base de données
                    $success = ajouterUtilisateur($nom, $prenom, $email, $mdp);
        
                    // Renvoie un message de succès si l'ajout a réussi
                    echo json_encode(['success' => $success]);
                }
            } else {
                // Renvoie un message d'erreur si des données sont manquantes
                echo json_encode(['success' => false, 'message' => 'Données manquantes']);
            }
            exit();
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
        