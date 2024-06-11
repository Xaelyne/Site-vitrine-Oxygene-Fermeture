var textareas = document.querySelectorAll('.messageFormulaire');
var counters = document.querySelectorAll('.counter');

textareas.forEach(function(textarea, index) {
    var counter = counters[index];
    textarea.addEventListener("input", function() {
        var remainingChars = 500 - textarea.value.length;
        counter.textContent = remainingChars + "/500 Caractères";
    });
});