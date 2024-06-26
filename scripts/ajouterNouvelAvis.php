<script>
   function ajouterAvis() {
        Swal.fire({
            title: 'Ajouter un nouvel avis',
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
                    .starSweet {
                        cursor: pointer;
                        width: 24px;
                    }
                </style>
                <form id="formAjouterAvis">
                    <div class="form-group">
                        <input type="text" class="swal2-input" id="ajoutNomFormulaireAvis" name="ajoutNomFormulaireAvis" placeholder="Nom du client" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Note du client</label>
                        <div id="ratingSweet" class="d-flex justify-content-center">
                            <img src="images/etoileVide.png" class="starSweet" data-value="1">
                            <img src="images/etoileVide.png" class="starSweet" data-value="2">
                            <img src="images/etoileVide.png" class="starSweet" data-value="3">
                            <img src="images/etoileVide.png" class="starSweet" data-value="4">
                            <img src="images/etoileVide.png" class="starSweet" data-value="5">
                        </div>
                        <input type="hidden" name="ajoutNoteFormulaireAvis" id="ajoutNoteFormulaireAvis" required>
                    </div>
                    <div class="form-group">
                        <textarea class="swal2-input" id="ajoutCommentaireFormulaireAvis" name="ajoutCommentaireFormulaireAvis" rows="4" placeholder="Commentaire du client" required></textarea>
                    </div>
                </form>
            `,
            confirmButtonText: 'Ajouter',
            customClass: {
                confirmButton: 'popup-btn',
            },
            preConfirm: () => {
                const form = document.getElementById('formAjouterAvis');
                const noteValue = document.getElementById('ajoutNoteFormulaireAvis').value;
                
                // Force the first letter of name and comment to be uppercase
                const nomInput = document.getElementById('ajoutNomFormulaireAvis');
                const commentaireInput = document.getElementById('ajoutCommentaireFormulaireAvis');
                nomInput.value = capitalizeFirstLetter(nomInput.value);
                commentaireInput.value = capitalizeFirstLetter(commentaireInput.value);

                // Regex patterns
                const regexNom = /^[A-Za-zÀ-ÖØ-öø-ÿ\s'-]+$/; // Nom: lettres, espaces, accents, apostrophes, et tirets
                const regexCommentaire = /^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s'-]+$/; // Commentaire: lettres, chiffres, espaces, accents, apostrophes, et tirets

                // Validate fields
                if (!regexNom.test(nomInput.value)) {
                    Swal.showValidationMessage('Nom invalide. Il peut contenir des lettres, espaces, accents, apostrophes, et tirets.');
                    return false;
                }
                
                if (!regexCommentaire.test(commentaireInput.value)) {
                    Swal.showValidationMessage('Commentaire invalide. Il peut contenir des lettres, chiffres, espaces, accents, apostrophes, et tirets.');
                    return false;
                }

                if (form.checkValidity()) {
                    const formData = new FormData(form);
                    return fetch('index.php?action=ajouterAvis', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            Swal.showValidationMessage(data.message || 'Une erreur est survenue');
                        }
                        return data;
                    });
                } else {
                    Swal.showValidationMessage('Veuillez remplir tous les champs obligatoires');
                }
            }
        }).then(result => {
            if (result.isConfirmed && result.value.success) {
                Swal.fire('Succès', 'Votre avis a été ajouté.', 'success').then(() => {
                    location.reload();
                });
            }
        });

        const stars = document.querySelectorAll('.starSweet');
        const noteInput = document.getElementById('ajoutNoteFormulaireAvis');
        let selectedValue = 0;

        stars.forEach(star => {
            star.addEventListener('mouseover', handleMouseOver);
            star.addEventListener('mouseout', handleMouseOut);
            star.addEventListener('click', handleClick);
        });

        function handleMouseOver(event) {
            const value = event.target.getAttribute('data-value');
            fillStars(value);
        }

        function handleMouseOut() {
            fillStars(selectedValue);
        }

        function handleClick(event) {
            selectedValue = event.target.getAttribute('data-value');
            noteInput.value = selectedValue;
            fillStars(selectedValue);
        }

        function fillStars(value) {
            stars.forEach(star => {
                if (star.getAttribute('data-value') <= value) {
                    star.src = 'images/etoileRemplie.png';
                } else {
                    star.src = 'images/etoileVide.png';
                }
            });
        }

        fillStars(selectedValue);
    }

    function voirPlusAvis() {
        const offset = document.querySelectorAll('#avisContainer .col-md-6').length;
        fetch(`index.php?action=avis&offset=${offset}`)
            .then(response => response.text())
            .then(data => {
                const parser = new DOMParser();
                const htmlDocument = parser.parseFromString(data, "text/html");
                const newAvis = htmlDocument.querySelector('#avisContainer').innerHTML;
                document.querySelector('#avisContainer').insertAdjacentHTML('beforeend', newAvis);
                if (!htmlDocument.querySelector('#voirPlusBtn')) {
                    document.getElementById('voirPlusBtn').remove();
                }
            });
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
    }
</script>