$(document).ready(function () {
    $('#submit').attr('disabled', true);
    $('input').on('keyup', function () {
        let usernameValue = $("#username").val();
        let email = $('#email').val();
        let userPassword = $('#userPassword').val();
        let repeatUserPassword = $('#repeatUserPassword').val();
        if (usernameValue != '' && email != '' && userPassword != '' && repeatUserPassword != '') {
            $('#submit').attr('disabled', false);
        } else {
            $('#submit').attr('disabled', true);
        }
    });
});

//check pwd sila
$('#userPassword').on('keyup', function checkPasswordStrength() {
    
    let number = $('#userPassword').val().match(/([0-9])/);
    let uppercase = $('#userPassword').val().match(/([A-Z])/);
    let lowercase = $('#userPassword').val().match(/([a-z])/);
    let special_characters = $('#userPassword').val().match(/([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/);
    

    let pwdStrength = [number, uppercase, lowercase, special_characters];
    let trueStrength = pwdStrength.filter(Boolean).length;
    $('#pwdStrengthCount').html(trueStrength);
    
    if ($('#userPassword').val().length < 6 ) {
        $('#password-strength-status').removeClass();
        $('#pwdField').removeClass();
        $('#password-strength-status').addClass('shortPwd');
        $('#pwdField').addClass('weakField');
        $('#password-strength-status').html("Parolei jāsatur vismaz 6 simboli."); 
    }else if (trueStrength == 1 || trueStrength == 2){
        $('#password-strength-status').removeClass();
        $('#pwdField').removeClass();
        $('#password-strength-status').addClass('weakPwd');
        $('#pwdField').addClass('weakField2');
        $('#password-strength-status').html("VĀJA parole: rekomendēts izmantot speciālos simbolus, ciparus, lielos burtus.");
    }else if (trueStrength == 3) {
        $('#password-strength-status').removeClass();
        $('#pwdField').removeClass();
        $('#password-strength-status').addClass('mediumPwd');
        $('#pwdField').addClass('mediumField');
        $('#password-strength-status').html("Viduvēja parole: pieņemama, bet var labāk.");
    }else if (trueStrength == 4) {
        $('#password-strength-status').removeClass();
        $('#pwdField').removeClass();
        $('#password-strength-status').addClass('strongPwd');
        $('#pwdField').addClass('strongField');
        $('#password-strength-status').html("Stipra parole");
    }
    
});
//pwd match
$('#repeatUserPassword').on('keyup', function checkPasswordMatch() {
    if($('#userPassword').val() != $('#repeatUserPassword').val()){
        $('#password-match-status').addClass('notMatchPwd');
        $('#password-match-status').html("Paroles nesakrīt");
    }else{
        $('#password-match-status').html("Paroles sakrīt");
    }
});