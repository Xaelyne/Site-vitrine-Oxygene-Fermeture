<?php
    require("ModeleException.php");

    function getConnexion(){
        if(file_exists("param.ini")){
            $tParam = parse_ini_file("param.ini", true);
            extract($tParam['BDD']);
        } else {
            throw new ModeleException("Fichier param.ini absent");
        }

        $dsn ="mysql:host=$host;dbname=$bdd;";
        return new PDO($dsn, $login, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    function getUtilisateurs() : array{

        $connexion = getConnexion();

        $sql ="SELECT * 
               FROM utilisateurs";

        $resultat = $connexion -> query($sql);

        return $resultat->fetchAll(PDO::FETCH_ASSOC);
    }

    function getUtilisateur($id){

        $connexion = getConnexion();

        $sql ="SELECT *
               FROM utilisateurs
               WHERE identifiantUtilisateur = :id";
               
        $requete = $connexion->prepare($sql);

        $requete->bindParam(':id',$id);

        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);

        return $resultat;
    }

    function verifConnexion($emailUtilisateur,$MDPUtilisateur,$utilisateurs){

        $idUtilisateur = 0;

        foreach($utilisateurs as $utilisateur){
            if ($utilisateur['emailUtilisateur'] == $emailUtilisateur){
                if(password_verify($MDPUtilisateur,$utilisateur['MDPUtilisateur'])){
                    $idUtilisateur = $utilisateur['identifiantUtilisateur'];
                    return $idUtilisateur;
                }else{
                    $idUtilisateur = -1;
                    return $idUtilisateur;
                }
            }
        }
        return $idUtilisateur;
    }

    function modifierUtilisateur($id, $nom, $prenom, $email, $mdp) {
        $connexion = getConnexion();
    
        $sql = "UPDATE utilisateurs
                SET nomUtilisateur = :nom, prenomUtilisateur = :prenom, emailUtilisateur = :email, MDPUtilisateur = :mdp
                WHERE identifiantUtilisateur = :id";
        
        $requete = $connexion->prepare($sql);
    
        $requete->bindParam(':id', $id);
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':prenom', $prenom);
        $requete->bindParam(':email', $email);
        $requete->bindParam(':mdp', $mdp);
    
        return $requete->execute();
    }

    function supprimerUtilisateur($id) {
        $connexion = getConnexion();
    
        $sql = "DELETE 
                FROM utilisateurs 
                WHERE identifiantUtilisateur = :id";
        $requete = $connexion->prepare($sql);
        $requete->bindParam(':id', $id);
        
        return $requete->execute();
    }
    function ajouterUtilisateur($nom, $prenom, $email, $mdp) {
        $connexion = getConnexion();
        $sql = "INSERT INTO utilisateurs (nomUtilisateur, prenomUtilisateur, emailUtilisateur, MDPUtilisateur) VALUES (:nom, :prenom, :email, :mdp)";
    
        $requete = $connexion->prepare($sql);
    
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':prenom', $prenom);
        $requete->bindParam(':email', $email);
        $requete->bindParam(':mdp', $mdp);
    
        return $requete->execute();
    }

    function emailExiste($email) {
        $connexion = getConnexion();
        $sql = "SELECT COUNT(*) FROM utilisateurs WHERE emailUtilisateur = :email";
    
        $requete = $connexion->prepare($sql);
        $requete->bindParam(':email', $email);
        $requete->execute();
    
        return $requete->fetchColumn() > 0;
    }
    function getServices() {
        $connexion = getConnexion();
        $sql = "SELECT identifiantService as id, nomService as nom, imageService as image FROM services";
        $resultat = $connexion->query($sql);
        return $resultat->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function getServiceAvecDetails($serviceId) {
        $connexion = getConnexion();
        $sql = "SELECT s.identifiantService AS id, s.nomService AS nom, s.imageService AS image, d.descriptionDetail AS detail
                FROM services s
                INNER JOIN detailservice d ON s.identifiantService = d.identifiantService
                WHERE s.identifiantService = :serviceId";
        
        $requete = $connexion->prepare($sql);
        $requete->bindParam(':serviceId', $serviceId);
        $requete->execute();
    
        $serviceAvecDetails = [
            'id' => $serviceId,
            'nom' => '',
            'image' => '',
            'details' => []
        ];
    
        while ($row = $requete->fetch(PDO::FETCH_ASSOC)) {
            if (empty($serviceAvecDetails['nom'])) {
                $serviceAvecDetails['nom'] = $row['nom'];
                $serviceAvecDetails['image'] = $row['image'];
            }
            if ($row['detail'] !== null) {
                $serviceAvecDetails['details'][] = $row['detail'];
            }
        }
    
        return $serviceAvecDetails;
    }
    
    function ajouterServiceAvecDetails($nom, $image, $details) {
        $connexion = getConnexion();
        $sql = "INSERT INTO services (nomService, imageService) VALUES (:nom, :image)";
        $requete = $connexion->prepare($sql);
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':image', $image);
        $requete->execute();
        $serviceId = $connexion->lastInsertId();
    
        foreach ($details as $detail) {
            $sqlDetail = "INSERT INTO detailservice (identifiantService, descriptionDetail) VALUES (:serviceId, :detail)";
            $requeteDetail = $connexion->prepare($sqlDetail);
            $requeteDetail->bindParam(':serviceId', $serviceId);
            $requeteDetail->bindParam(':detail', $detail);
            $requeteDetail->execute();
        }
    
        return $serviceId;
    }

    function supprimerService($serviceId) {
        $connexion = getConnexion();
        
        // Supprimez d'abord les détails du service
        $sql = "DELETE FROM detailservice WHERE identifiantService = :serviceId";
        $requete = $connexion->prepare($sql);
        $requete->bindParam(':serviceId', $serviceId);
        $requete->execute();
        
        // Ensuite, supprimez le service
        $sql = "DELETE FROM services WHERE identifiantService = :serviceId";
        $requete = $connexion->prepare($sql);
        $requete->bindParam(':serviceId', $serviceId);
        return $requete->execute();
    }
    