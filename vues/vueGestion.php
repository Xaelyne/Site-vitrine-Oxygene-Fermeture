<?php 
if(isset($_SESSION['idUtilisateur'])) {
?>

<div class="container-fluid contenu d-flex justify-content-center flex-column align-items-center">
    <div class="container bordure">
        <h1 class="py-5 text-center texte "><?= $bienvenue ?></h1>
        <div class="monTableau">
            <div class="tabs text-center d-flex justify-content-between">
                <button class="tablinks active fw-bold" onclick="openTab(event, 'ListeUtilisateurs')">Liste des utilisateurs</button>
                <button class="tablinks fw-bold" onclick="openTab(event, 'ModifInfoEntreprise')">Modification des informations de l'entreprise</button>
            </div>
            <div id="ListeUtilisateurs" class="tabcontent" style="display: block;">
                <div class="my-5 py-5 px-5">
                    <table class="table tableau"
                        data-toggle="table"
                        data-toolbar="#toolbar"
                        data-search="true"
                        data-show-columns="true"
                        data-show-columns-toggle-all="true"
                        data-click-to-select="true"
                        data-minimum-count-columns="2"
                        data-mobile-responsive="true"
                        data-pagination="true"
                        data-id-field="id"
                        data-page-list="[5, 10, 25, 50, all]"
                        data-page-size="5"
                        data-side-pagination="Utilisateur"
                        data-response-handler="responseHandler"
                        data-pagination-pre-text="Précédent"
                        data-pagination-next-text="Suivant"
                        data-locale="fr-FR"
                        data-reorderable-columns="true">
                        <thead>
                            <tr>
                                <th data-field="nomUtilisateur" data-sortable="true" class="success">Nom</th>
                                <th data-field="prenomUtilisateur" data-sortable="true" class="success">Prénom</th>
                                <th data-field="emailUtilisateur" data-sortable="true" class="success">Email</th>
                                <th class="success">Action</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            <?php foreach ($utilisateurs as $utilisateur) { ?>
                                <tr data-id="<?= $utilisateur['identifiantUtilisateur']; ?>"> 
                                    <td><?= $utilisateur['nomUtilisateur']; ?></td>
                                    <td><?= $utilisateur['prenomUtilisateur']; ?></td>
                                    <td><?= $utilisateur['emailUtilisateur']; ?></td>
                                    <td>
                                        <button class="btn bouton" onclick="modifierUtilisateur(<?= $utilisateur['identifiantUtilisateur']; ?>)">Modifier</button>
                                        <button class="btn bouton" onclick="supprimerUtilisateur(<?= $utilisateur['identifiantUtilisateur']; ?>)">Supprimer</button>
                                    </td>
                                </tr>    
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="text-center pt-3 pb-5">
                        <button type="button" class="btn bouton">
                            Ajouter un nouvel utilisateur
                        </button>
                    </div>
                </div>
            </div>
            <div id="ModifInfoEntreprise" class="tabcontent" style="display:none">
                <div class="monTableau my-5 py-5 px-5">
                    <form>
                        <div class="form-group">
                            <label for="telephone">Numéro de téléphone:</label>
                            <input type="text" class="form-control" id="telephone">
                        </div>
                        <div class="form-group">
                            <label for="adresse">Adresse:</label>
                            <input type="text" class="form-control" id="adresse">
                        </div>
                        <div class="form-group">
                            <label for="codePostal">Code postal:</label>
                            <input type="text" class="form-control" id="codePostal">
                        </div>
                        <div class="form-group">
                            <label for="ville">Ville:</label>
                            <input type="text" class="form-control" id="ville">
                        </div>
                        <button type="submit" class="btn bouton">Valider les modifications</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
} else {
?>
    
<h1 class="text-center text-white py-5 my-5">Vous n'êtes pas autorisé sur cette page.</h1>

<!-- Bouton permettant de revenir à l'accueil  -->

<div class="text-center">
    <a href="index.php"><button class="btn bouton">Retour à l'accueil</button></a>
</div>

<?php } ?>