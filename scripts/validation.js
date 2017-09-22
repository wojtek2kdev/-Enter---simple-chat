const checkPassword = function(){

    $('input[name=password]').val() === $('input[name=confirm]').val() ? 
        isPasswordStrong() : (() => {throw "Passwords aren't same"})()
};

const isPasswordStrong = function(){

    let passLength = $('input[name=password]').val().length;

    if(passLength == 0){
        hideErr();
    }else{
    passLength >= 8 ? (() => {
        hideErr();
        enableSubmit();
     })() : (() => {throw "Password isn't strong enough. (min 8 letters)"})()

    }
};

const isNickTooLong = (nickLen) => nickLen > 20;

const isNickEmpty = (nickLen) => nickLen;

const setAttrib = (obj, attr, val='') => $(obj).attr(attr,val);

const disableSubmit = () => $('#submit').attr('disabled', '');

const enableSubmit = () => $('#submit').removeAttr('disabled');

const showErr = () => $('#pass_err').show();

const hideErr = () => $('#pass_err').hide();

const validation = function(){

    try{
        checkPassword();
    }catch(e){ 
        disableSubmit();
        setAttrib('#pass_err', 'title', e);
        showErr();
    } 

}

const preInit = function(){

    disableSubmit();

    document.getElementsByName('password')[0].addEventListener('input', validation);

    document.getElementsByName('confirm')[0].addEventListener('input', validation);

};

(function init(){

    document.addEventListener('DOMContentLoaded', preInit);

})();
