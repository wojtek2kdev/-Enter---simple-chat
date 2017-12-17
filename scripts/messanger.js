const Messanger = (function(){

  let _Writer;
  let _Form;

  const _listeners = function(){
    $(_Writer).on('keydown', e => {
      if (e.keyCode == 13 && !e.shiftKey) {
      //  $(_Form).submit();
        $(_Writer).val('');
        e.preventDefault();
      }
    });
  };

  const _init = function(){
    _Writer = $('#writer');
    _Form = $('#messanger');
    _listeners();
  };

  return {
    init: _init
  };

})();
