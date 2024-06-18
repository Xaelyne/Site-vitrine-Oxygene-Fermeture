document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('.star');
    const noteInput = document.getElementById('noteFormulaireAvis');

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
        const value = noteInput.value;
        fillStars(value);
    }

    function handleClick(event) {
        const value = event.target.getAttribute('data-value');
        noteInput.value = value;
        fillStars(value);
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
});