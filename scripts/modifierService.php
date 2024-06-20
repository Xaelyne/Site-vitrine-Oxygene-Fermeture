<script>
   function modifierService(event, serviceId) {
        event.stopPropagation();  // Empêche la propagation de l'événement de clic

        // Récupère les informations du service via une requête AJAX
        fetch(`index.php?action=getService&id=${serviceId}`, {
            method: 'GET'
        }).then(response => response.text())
        .then(text => {
            let data;
            try {
                data = JSON.parse(text); // Parse the text to JSON
            } catch (e) {
                console.error('Error parsing JSON:', e);
                throw e;
            }

            if (data.success) {
                const service = data.service;

                // Ouvre une fenêtre modale SweetAlert pour modifier le service
                Swal.fire({
                    title: 'Modifier un service',
                    html: `
                        <style>
                            :root {
                                --bleu: #3085d6;
                            }
                            .swal2-popup {
                                width: 700px;
                                padding: 20px;
                                box-sizing: border-box;
                            }
                            .swal2-input {
                                width: 80%;
                                box-sizing: border-box;
                                border-radius: 5px;
                                border: 1px solid #ccc;
                                padding: 10px;
                                display: block;
                                margin: 10px auto;
                                min-height: 45px;
                                line-height: 20px;
                            }
                            .custom-file-input-wrapper {
                                width: 80%;
                                margin: 10px auto;
                                display: flex;
                                justify-content: center;
                                align-items: center;
                            }
                            .custom-file-input {
                                display: none;
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
                                min-height: 45px;
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                line-height: 20px;
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
                                flex-direction: column;
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
                                min-height: 45px;
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                line-height: 20px;
                            }
                            .swal2-styled.popup-btn:hover {
                                background-color: white;
                                color: var(--bleu);
                                border: 2px solid var(--bleu);
                                box-sizing: border-box;
                            }
                            #fileNameDisplayServiceModifier {
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
                                max-height: 200px;
                                overflow-y: auto;
                                width: 80%;
                                margin: 10px auto;
                                padding-right: 10px;
                                box-sizing: border-box;
                            }
                            .detail-input {
                                width: 100%;
                                box-sizing: border-box;
                                border-radius: 5px;
                                border: 1px solid #ccc;
                                padding: 10px;
                                margin: 10px auto;
                                display: block;
                                min-height: 45px;
                                line-height: 20px;
                            }
                        </style>
                        <form id="formModifierService"> 
                            <div class="form-group">
                                <input type="text" id="nomService" class="swal2-input" placeholder="Nom du service" value="${service.nom}" oninput="validerInputService(this)">
                            </div>
                            <div class="form-group custom-file-input-wrapper">
                                <label for="imageService" class="custom-file-label swal2-styled popup-btn">Choisir un fichier</label>
                                <input type="file" id="imageService" class="custom-file-input" placeholder="Image du service" onchange="mettreAJourNomFichierServiceModifier(this)">
                            </div>
                            <div id="fileNameDisplayServiceModifier">${service.image.split('/').pop()}</div>
                            <div id="detailsContainer" class="form-group">
                                ${service.details.map((detail, index) => `
                                    <input type="text" name="details[]" class="swal2-input detail-input" placeholder="Détail ${index + 1}" value="${detail}" oninput="validerInputDetail(this)">
                                `).join('')}
                            </div>
                            <div class="swal2-button-container form-group">
                                <button type="button" class="swal2-styled popup-btn" onclick="ajouterDetail()">Ajouter un autre détail</button>
                            </div>
                            <div id="errorMessage" class="error-message">Vous ne pouvez ajouter que 15 détails.</div>
                        </form>
                    `,
                    confirmButtonText: 'Modifier',
                    customClass: {
                        confirmButton: 'popup-btn',
                    },
                    focusConfirm: false,
                    preConfirm: () => {
                        // Récupère les valeurs des champs du formulaire
                        const nomService = Swal.getPopup().querySelector('#nomService').value;
                        const imageService = Swal.getPopup().querySelector('#imageService').files[0];
                        const details = Array.from(Swal.getPopup().querySelectorAll('input[name="details[]"]'))
                                            .map(input => input.value)
                                            .filter(detail => detail.trim() !== ""); // Filtrer les détails vides

                        // Expressions régulières pour valider les champs
                        const regexService = /^[A-Za-zÀ-ÖØ-öø-ÿ\s'-]+$/;
                        const regexDetail = /^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s'-]+$/;

                        // Validation des champs
                        if (!regexService.test(nomService)) {
                            Swal.showValidationMessage('Le nom du service ne doit contenir que des lettres, des espaces, des tirets et des apostrophes');
                            return false;
                        }

                        if (details.some(detail => !regexDetail.test(detail))) {
                            Swal.showValidationMessage('Les détails ne doivent contenir que des lettres, des chiffres, des espaces, des tirets et des apostrophes');
                            return false;
                        }

                        if (!nomService || details.length === 0) {
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
                        if (result.value.imageService) {
                            data.append('image', result.value.imageService);
                        } else {
                            data.append('image', service.image);
                        }
                        data.append('id', service.id);
                        result.value.details.forEach(detail => data.append('details[]', detail));

                        fetch('index.php?action=modifierService', {
                            method: 'POST',
                            body: data
                        }).then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Modifié!',
                                    text: 'Le service a été modifié avec succès',
                                    icon: 'success',
                                    confirmButtonText: 'OK',
                                    customClass: {
                                        confirmButton: 'popup-btn'
                                    }
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
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
            } else {
                Swal.fire({
                    title: 'Erreur!',
                    text: 'Une erreur est survenue lors de la récupération des informations du service.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'popup-btn'
                    }
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Erreur!',
                text: 'Une erreur est survenue lors de la communication avec le serveur.',
                icon: 'error',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'popup-btn'
                }
            });
        });
    }

    function mettreAJourNomFichierServiceModifier(input) {
        const fileNameDisplay = document.getElementById('fileNameDisplayServiceModifier');
        const fileName = input.files.length > 0 ? input.files[0].name : 'Aucun fichier choisi';
        const allowedExtensions = ['png', 'jpeg', 'jpg'];

        if (input.files.length > 0) {
            const fileExtension = fileName.split('.').pop().toLowerCase();
            if (!allowedExtensions.includes(fileExtension)) {
                Swal.showValidationMessage('Veuillez sélectionner un fichier PNG, JPEG ou JPG.');
                input.value = ''; // Clear the input
                return;
            }
        }

        fileNameDisplay.textContent = fileName;
    }
</script>