const checkPassword = function(){

    $('input[name=password]').val() === $('input[name=confirm]').val() ? 
        isPasswordStrong() : (() => {
            $('#pass_err').attr('title', "Passwords aren't same");
            $('#pass_err').show();
        })();

};

const isPasswordStrong = function(){

    let passLength = $('input[name=password]').val().length;

    if(passLength == 0){
        $('#pass_err').hide();
    }else{
    passLength >= 8 ? $('#pass_err').hide() : (() => {
            $('#pass_err').attr('title', "Password isn't strong enough. (min 8 chars)");
            $('#pass_err').show();
        })();
    }
};

const addListeners = function(){


    document.getElementsByName('password')[0].addEventListener('input', checkPassword);

    document.getElementsByName('confirm')[0].addEventListener('input', checkPassword);

};

(function init(){

    document.addEventListener('DOMContentLoaded', addListeners);

})();
