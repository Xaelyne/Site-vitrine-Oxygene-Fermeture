<?php if(!isset($_SESSION['idUtilisateur'])) {?>

<div class="container-fluid contenu d-flex justify-content-center flex-column align-items-center">
    <div>
        <div class="container formulaireConnexion d-flex justify-content-center my-5">
            <form method="POST" action="index.php" class="container-fluid p-5 formConnexion">
                <input type="hidden" name="action" value="connexionMAJ">

                    <div class="d-flex justify-content-center align-items-center mt-2 mb-5">
                        <h1>Connectez-vous</h1>
                    </div>
                    <div class="d-flex justify-content-center align-items-center mt-2 mb-5">
                        <h2><?= $erreur ?></h2>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="emailUtilisateur" placeholder="Adresse email">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="mdpUtilisateur" placeholder="Mot de passe">
                    </div>
                    <div class="text-center mt-5">
                        <input type="submit" value="Connexion" class="btn bouton">
                    </div>
            </form>
        </div>
    </div>
<?php } else {
?>
    
    <h1  class="text-center text-white py-5 my-5">Vous êtes déjà connecté</h4>


<!-- Bouton permettant de revenir à l'accueil  -->

    <div class="text-center">
        <a href="index.php"><button class="btn bouton">Retour à l'accueil</button></a>
    </div>

<?php } ?>   
</div>