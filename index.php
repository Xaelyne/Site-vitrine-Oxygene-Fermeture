<?php

   session_start();

   $action = "accueil";
   
   if (isset($_POST['action'])) {
       $action = $_POST['action'];
   } else if (isset($_GET['action'])) {
       $action = $_GET['action'];
   }
   
   require("./modeles/modele.inc.php");
   
   $services = getServices();
   $infoEntreprise = getInformationEntreprise();

   switch ($action) {
       case "accueil":
           $titre = "Accueil";
           $services = getServices();
           $partenaires = getPartenaires();
           $avis = getAvis();
           require "./vues/vueHeader.php";
           require "./vues/vueAccueil.php";
           require "./scripts/ajouterNouveauServices.php";
           require "./scripts/supprimerService.php";
           require "./scripts/modifierService.php";
           require "./scripts/ajouterPatenaires.php";
           require "./scripts/supprimerPartenaire.php";
           require "./scripts/modifierPartenaires.php";
           require "./scripts/ajouterNouvelAvis.php";
           break;
   
       case "connexion":
           $titre = "Connectez-vous";
           $erreur = "";
           require "./vues/vueHeader.php";
           require "./vues/vueConnexion.php";
           break;
   
       case "connexionMAJ":
            if (isset($_POST['emailUtilisateur']) && isset($_POST['mdpUtilisateur'])) {
                $emailUtilisateur = $_POST["emailUtilisateur"];
                $MDPUtilisateur = $_POST["mdpUtilisateur"];
                $utilisateurs = getUtilisateurs();
                $id = verifConnexion($emailUtilisateur, $MDPUtilisateur, $utilisateurs);
        
                if ($id <= 0) {
                    $titre = "Connexion";
                    $erreur = "Pseudo ou mot de passe incorrect";
                    require "./vues/vueHeader.php";
                    require "./vues/vueConnexion.php";
                } else {
                    $_SESSION['idUtilisateur'] = $id;
                    header("Location: index.php");
                }
            } else {
                $titre = "Erreur";
                require "./vues/vueHeader.php";
                require "./vues/vueErreur.php";
            }
           break;
   
       case "deconnexion":
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'deconnexion') {
                session_destroy();
                header("Location: index.php");
                break;
            } else {

                $titre = "Erreur";
                require "./vues/vueHeader.php";
                require "./vues/vueErreur.php";
            }
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
               require "./scripts/modifierInformation.php";
           } else {
               $titre = "Erreur";
               require "./vues/vueHeader.php";
               require "./vues/vueErreur.php";
           }
           break;
   
       case "modifierUtilisateur":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
            ob_clean();
            header('Content-Type: application/json'); 
            $data = json_decode(file_get_contents('php://input'), true);

            if (!empty($data['id'])) {
                $id = $data['id'];
                $utilisateur = getUtilisateur($id);
                $nom = !empty($data['nom']) ? $data['nom'] : $utilisateur['nomUtilisateur'];
                $prenom = !empty($data['prenom']) ? $data['prenom'] : $utilisateur['prenomUtilisateur'];
                $email = !empty($data['email']) ? $data['email'] : $utilisateur['emailUtilisateur'];
                $mdp = !empty($data['mdp']) ? password_hash($data['mdp'], PASSWORD_DEFAULT) : $utilisateur['MDPUtilisateur'];
                $success = modifierUtilisateur($id, $nom, $prenom, $email, $mdp);
                echo json_encode(['success' => $success]);
            } else {
                echo json_encode(['success' => false, 'message' => 'ID utilisateur manquant']);
            }
            exit();
        } else {
            $titre = "Erreur";
            require "./vues/vueHeader.php";
            require "./vues/vueErreur.php";
            
        }
        break;
   
       case "supprimerUtilisateur":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 

           ob_clean();
           header('Content-Type: application/json'); 
           $data = json_decode(file_get_contents('php://input'), true);
           $utilisateurs = getUtilisateurs();
   
           if (count($utilisateurs) <= 1) {
               echo json_encode(['success' => false, 'message' => 'Vous ne pouvez pas supprimer le dernier utilisateur restant.']);
           } else if (!empty($data['id'])) {
               $success = supprimerUtilisateur($data['id']);
               echo json_encode(['success' => $success]);
           } else {
               echo json_encode(['success' => false]);
           }
           exit();
        } else {
            $titre = "Erreur";
            require "./vues/vueHeader.php";
            require "./vues/vueErreur.php";
            
        }
        break;
   
       case "ajouterUtilisateur":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
           ob_clean();
           header('Content-Type: application/json');
           $data = json_decode(file_get_contents('php://input'), true);
   
           if (!empty($data['nom']) && !empty($data['prenom']) && !empty($data['email']) && !empty($data['mdp'])) {
               $nom = $data['nom'];
               $prenom = $data['prenom'];
               $email = $data['email'];
               $mdp = password_hash($data['mdp'], PASSWORD_DEFAULT);
               if (emailExiste($email)) {
                   echo json_encode(['success' => false, 'message' => 'Cet email est déjà utilisé']);
               } else {
                   $success = ajouterUtilisateur($nom, $prenom, $email, $mdp);
                   echo json_encode(['success' => $success]);
               }
           } else {
               echo json_encode(['success' => false, 'message' => 'Données manquantes']);
           }
           exit();
        } else {
            $titre = "Erreur";
            require "./vues/vueHeader.php";
            require "./vues/vueErreur.php";
            
        }
        break;
       case "ajouterService":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
           ob_clean();
           header('Content-Type: application/json');
           $nom = $_POST['nom'];
           $details = $_POST['details'];
           $image = $_FILES['image'];
           $targetDir = "images/";
           $targetFile = $targetDir . basename($image["name"]);
           move_uploaded_file($image["tmp_name"], $targetFile);
           $serviceId = ajouterServiceAvecDetails($nom, $targetFile, $details);
           echo json_encode(['success' => true]);
           exit();
        } else {
            $titre = "Erreur";
            require "./vues/vueHeader.php";
            require "./vues/vueErreur.php";
            
        }
        case "detailService":
        if (isset($_GET['id'])) {
            $serviceId = $_GET['id'];
            $service = getServiceAvecDetails($serviceId);
            
            if ($service) {
                $titre = "Détails du service";
                require "./vues/vueHeader.php";
                require "./vues/vueDetailService.php";
            } else {
                $titre = "Erreur";
                $message = "Service non trouvé.";
                require "./vues/vueHeader.php";
                require "./vues/vueErreur.php";
            }
        } else {
            $titre = "Erreur";
            $message = "Service non spécifié.";
            require "./vues/vueHeader.php";
            require "./vues/vueErreur.php";
        }
        break;
       case "modifierService":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
            ob_start(); // Démarre la capture de sortie
            header('Content-Type: application/json');
            try {
                $id = $_POST['id'];
                $nom = $_POST['nom'];
                $details = $_POST['details'];
                $image = $_FILES['image'];

                if ($image['size'] > 0) {
                    $targetDir = "images/";
                    $targetFile = $targetDir . basename($image["name"]);
                    move_uploaded_file($image["tmp_name"], $targetFile);
                } else {
                    $targetFile = $_POST['image'];
                }

                $success = modifierService($id, $nom, $targetFile, $details);
                $response = ['success' => $success];
            } catch (Exception $e) {
                $response = ['success' => false, 'message' => $e->getMessage()];
            }
            ob_end_clean(); // Récupère et nettoie le tampon de sortie
            echo json_encode($response);
            exit();
        } else {
            $titre = "Erreur";
            require "./vues/vueHeader.php";
            require "./vues/vueErreur.php";
            
        }
        break;
        case "supprimerService":
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $serviceId = (int) $_GET['id'];
                error_log("Requête de suppression de service reçue avec ID: " . $serviceId);
                $success = supprimerService($serviceId);
                error_log("Résultat de la suppression du service avec ID $serviceId: " . json_encode(['success' => $success]));
                echo json_encode(['success' => $success]);
                exit();
            } else {
                $titre = "Erreur";
                require "./vues/vueHeader.php";
                require "./vues/vueErreur.php";

            }
            break;
       case "getService":
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $serviceId = (int) $_GET['id'];
            $service = getServiceAvecDetails($serviceId);
    
            if ($service) {
                echo json_encode(['success' => true, 'service' => $service]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Service non trouvé']);
            }
        } else {
            $titre = "Erreur";
            require "./vues/vueHeader.php";
            require "./vues/vueErreur.php";
            require "./vues/vueFooter.php";
        }
        exit();
        case "getPartenaire":
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $partenaireId = (int) $_GET['id'];
                $partenaire = getPartenaire($partenaireId);
        
                if ($partenaire) {
                    echo json_encode(['success' => true, 'partenaire' => $partenaire]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Partenaire non trouvé']);
                }
            } else {
                $titre = "Erreur";
                require "./vues/vueHeader.php";
                require "./vues/vueErreur.php";
                require "./vues/vueFooter.php";
            }
            exit();
        case "getRealisation":
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $realisationId = (int) $_GET['id'];
                $realisation = getRealisation($realisationId);
        
                if ($realisation) {
                    echo json_encode(['success' => true, 'realisation' => $realisation]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Réalisation non trouvée']);
                }
            } else {
                $titre = "Erreur";
                require "./vues/vueHeader.php";
                require "./vues/vueErreur.php";
                require "./vues/vueFooter.php";
            }
            exit();
        
        case "ajouterPartenaire":
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom']) && isset($_FILES['image']) && isset($_POST['lien'])) {
                ob_clean();
                header('Content-Type: application/json');
                try {
                    $nom = $_POST['nom'];
                    $lien = $_POST['lien'];
                    $image = $_FILES['image'];
                    $targetDir = "images/";
                    $targetFile = $targetDir . basename($image["name"]);
                    move_uploaded_file($image["tmp_name"], $targetFile);
                    $success = ajouterPartenaire($nom, $targetFile, $lien);
                    $response = ['success' => $success];
                } catch (Exception $e) {
                    $response = ['success' => false, 'message' => $e->getMessage()];
                }
                echo json_encode($response);
            } else {
                $titre = "Erreur";
                require "./vues/vueHeader.php";
                require "./vues/vueErreur.php";
                require "./vues/vueFooter.php";
            }
            exit();
        case "modifierPartenaire":
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['nom']) && isset($_POST['lien'])) {
                ob_clean();
                header('Content-Type: application/json');
                try {
                    $id = $_POST['id'];
                    $nom = $_POST['nom'];
                    $lien = $_POST['lien'];
                    $image = $_FILES['image'];
        
                    if ($image['size'] > 0) {
                        $targetDir = "images/";
                        $targetFile = $targetDir . basename($image["name"]);
                        move_uploaded_file($image["tmp_name"], $targetFile);
                    } else {
                        $targetFile = $_POST['image'];
                    }
        
                    $success = modifierPartenaire($id, $nom, $targetFile, $lien);
                    $response = ['success' => $success];
                } catch (Exception $e) {
                    $response = ['success' => false, 'message' => $e->getMessage()];
                }
                ob_end_clean();
                echo json_encode($response);
            } else {
                $titre = "Erreur";
                require "./vues/vueHeader.php";
                require "./vues/vueErreur.php";
                require "./vues/vueFooter.php";
            }
            exit();
        case "supprimerPartenaire":
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $partenaireId = (int) $_GET['id'];
                $success = supprimerPartenaire($partenaireId);
                echo json_encode(['success' => $success]);
            } else {
                $titre = "Erreur";
                require "./vues/vueHeader.php";
                require "./vues/vueErreur.php";
                require "./vues/vueFooter.php";
            }
            exit();
       case "traitement_formulaire_contact":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = "Confirmation d'envois";
            require "./vues/vueHeader.php";
            require "./scripts/traitement_formulaire_contact.php";
            require "./vues/vueConfirmationEnvois.php";
        } else {
            $titre = "Erreur";
            $message = "Accès non autorisé.";
            require "./vues/vueHeader.php";
            require "./vues/vueErreur.php";
        }
        break;
   
       case "traitement_formulaire_contact_accueil":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = "Confirmation d'envois";
            require "./vues/vueHeader.php";
            require "./scripts/traitement_formulaire_contact_accueil.php";
            require "./vues/vueConfirmationEnvois.php";
        } else {
            $titre = "Erreur";
            $message = "Accès non autorisé.";
            require "./vues/vueHeader.php";
            require "./vues/vueErreur.php";
        }
        break;
   
       case "traitement_formulaire_devis":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = "Confirmation d'envois";
            require "./vues/vueHeader.php";
            require "./scripts/traitement_formulaire_devis.php";
            require "./vues/vueConfirmationEnvois.php";
        } else {
            $titre = "Erreur";
            $message = "Accès non autorisé.";
            require "./vues/vueHeader.php";
            require "./vues/vueErreur.php";
        }
        break;
        case "traitement_formulaire_avis":
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $titre = "Confirmation d'envois";
                require "./vues/vueHeader.php";
                require "./scripts/traitement_formulaire_avis.php";
                require "./vues/vueConfirmationEnvoisAvis.php";
            } else {
                $titre = "Erreur";
                $message = "Accès non autorisé.";
                require "./vues/vueHeader.php";
                require "./vues/vueErreur.php";
            }
            break;
   
       case "nousContacter":
           $titre = "Nous contacter";
           require "./vues/vueHeader.php";
           require "./vues/vueNousContacter.php";
           break;
        case "mentionsLegales":
            $titre = "Mentions légales";
            require "./vues/vueHeader.php";
            require "./vues/vueMentionsLegales.php";
            break;
    
       case "devis":
           $titre = "Votre devis gratuit en ligne";
           require "./vues/vueHeader.php";
           require "./vues/vueDevis.php";
           break;
   
       case "listeServices":
           $services = getServices();
           $titre = "Tous nos services";
           require "./vues/vueHeader.php";
           require "./vues/vueListeService.php";
           break;

        case "realisationService":
            if (isset($_GET['id'])) {
                $serviceId = $_GET['id'];
                $service = getServiceAvecDetails($serviceId);
        
                if ($service) {
                    $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
                    $limit = 10;
                    $realisations = getRealisationsParService($serviceId, $offset, $limit);
                    $totalRealisations = getNombreTotalRealisationsParService($serviceId);
                    $titre = "Réalisations de " . htmlspecialchars($service['nom']);
                    require "./vues/vueHeader.php";
                    require "./vues/vueDetailRealisation.php";
                    require "./scripts/ajouterRealisation.php";
                } else {
                    $titre = "Erreur";
                    $message = "Service non trouvé.";
                    require "./vues/vueHeader.php";
                    require "./vues/vueErreur.php";
                }
            } else {
                $titre = "Erreur";
                $message = "Service non spécifié.";
                require "./vues/vueHeader.php";
                require "./vues/vueErreur.php";
            }
            break;
        case "ajouterRealisation":
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                ob_clean();
                header('Content-Type: application/json');
                try {
                    $nom = $_POST['nom'];
                    $serviceId = $_POST['serviceId'];
                    $image = $_FILES['image'];
                    $targetDir = "images/";
                    $targetFile = $targetDir . basename($image["name"]);
                    move_uploaded_file($image["tmp_name"], $targetFile);
                    $success = ajouterRealisation($nom, $targetFile, $serviceId);
                    $response = ['success' => $success];
                } catch (Exception $e) {
                    $response = ['success' => false, 'message' => $e->getMessage()];
                }
                echo json_encode($response);
                exit();
            } else {
                $titre = "Erreur";
                require "./vues/vueHeader.php";
                require "./vues/vueErreur.php";
            }
            break;
        case "toutesNosRealisations":
            $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
            $limit = 10;
            $toutesRealisations = getRealisations($offset, $limit);
            $totalRealisations = getNombreTotalRealisations(); // Ajoutez cette fonction dans le modèle pour obtenir le nombre total de réalisations
            $titre = "Toutes nos réalisations";
            require "./vues/vueHeader.php";
            require "./vues/vueToutesNosRealisations.php";
            require "./scripts/ajouterRealisation.php";
            require "./scripts/supprimerRealisation.php";
            require "./scripts/modifierRealisation.php";
            break;
        case "modifierRealisation":
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                ob_clean();
                header('Content-Type: application/json');
                try {
                    if (isset($_POST['id'], $_POST['nom'], $_POST['serviceId'])) {
                        $id = $_POST['id'];
                        $nom = $_POST['nom'];
                        $serviceId = $_POST['serviceId'];
                        $image = isset($_FILES['image']) ? $_FILES['image'] : null;
        
                        if ($image && $image['size'] > 0) {
                            $targetDir = "images/";
                            $targetFile = $targetDir . basename($image["name"]);
                            move_uploaded_file($image["tmp_name"], $targetFile);
                        } else {
                            $targetFile = getImageRealisation($id);
                        }
        
                        $success = modifierRealisation($id, $nom, $targetFile, $serviceId);
                        $response = ['success' => $success];
                    } else {
                        $response = ['success' => false, 'message' => 'Paramètres manquants'];
                    }
                } catch (Exception $e) {
                    $response = ['success' => false, 'message' => $e->getMessage()];
                }
                echo json_encode($response);
                exit();
            } else {
                $titre = "Erreur";
                require "./vues/vueHeader.php";
                require "./vues/vueErreur.php";
            }
            break;
        case "supprimerRealisation":
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $realisationId = (int) $_GET['id'];
                $success = supprimerRealisation($realisationId);
                echo json_encode(['success' => $success]);
            } else {
                $titre = "Erreur";
                require "./vues/vueHeader.php";
                require "./vues/vueErreur.php";
                require "./vues/vueFooter.php";
            }
            exit();
        case "avis":
            $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
            $limit = 10;
            $avis = getAvis($offset, $limit);
            $totalAvis = getNombreTotalAvis();
            $titre = "Avis";
            require "./vues/vueHeader.php";
            require "./vues/vueAvis.php";
            require "./scripts/ajouterNouvelAvis.php";
            require "./scripts/supprimerAvis.php";
            require "./scripts/modifierAvis.php";
            break;
        case "ajouterAvis":
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $prenomClientAvis = $_POST['ajoutNomFormulaireAvis'];
                $etoileAvis = isset($_POST['ajoutNoteFormulaireAvis']) ? (int)$_POST['ajoutNoteFormulaireAvis'] : 0;
                $commentaireAvis = $_POST['ajoutCommentaireFormulaireAvis'];
            
                if (!empty($prenomClientAvis) && !empty($commentaireAvis)) {
                    $success = ajouterAvis($prenomClientAvis, $etoileAvis, $commentaireAvis);
                    echo json_encode(['success' => $success]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Veuillez remplir tous les champs obligatoires.']);
                }
                exit();
            } else {
                $titre = "Erreur";
                $message = "Accès non autorisé.";
                require "./vues/vueHeader.php";
                require "./vues/vueErreur.php";
            }
            break;
        case "supprimerAvis":
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $idAvis = (int) $_GET['id'];
                $success = supprimerAvis($idAvis);
                echo json_encode(['success' => $success]);
            } else {
                $titre = "Erreur";
                require "./vues/vueHeader.php";
                require "./vues/vueErreur.php";
                require "./vues/vueFooter.php";
            }
            exit();
        case "modifierAvis":
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $idAvis = $_POST['idAvis'];
                $prenomClientAvis = $_POST['prenom'];
                $etoileAvis = isset($_POST['note']) ? (int)$_POST['note'] : 0;
                $commentaireAvis = $_POST['commentaire'];
            
                if (!empty($prenomClientAvis) && !empty($commentaireAvis)) {
                    $success = modifierAvis($idAvis, $prenomClientAvis, $etoileAvis, $commentaireAvis);
                    echo json_encode(['success' => $success]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Veuillez remplir tous les champs obligatoires.']);
                }
                exit();
            } else {
                $titre = "Erreur";
                require "./vues/vueHeader.php";
                require "./vues/vueErreur.php";
            }
            break;
        case "modifierInformationsEntreprise":
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                ob_clean();
                header('Content-Type: application/json');
                $data = json_decode(file_get_contents('php://input'), true);
            
                // Récupérer les informations actuelles de l'entreprise
                $infoEntreprise = getInformationEntreprise();
                
                $telephone = !empty($data['telephone']) ? $data['telephone'] : $infoEntreprise['telephoneEntreprise'];
                $adresse = !empty($data['adresse']) ? $data['adresse'] : $infoEntreprise['adresseEntreprise'];
                $codePostal = !empty($data['codePostal']) ? $data['codePostal'] : $infoEntreprise['codePostalEntreprise'];
                $ville = !empty($data['ville']) ? $data['ville'] : $infoEntreprise['villeEntreprise'];
            
                $success = modifierInformationsEntreprise($telephone, $adresse, $codePostal, $ville);
                echo json_encode(['success' => $success]);
                exit();
            } else {
                $titre = "Erreur";
                require "./vues/vueHeader.php";
                require "./vues/vueErreur.php";
            }
            break;
   }
   
   require "./vues/vueFooter.php";
   ?>