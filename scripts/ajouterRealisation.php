<script>
     function ajouterRealisation() {
        const services = <?php echo json_encode(getServices()); ?>;
        const serviceOptions = services.map(service => `<option value="${service.id}">${service.nom}</option>`).join('');
        
        Swal.fire({
            title: 'Ajouter une réalisation',
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
                    #fileNameDisplayRealisation {
                        width: 80%;
                        margin: 10px auto;
                        font-size: 14px;
                        color: #000;
                        text-align: center;
                    }
                </style>
                <form id="formAjouterRealisation">
                    <div class="form-group">
                        <input type="text" id="nomRealisation" class="swal2-input" placeholder="Nom de la réalisation" oninput="validerInputRealisation(this)" required>
                    </div>
                    <div class="form-group">
                        <select id="serviceId" class="swal2-input" required>
                            <option value="" disabled selected>Catégorie de service</option>
                            ${serviceOptions}
                        </select>
                    </div>
                    <div class="form-group custom-file-input-wrapper">
                        <label for="imageRealisation" class="custom-file-label swal2-styled popup-btn">Choisir un fichier</label>
                        <input type="file" id="imageRealisation" class="custom-file-input" placeholder="Image de la réalisation" onchange="mettreAJourNomFichierRealisation(this)" required>
                    </div>
                    <div id="fileNameDisplayRealisation">Aucun fichier choisi</div>
                </form>
            `,
            confirmButtonText: 'Ajouter',
            customClass: {
                confirmButton: 'popup-btn',
            },
            preConfirm: () => {
                const nomRealisation = Swal.getPopup().querySelector('#nomRealisation').value;
                const serviceId = Swal.getPopup().querySelector('#serviceId').value;
                const imageRealisation = Swal.getPopup().querySelector('#imageRealisation').files[0];

                // Expressions régulières pour valider les champs
                const regexNom = /^[A-Za-zÀ-ÖØ-öø-ÿ\s-]+$/; // Regex pour le nom de la réalisation (lettres, espaces et tirets uniquement)
                const validFileTypes = ['image/png', 'image/jpeg', 'image/jpg'];

                if (!regexNom.test(nomRealisation)) {
                    Swal.showValidationMessage('Le nom de la réalisation ne doit contenir que des lettres, des espaces et des tirets');
                    return false;
                }

                if (imageRealisation && !validFileTypes.includes(imageRealisation.type)) {
                    Swal.showValidationMessage('Type de fichier non valide. Veuillez choisir un fichier PNG, JPEG ou JPG.');
                    return false;
                }

                if (!nomRealisation || !serviceId || !imageRealisation) {
                    Swal.showValidationMessage('Tous les champs sont requis');
                    return false;
                }

                return { nomRealisation, serviceId, imageRealisation };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const data = new FormData();
                data.append('nom', result.value.nomRealisation);
                data.append('serviceId', result.value.serviceId);
                data.append('image', result.value.imageRealisation);

                fetch('index.php?action=ajouterRealisation', {
                    method: 'POST',
                    body: data
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Ajouté!',
                            text: 'La réalisation a été ajoutée avec succès',
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

    function mettreAJourNomFichierRealisation(input) {
        const fileNameDisplay = document.getElementById('fileNameDisplayRealisation');
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

    function validerInputRealisation(input) {
        const regex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s-]+$/;

        if (!regex.test(input.value)) {
            input.setCustomValidity('Les chiffres et les caractères spéciaux ne sont pas autorisés, sauf les tirets');
        } else {
            input.setCustomValidity('');
        }
    }

    function voirPlus() {
        const offset = document.querySelectorAll('.gallery .card').length;
        fetch(`index.php?action=toutesNosRealisations&offset=${offset}`)
            .then(response => response.text())
            .then(data => {
                const parser = new DOMParser();
                const htmlDocument = parser.parseFromString(data, "text/html");
                const newRealisations = htmlDocument.querySelector('.gallery').innerHTML;
                document.querySelector('.gallery').insertAdjacentHTML('beforeend', newRealisations);
                if (!htmlDocument.querySelector('#voirPlusBtn')) {
                    document.getElementById('voirPlusBtn').remove();
                }
            });
    }

    function voirPlusParService(serviceId) {
        const offset = document.querySelectorAll('.gallery .card').length;
        fetch(`index.php?action=realisationService&id=${serviceId}&offset=${offset}`)
            .then(response => response.text())
            .then(data => {
                const parser = new DOMParser();
                const htmlDocument = parser.parseFromString(data, "text/html");
                const newRealisations = htmlDocument.querySelector('.gallery').innerHTML;
                document.querySelector('.gallery').insertAdjacentHTML('beforeend', newRealisations);
                if (!htmlDocument.querySelector('#voirPlusBtn')) {
                    document.getElementById('voirPlusBtn').remove();
                }
            });
    }
</script>