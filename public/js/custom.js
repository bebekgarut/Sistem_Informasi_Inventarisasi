// document.addEventListener('DOMContentLoaded', function() {
//     document.querySelectorAll('.format-number').forEach(function(element) {
//         var number = parseFloat(element.textContent);
//         var formattedNumber = number.toLocaleString('de-DE');
//         element.textContent = formattedNumber;
//     });
// });


$(function() {
    $('.format-number').each(function() {
        var text = $(this).text().trim();
        var number = parseFloat(text);

        if (!isNaN(number)) {
            var formattedNumber = number.toLocaleString('de-DE');
            $(this).text(formattedNumber);
        } else {
            $(this).text('0');
        }
    });
});
