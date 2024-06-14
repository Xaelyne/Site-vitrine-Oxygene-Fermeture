<script>
   function ajouterService() {
        Swal.fire({
            title: 'Ajouter un service',
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
                    #fileNameDisplayService {
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
                <form id="formAjouterService">
                    <div class="form-group">
                        <input type="text" id="nomService" class="swal2-input" placeholder="Nom du service" oninput="validerInputService(this)">
                    </div>
                    <div class="form-group custom-file-input-wrapper">
                        <label for="imageService" class="custom-file-label swal2-styled popup-btn">Choisir un fichier</label>
                        <input type="file" id="imageService" class="custom-file-input" placeholder="Image du service" onchange="mettreAJourNomFichierServiceAjouter(this)">
                    </div>
                    <div id="fileNameDisplayService">Aucun fichier choisi</div>
                    <div id="detailsContainer" class="form-group">
                        <input type="text" name="details[]" class="swal2-input detail-input" placeholder="Détail 1" oninput="validerInputDetail(this)">
                    </div>
                    <div class="swal2-button-container form-group">
                        <button type="button" class="swal2-styled popup-btn" onclick="ajouterDetail()">Ajouter un autre détail</button>
                    </div>
                    <div id="errorMessage" class="error-message">Vous ne pouvez ajouter que 15 détails.</div>
                </form>
            `,
            confirmButtonText: 'Ajouter',
            customClass: {
                confirmButton: 'popup-btn',
            },
            focusConfirm: false,
            preConfirm: () => {
                const nomService = Swal.getPopup().querySelector('#nomService').value;
                const imageService = Swal.getPopup().querySelector('#imageService').files[0];
                const details = Array.from(Swal.getPopup().querySelectorAll('input[name="details[]"]'))
                                    .map(input => input.value)
                                    .filter(detail => detail.trim() !== "");

                const regexService = /^[A-Za-zÀ-ÖØ-öø-ÿ\s-]+$/;
                const regexDetail = /^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s-]+$/;

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

                const nomServiceFormatted = majPremiereLettre(nomService);
                const detailsFormatted = details.map(detail => majPremiereLettre(detail));

                return { nomService: nomServiceFormatted, imageService, details: detailsFormatted };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const data = new FormData();
                data.append('nom', result.value.nomService);
                data.append('image', result.value.imageService);
                result.value.details.forEach(detail => data.append('details[]', detail));

                fetch('index.php?action=ajouterService', {
                    method: 'POST',
                    body: data
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
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

    function ajouterDetail() {
        const detailsContainer = document.getElementById('detailsContainer');
        const newDetailIndex = detailsContainer.querySelectorAll('input').length + 1;

        if (newDetailIndex <= 15) {
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

    function mettreAJourNomFichierServiceAjouter(input) {
    const fileNameDisplay = document.getElementById('fileNameDisplayService');
    const file = input.files[0];
    const fileName = file ? file.name : 'Aucun fichier choisi';
    const validFileTypes = ['image/png', 'image/jpeg', 'image/jpg'];

    if (file && !validFileTypes.includes(file.type)) {
        fileNameDisplay.textContent = 'Type de fichier non valide. Veuillez choisir un fichier PNG, JPEG ou JPG.';
        input.value = ''; // Clear the input
        return;
    }

    fileNameDisplay.textContent = fileName;
}

    function validerInputService(input) {
        const regex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s-]+$/;

        if (!regex.test(input.value)) {
            input.setCustomValidity('Les chiffres et les caractères spéciaux ne sont pas autorisés, sauf les tirets');
        } else {
            input.setCustomValidity('');
        }
    }

    function validerInputDetail(input) {
        const regex = /^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s-]+$/;

        if (!regex.test(input.value)) {
            input.setCustomValidity('Les caractères spéciaux ne sont pas autorisés, sauf les tirets');
        } else {
            input.setCustomValidity('');
        }
    }

    function majPremiereLettre(string) {
        return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
    }
</script>