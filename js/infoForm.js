$(document).ready(function () {
    $('#submit').attr('disabled', true);
    $('input').on('keyup', function () {
        let nosaukums = $("#nosaukums").val();
        let adrese = $('#adrese').val();
        let darba_laiks = $('#darba_laiks').val();
        let talrunis = $('#talrunis').val();
        let epasts = $('#epasts').val();
        let apraksts = $('#apraksts').val();
        if (nosaukums != '' && adrese != '' && darba_laiks != '' && talrunis != '' && epasts != '' && apraksts != '') {
            $('#submit').attr('disabled', false);
        } else {
            $('#submit').attr('disabled', true);
        }
    });
});
