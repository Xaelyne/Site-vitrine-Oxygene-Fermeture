<script>

function modifierAvis(idAvis, prenom, note, commentaire) {
    Swal.fire({
        title: 'Modifier l\'avis',
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
            <form id="formModifierAvis">
                <input type="hidden" name="idAvis" value="${idAvis}">
                <div class="form-group">
                    <input type="text" class="swal2-input" id="modifierPrenomFormulaireAvis" name="prenom" placeholder="Prénom (Obligatoire)" value="${prenom}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Note</label>
                    <div id="ratingSweetModifier" class="d-flex justify-content-center">
                        ${[1, 2, 3, 4, 5].map(i => `
                            <img src="images/${i <= note ? 'etoileRemplie' : 'etoileVide'}.png" class="starSweet" data-value="${i}" style="width: 24px; cursor: pointer;">
                        `).join('')}
                    </div>
                    <input type="hidden" name="note" id="modifierNoteFormulaireAvis" value="${note}" required>
                </div>
                <div class="form-group">
                    <textarea class="swal2-input" id="modifierCommentaireFormulaireAvis" name="commentaire" rows="4" placeholder="Commentaire (Obligatoire)" required>${commentaire}</textarea>
                </div>
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: 'Modifier',
        cancelButtonText: 'Annuler',
        customClass: {
            confirmButton: 'popup-btn',
            cancelButton: 'popup-annuler'
        },
        preConfirm: () => {
            const form = document.getElementById('formModifierAvis');
            if (form.checkValidity()) {
                const formData = new FormData(form);
                return fetch('index.php?action=modifierAvis', {
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
            Swal.fire('Succès', 'L\'avis a été modifié.', 'success').then(() => {
                location.reload();
            });
        }
    });

    const stars = document.querySelectorAll('#ratingSweetModifier .starSweet');
    const noteInput = document.getElementById('modifierNoteFormulaireAvis');
    let selectedValue = note;

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
</script>