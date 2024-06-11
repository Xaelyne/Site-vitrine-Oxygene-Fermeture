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