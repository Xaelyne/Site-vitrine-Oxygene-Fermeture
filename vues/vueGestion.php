<div class="container d-flex justify-content-center flex-column align-items-center">
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
                                        <div class="d-flex justify-content-around">
                                            <button class="btn bouton" style="width: 30%;" onclick="modifierUtilisateur(<?= $utilisateur['identifiantUtilisateur']; ?>)">Modifier</button>
                                            <button class="btn bouton" style="width: 30%;" onclick="supprimerUtilisateur(<?= $utilisateur['identifiantUtilisateur']; ?>)">Supprimer</button>
                                        </div>
                                    </td>
                                </tr>    
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="text-center pt-3 pb-5">
                    <button type="button" class="btn bouton" onclick="ajouterUtilisateur()">Ajouter un nouvel utilisateur</button>
                    </div>
                </div>
            </div>
            <div id="ModifInfoEntreprise" class="tabcontent" style="display:none">
                <div class="monTableau my-5 py-5 px-5">
                    <div class="mb-5 text-center d-flex justify-content-center flex-column">
                        <span class="text-danger my-1" id="messageErreurTelInfosEntreprise"></span>
                        <span class="text-danger my-1" id="messageErreurAdresseInfosEntreprise"></span>
                        <span class="text-danger my-1" id="messageErreurCodePostalInfosEntreprise"></span>
                        <span class="text-danger my-1" id="messageErreurVilleInfosEntreprise"></span>
                    </div>
                    <form id="formModifierInformationsEntreprise">
                        <div class="form-group">
                            <label for="telephone" class="text-white my-1">Numéro de téléphone:</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" placeholder="<?= htmlspecialchars($infoEntreprise['telephoneEntreprise']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="adresse" class="text-white my-1">Adresse:</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="<?= htmlspecialchars($infoEntreprise['adresseEntreprise']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="codePostal" class="text-white my-1">Code postal:</label>
                            <input type="text" class="form-control" id="codePostal" name="codePostal" placeholder="<?= htmlspecialchars($infoEntreprise['codePostalEntreprise']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="ville" class="text-white my-1">Ville:</label>
                            <input type="text" class="form-control" id="ville" name="ville" placeholder="<?= htmlspecialchars($infoEntreprise['villeEntreprise']); ?>">
                        </div>
                        <div class="d-flex justify-content-center my-5">
                            <button type="submit" class="btn bouton">Valider les modifications</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
