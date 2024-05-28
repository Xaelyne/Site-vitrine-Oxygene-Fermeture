// var textarea = document.getElementById("messageFormulaireContactAccueil");
// var textarea1 = document.getElementById("messageFormulaireContact");
// var textarea2 = document.getElementById("messageFormulaireDevis");
// var counter = document.getElementById("counter");
// var counter1 = document.getElementById("counter1");
// var counter2 = document.getElementById("counter2");

// textarea.addEventListener("input", function() {
//     var remainingChars = 500 - textarea.value.length;
//     counter.textContent = remainingChars + "/500 Caractères";
// });

// textarea1.addEventListener("input", function() {
//     var remainingChars = 500 - textarea1.value.length;
//     counter1.textContent = remainingChars + "/500 Caractères";
// });

// textarea2.addEventListener("input", function() {
//     var remainingChars = 500 - textarea2.value.length;
//     counter2.textContent = remainingChars + "/500 Caractères";
// });


var textareas = document.querySelectorAll('.messageFormulaire');
var counters = document.querySelectorAll('.counter');

textareas.forEach(function(textarea, index) {
    var counter = counters[index];
    textarea.addEventListener("input", function() {
        var remainingChars = 500 - textarea.value.length;
        counter.textContent = remainingChars + "/500 Caractères";
    });
});