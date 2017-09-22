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

const isInputCorrect = function(input){

 for(let i in input){
    if(input[i] != ' ') return true;
 }
    throw "Input must includes letter!";

}

const isNickTooLong = (nickLen) => {if(nickLen > 20) throw "Nickname is too long (max 20 letters)"};

const isInputEmpty = (inputLen, name) => {if(!inputLen) throw `${name} is empty!`};

const setAttrib = (obj, attr, val='') => $(obj).attr(attr,val);

const disableSubmit = () => $('#submit').attr('disabled', '');

const enableSubmit = () => $('#submit').removeAttr('disabled');

const showErr = () => $('#pass_err').show();

const hideErr = () => $('#pass_err').hide();

const validation = function(){

    let loginLen = $('[name=login]').val().length;
    let nickLen = $('[name=nick]').val().length;

    try{
        isInputCorrect(document.activeElement.value);
        checkPassword();
        isNickTooLong(nickLen);
        isInputEmpty(loginLen, 'Login');
        isInputEmpty(nickLen, 'Nickname');
    }catch(e){ 
        disableSubmit();
        setAttrib('#pass_err', 'title', e);
        showErr();
    } 

}

const preInit = function(){

    disableSubmit();

    document.getElementsByTagName('form')[0].addEventListener('input', validation);

};

(function init(){

    document.addEventListener('DOMContentLoaded', preInit);

})();
