var textarea = document.getElementById("messageFormulaireContact");
var counter = document.getElementById("counter");

textarea.addEventListener("input", function() {
    var remainingChars = 500 - textarea.value.length;
    counter.textContent = remainingChars + "/500 Caractères";
});