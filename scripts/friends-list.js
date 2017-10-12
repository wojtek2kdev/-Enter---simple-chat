const FriendsList = (function(){

    const xhr = new XMLHttpRequest();

    const _xhrsend = function(data, file="main.php", type="POST"){
      xhr.open(type, file, true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.send(data);
    };

    const _removeFriend = function(friend){
        let result = confirm('Are you sure to delete this user?');
        if(result) friend.remove();
        _xhrsend('friend=' + friend.innerText);
    };

    const _searchFriend = function(target){
            const friendsList = document.getElementById('items').children;
            for(let i of friendsList){
                if(target.toUpperCase() != i.children[0].innerText.slice(0, target.length).toUpperCase()){
                    i.style = 'display: none;';
                }else{
                    i.style = '';
                }
            }
    };

    const _switchSearch = function(item){
      let searchBarTypes = $('.ui.two.item.menu');
        for(let i of searchBarTypes.children()){
          i.className = 'item';
        }
        item.className = 'active item';
        if(item == searchBarTypes.children()[0]){
          $('#search').attr('placeholder','Find friend from list...');
          $('li[aria=friend]').show();
        }else{
          $('#search').attr('placeholder','Find user in Enter...');
          $('li[aria=friend]').hide();
        }
    };

    const _searchUser = function(target){

    };

    const _generateList = function(friends_list){
        const list = document.getElementById('items');
        for(let nick of friends_list){
            let item = document.createElement('li');
                 let message_icon = document.createElement('i');
                 message_icon.setAttribute('class', 'comment icon message');
                 let remove_icon = document.createElement('i');
                 remove_icon.setAttribute('class', 'ban icon remove_friend');
                 let nickname = document.createElement('span');
                 nickname.innerText = nick;
            item.setAttribute('aria', 'friend');
            item.appendChild(nickname);
            item.appendChild(message_icon)
            item.appendChild(remove_icon);
            list.appendChild(item);
        }
    };

    const _init = function(friends_list){
        _generateList(friends_list);
        for(let i of $('.ban.icon.remove_friend')){
            i.addEventListener('click', e => _removeFriend(e.target.parentElement));
        }
        for(let i of $('.ui.two.item.menu').children()){
          i.addEventListener('click', e => _switchSearch(e.target));
        }
        document.getElementById('search').addEventListener('input', e => _searchFriend(e.target.value));
    };

    return {

        init : _init

    };

})();
