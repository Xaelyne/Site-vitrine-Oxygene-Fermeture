<script>
    function ajouterPartenaire() {
        Swal.fire({
            title: 'Ajouter un partenaire',
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
                    #fileNameDisplayPartenaire {
                        width: 80%;
                        margin: 10px auto;
                        font-size: 14px;
                        color: #000;
                        text-align: center;
                    }
                </style>
                <form id="formAjouterPartenaire">
                    <div class="form-group">
                        <input type="text" id="nomPartenaire" class="swal2-input" placeholder="Nom du partenaire" oninput="validerInputPartenaire(this)" required>
                    </div>
                    <div class="form-group custom-file-input-wrapper">
                        <label for="imagePartenaire" class="custom-file-label swal2-styled popup-btn">Choisir un fichier</label>
                        <input type="file" id="imagePartenaire" class="custom-file-input" placeholder="Image du partenaire" onchange="mettreAJourNomFichierPartenaireAjouter(this)" required>
                    </div>
                    <div id="fileNameDisplayPartenaire">Aucun fichier choisi</div>
                    <div class="form-group">
                        <input type="text" id="lienPartenaire" class="swal2-input" placeholder="Lien du partenaire" required>
                    </div>
                </form>
            `,
            confirmButtonText: 'Ajouter',
            customClass: {
                confirmButton: 'popup-btn',
            },
            preConfirm: () => {
                const nomPartenaire = Swal.getPopup().querySelector('#nomPartenaire').value;
                const imagePartenaire = Swal.getPopup().querySelector('#imagePartenaire').files[0];
                const lienPartenaire = Swal.getPopup().querySelector('#lienPartenaire').value;

                // Expressions régulières pour valider les champs
                const regexNom = /^[A-Za-zÀ-ÖØ-öø-ÿ\s-]+$/; // Regex pour le nom du partenaire (lettres, espaces et tirets uniquement)
                const validFileTypes = ['image/png', 'image/jpeg', 'image/jpg'];

                if (!regexNom.test(nomPartenaire)) {
                    Swal.showValidationMessage('Le nom du partenaire ne doit contenir que des lettres, des espaces et des tirets');
                    return false;
                }

                if (imagePartenaire && !validFileTypes.includes(imagePartenaire.type)) {
                    Swal.showValidationMessage('Type de fichier non valide. Veuillez choisir un fichier PNG, JPEG ou JPG.');
                    return false;
                }

                if (!nomPartenaire || !imagePartenaire || !lienPartenaire) {
                    Swal.showValidationMessage('Tous les champs sont requis');
                    return false;
                }

                return { nomPartenaire, imagePartenaire, lienPartenaire };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const data = new FormData();
                data.append('nom', result.value.nomPartenaire);
                data.append('image', result.value.imagePartenaire);
                data.append('lien', result.value.lienPartenaire);

                fetch('index.php?action=ajouterPartenaire', {
                    method: 'POST',
                    body: data
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Ajouté!',
                            text: 'Le partenaire a été ajouté avec succès',
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
    }

    function mettreAJourNomFichierPartenaireAjouter(input) {
        const fileNameDisplay = document.getElementById('fileNameDisplayPartenaire');
        const file = input.files[0];
        const fileName = file ? file.name : 'Aucun fichier choisi';
        const validFileTypes = ['image/png', 'image/jpeg', 'image/jpg'];

        if (file && !validFileTypes.includes(file.type)) {
            Swal.showValidationMessage('Type de fichier non valide. Veuillez choisir un fichier PNG, JPEG ou JPG.');
            input.value = ''; // Clear the input
            fileNameDisplay.textContent = 'Aucun fichier choisi'; // Reset the display text
            return;
        }

        fileNameDisplay.textContent = fileName;
    }

    function validerInputPartenaire(input) {
        const regex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s-]+$/;

        if (!regex.test(input.value)) {
            input.setCustomValidity('Les chiffres et les caractères spéciaux ne sont pas autorisés, sauf les tirets');
        } else {
            input.setCustomValidity('');
        }
    }
</script>