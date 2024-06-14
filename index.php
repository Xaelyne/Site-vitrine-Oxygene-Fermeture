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

   switch ($action) {
       case "accueil":
           $titre = "Accueil";
           $services = getServices();
           require "./vues/vueHeader.php";
           require "./vues/vueAccueil.php";
           require "./scripts/ajouterNouveauServices.php";
           require "./scripts/supprimerService.php";
           require "./scripts/modifierService.php";
           break;
   
       case "connexion":
           $titre = "Connectez-vous";
           $erreur = "";
           require "./vues/vueHeader.php";
           require "./vues/vueConnexion.php";
           break;
   
       case "connexionMAJ":
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
   
       case "supprimerUtilisateur":
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
   
       case "ajouterUtilisateur":
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
       case "ajouterService":
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
       case "detailService":
           if (isset($_GET['id'])) {
               $serviceId = $_GET['id'];
               $service = getServiceAvecDetails($serviceId);
               $titre = "Détails du service";
               require "./vues/vueHeader.php";
               require "./vues/vueDetailService.php";
           } else {
               $titre = "Erreur";
               $message = "Service non spécifié.";
               require "./vues/vueHeader.php";
               require "./vues/vueErreur.php";
           }
           break;
       case "modifierService":
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
           
       case "supprimerService":
           if (isset($_GET['id'])) {
               $serviceId = $_GET['id'];
               $success = supprimerService($serviceId);
               echo json_encode(['success' => $success]);
           } else {
               echo json_encode(['success' => false, 'message' => 'ID manquant']);
           }
           exit();
       case "getService":
           if (isset($_GET['id'])) {
               $serviceId = $_GET['id'];
               $service = getServiceAvecDetails($serviceId);
   
               if ($service) {
                   echo json_encode(['success' => true, 'service' => $service]);
               } else {
                   echo json_encode(['success' => false, 'message' => 'Service non trouvé']);
               }
           } else {
               echo json_encode(['success' => false, 'message' => 'ID manquant']);
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
           $titre = "Nous contacter";
           require "./vues/vueHeader.php";
           require "./vues/vueNousContacter.php";
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
       case "toutesNosRealisations":
           $titre = "Toutes nos réalisations";
           require "./vues/vueHeader.php";
           require "./vues/vueToutesNosRealisations.php";
           break;
   
       case "realisationVelux":
           $titre = "Nos réalisation de pose de velux";
           require "./vues/vueHeader.php";
           require "./vues/vueDetailRealisation.php";
           break;
   
       case "realisationFenetre":
           $titre = "Nos réalisation de pose de fenêtre";
           require "./vues/vueHeader.php";
           require "./vues/vueDetailRealisation.php";
           break;
   }
   
   require "./vues/vueFooter.php";
   ?>