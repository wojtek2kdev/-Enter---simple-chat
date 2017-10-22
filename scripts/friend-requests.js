const Requests = (function(){

  let _RequestsList = [];
  let _currentRequest = 0;
  let _userName;

  const _prev = -1;
  const _next = 1;

  const _acceptRequest = function(){

  };

  const _discardRequest = function(){

  };

  const _switchRequest = function(direction){
    if(_currentRequest + direction < 0 || _currentRequest + direction >= _RequestsList.length){
      throw "No more requests.";
      return;
    }else{
      _currentRequest += direction;
      _userName  = _RequestsList[_currentRequest];
      _showRequest();
    }
  };

  const _disableArrow = function(){
    $('#previous_request').hide();
    $('#next_request').hide();
    if(_currentRequest == 0 && _RequestsList.length > 1){
      $('#next_request').show();
    }else if(_currentRequest == _RequestsList.length - 1 && _currentRequest){
      $('#previous_request').show();
    }else if(_currentRequest > 0){
      $('#previous_request').show();
      $('#next_request').show();
    }
  };

  const _showRequest = function(){
    _disableArrow();
    $('#request_info>span').text(_userName);
  };

  const _events = function(){
    $('#next_request').on('click', () => _switchRequest(1));
    $('#previous_request').on('click', () => _switchRequest(-1));
  };

  const _init = function(requests){
    $('#request').hide();

    _RequestsList = requests;

    if(_RequestsList){
      $('#request').show();
      _userName = _RequestsList[0];
      _showRequest();
    }

    _events();
  };

  return {
    init : _init
  };

})();
