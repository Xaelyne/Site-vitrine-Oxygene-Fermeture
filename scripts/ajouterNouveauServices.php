<script>
    function ajouterService() {
        // Ouvre une fenêtre modale SweetAlert pour ajouter un service
        Swal.fire({
            title: 'Ajouter un service', // Titre de la fenêtre
            html: `
                <style>
                    :root {
                        --bleu: #3085d6;
                    }
                    .swal2-popup {
                        width: 700px; /* Taille de la fenêtre */
                        padding: 20px; /* Ajoute du padding */
                        box-sizing: border-box;
                    }
                    .swal2-input {
                        width: 80%; /* Assure que tous les champs prennent 80% de la largeur disponible */
                        box-sizing: border-box; /* Assure que le padding est pris en compte dans la largeur totale */
                        border-radius: 5px; /* Ajoute des coins arrondis */
                        border: 1px solid #ccc; /* Ajoute une bordure grise */
                        padding: 10px; /* Ajoute du padding */
                        display: block; /* Assure que les champs sont des éléments de bloc */
                        margin: 10px auto; /* Centre les champs horizontalement avec marge en haut et en bas */
                        min-height: 45px; /* Hauteur minimale augmentée */
                        line-height: 20px; /* Assure que le texte est bien centré */
                    }
                    .custom-file-input-wrapper {
                        width: 80%;
                        margin: 10px auto; /* Centre le conteneur horizontalement avec marge en haut et en bas */
                        display: flex;
                        justify-content: center;
                        align-items: center;
                    }
                    .custom-file-input {
                        display: none; /* Masque l'input */
                    }
                    .custom-file-label {
                        background-color: var(--bleu);
                        color: white;
                        border: 2px solid var(--bleu);
                        padding: 10px 24px;
                        text-align: center;
                        font-size: 16px;
                        cursor: pointer;
                        border-radius: 10px;
                        width: 100%;
                        min-height: 45px; /* Hauteur minimale augmentée */
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        line-height: 20px; /* Assure que le texte est bien centré */
                    }
                    .custom-file-label:hover {
                        background-color: white;
                        color: var(--bleu);
                        border: 2px solid var(--bleu);
                        box-sizing: border-box;
                    }
                    .swal2-container {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                    }
                    .form-group {
                        width: 100%;
                        display: flex;
                        flex-direction: column; /* Assure que les éléments sont empilés verticalement */
                        align-items: center;
                    }
                    .swal2-actions {
                        display: flex;
                        justify-content: center;
                        width: 100%;
                    }
                    .swal2-styled.popup-btn {
                        background-color: var(--bleu);
                        color: white;
                        border: 2px solid var(--bleu);
                        padding: 10px 24px;
                        text-align: center;
                        font-size: 16px;
                        margin: 10px auto;
                        cursor: pointer;
                        border-radius: 10px;
                        width: 80%;
                        min-height: 45px; /* Hauteur minimale augmentée */
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        line-height: 20px; /* Assure que le texte est bien centré */
                    }
                    .swal2-styled.popup-btn:hover {
                        background-color: white;
                        color: var(--bleu);
                        border: 2px solid var(--bleu);
                        box-sizing: border-box;
                    }
                    #fileNameDisplay {
                        width: 80%;
                        margin: 10px auto;
                        font-size: 14px;
                        color: #000;
                        text-align: center;
                    }
                    .error-message {
                        color: red;
                        font-size: 14px;
                        margin-top: -10px;
                        margin-bottom: 10px;
                        text-align: center;
                        display: none;
                    }
                    #detailsContainer {
                        max-height: 200px; /* Limite la hauteur du conteneur des détails */
                        overflow-y: auto; /* Ajoute une barre de défilement verticale */
                        width: 80%; /* Assure que le conteneur prend 80% de la largeur disponible */
                        margin: 10px auto; /* Centre le conteneur avec marge en haut et en bas */
                        padding-right: 10px; /* Ajoute du padding à droite pour éviter que la barre de défilement ne masque le contenu */
                        box-sizing: border-box; /* Assure que le padding est pris en compte dans la largeur totale */
                    }
                    .detail-input {
                        width: 100%; /* Assure que les champs prennent 100% de la largeur du conteneur */
                        box-sizing: border-box;
                        border-radius: 5px;
                        border: 1px solid #ccc;
                        padding: 10px;
                        margin: 10px auto;
                        display: block;
                        min-height: 45px; /* Hauteur minimale augmentée */
                        line-height: 20px; /* Assure que le texte est bien centré */
                    }
                </style>
                <form id="formAjouterService">
                    <div class="form-group">
                        <!-- Champ pour le nom du service -->
                        <input type="text" id="nomService" class="swal2-input" placeholder="Nom du service" oninput="validerInputService(this)">
                    </div>
                    <div class="form-group custom-file-input-wrapper">
                        <!-- Champ pour choisir un fichier d'image -->
                        <label for="imageService" class="custom-file-label swal2-styled popup-btn">Choisir un fichier</label>
                        <input type="file" id="imageService" class="custom-file-input" placeholder="Image du service" onchange="mettreAJourNomFichier(this)">
                    </div>
                    <div id="fileNameDisplay">Aucun fichier choisi</div>
                    <div id="detailsContainer" class="form-group">
                        <!-- Champ pour le premier détail -->
                        <input type="text" name="details[]" class="swal2-input detail-input" placeholder="Détail 1" oninput="validerInputDetail(this)">
                    </div>
                    <div class="swal2-button-container form-group">
                        <!-- Bouton pour ajouter un autre détail -->
                        <button type="button" class="swal2-styled popup-btn" onclick="ajouterDetail()">Ajouter un autre détail</button>
                    </div>
                    <div id="errorMessage" class="error-message">Vous ne pouvez ajouter que 15 détails.</div>
                </form>
            `,
            confirmButtonText: 'Ajouter', // Texte du bouton de confirmation
            customClass: {
                confirmButton: 'popup-btn',
            },
            focusConfirm: false, // Ne pas mettre le focus automatiquement sur le bouton de confirmation
            preConfirm: () => {
                // Récupère les valeurs des champs du formulaire
                const nomService = Swal.getPopup().querySelector('#nomService').value;
                const imageService = Swal.getPopup().querySelector('#imageService').files[0];
                const details = Array.from(Swal.getPopup().querySelectorAll('input[name="details[]"]'))
                                    .map(input => input.value)
                                    .filter(detail => detail.trim() !== ""); // Filtrer les détails vides

                // Expressions régulières pour valider les champs
                const regexService = /^[A-Za-zÀ-ÖØ-öø-ÿ\s-]+$/; // Regex pour le nom du service (lettres, espaces et tirets uniquement)
                const regexDetail = /^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s-]+$/; // Regex pour les détails (lettres, chiffres, espaces et tirets)

                // Validation des champs
                if (!regexService.test(nomService)) {
                    Swal.showValidationMessage('Le nom du service ne doit contenir que des lettres, des espaces et des tirets');
                    return false;
                }

                if (details.some(detail => !regexDetail.test(detail))) {
                    Swal.showValidationMessage('Les détails ne doivent contenir que des lettres, des chiffres, des espaces et des tirets');
                    return false;
                }

                if (!nomService || !imageService || details.length === 0) {
                    Swal.showValidationMessage('Tous les champs sont requis');
                    return false;
                }

                // Formate les valeurs pour que la première lettre soit en majuscule
                const nomServiceFormatted = majPremiereLettre(nomService);
                const detailsFormatted = details.map(detail => majPremiereLettre(detail));

                // Retourne les données validées pour l'envoi
                return { nomService: nomServiceFormatted, imageService, details: detailsFormatted };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Si l'utilisateur confirme, envoie les données au serveur via une requête AJAX
                const data = new FormData();
                data.append('nom', result.value.nomService);
                data.append('image', result.value.imageService);
                result.value.details.forEach(detail => data.append('details[]', detail));

                fetch('index.php?action=ajouterService', {
                    method: 'POST',
                    body: data
                }).then(response => response.json()) // Parse la réponse du serveur en JSON
                .then(data => {
                    if (data.success) {
                        // Si l'ajout a réussi, affiche un message de succès et recharge la page
                        Swal.fire({
                            title: 'Ajouté!',
                            text: 'Le nouveau service a été ajouté avec succès',
                            icon: 'success',
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'popup-btn'
                            }
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        // Si une erreur survient, affiche un message d'erreur
                        Swal.fire({
                            title: 'Erreur!',
                            text: data.message || 'Une erreur est survenue',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'popup-btn'
                            }
                        });
                    }
                })
                .catch(error => {
                    // Si une erreur survient lors de la requête AJAX, affiche un message d'erreur
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Erreur!',
                        text: 'Une erreur est survenue lors du traitement de la réponse',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'popup-btn'
                        }
                    });
                });
            }
        });
    }

    function ajouterDetail() {
        const detailsContainer = document.getElementById('detailsContainer');
        const newDetailIndex = detailsContainer.querySelectorAll('input').length + 1;

        if (newDetailIndex <= 15) {
            // Crée un nouvel input pour le détail et l'ajoute au conteneur
            const newDetailInput = document.createElement('input');
            newDetailInput.type = 'text';
            newDetailInput.name = 'details[]';
            newDetailInput.className = 'swal2-input detail-input';
            newDetailInput.placeholder = `Détail ${newDetailIndex}`;
            newDetailInput.oninput = function() {
                validerInputDetail(this);
            };
            detailsContainer.appendChild(newDetailInput);
        } else {
            Swal.showValidationMessage('Vous ne pouvez pas ajouter plus de 15 détails.');
        }
    }

    function mettreAJourNomFichier(input) {
        // Met à jour le nom du fichier affiché après sélection
        const fileNameDisplay = document.getElementById('fileNameDisplay');
        const fileName = input.files.length > 0 ? input.files[0].name : 'Aucun fichier choisi';
        fileNameDisplay.textContent = fileName;
    }

    function validerInputService(input) {
        const regex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s-]+$/;

        // Validation
        if (!regex.test(input.value)) {
            input.setCustomValidity('Les chiffres et les caractères spéciaux ne sont pas autorisés, sauf les tirets');
        } else {
            input.setCustomValidity('');
        }
    }

    function validerInputDetail(input) {
        const regex = /^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s-]+$/;

        // Validation
        if (!regex.test(input.value)) {
            input.setCustomValidity('Les caractères spéciaux ne sont pas autorisés, sauf les tirets');
        } else {
            input.setCustomValidity('');
        }
    }

    function majPremiereLettre(string) {
        // Met la première lettre en majuscule et le reste en minuscule
        return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
    }
</script>