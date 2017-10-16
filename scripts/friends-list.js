const FriendsList = (function(){

    const _Users = [];

    const _removeFriend = function(friend){
        let result = confirm('Are you sure to delete this user?');
        if(result) friend.remove();
        $.ajax({
          type: "POST",
          url: "main.php",
          data: 'friend=' + friend.innerText,
          cache: false,
        });
    };

    const _searchFriend = function(target){
            const friendsList = $('#items>li>span');
            for(let i of friendsList){
                if(target.toUpperCase() != i.innerText.slice(0, target.length).toUpperCase()){
                    i.style = 'display: none;';
                }else{
                    i.style = '';
                }
            }
    };

    const _search = function(target, key){
        $('#search_bar').children()[0].id == 'search_friend' ? _searchFriend(target) : (() => {if(key==13)_searchUser(target)})();
    }

    const _switchSearch = function(item){
      let searchBarTypes = $('.ui.two.item.menu');
        for(let i of searchBarTypes.children()){
          i.className = 'item';
        }
        item.className = 'active item';
        if(item == searchBarTypes.children()[0]){
          $('#items>li[aria=user]').remove();
          $('#search_bar').children()[0].id = 'search_friend';
          $('#search_friend').attr('placeholder','Find friend from list...');
          $('li[aria=friend]').show();
        }else{
          $('#search_bar').children()[0].id = 'search_user';
          $('#search_user').attr('placeholder','Find user in Enter... (press enter to search)');
          $('li[aria=friend]').hide();
        }
    };

    const _searchUser = function(target){
        console.log(`searching user.. (${target})`);
        $.ajax({
          type: "POST",
          url: "./php/search_user.php",
          data: 'user=' + target,
          cache: false
        }).done(function(data){
           for(let i of JSON.parse(data)){
             _Users.push(i[0]);
           }
           _generateUsersList();
           console.log(_Users);
        });
    };

    const _generateUsersList = function(){
        $('#items>li[aria=user]').remove();
        for(let user of _Users){
          $('#items').append(
            $('<li></li>').append(
              $('<i></i>').attr('class', 'add user icon message'),
              $('<span></span>').text(user)
            ).attr('aria', 'user')
          );
        }
        _Users.length = 0;
    };

    const _generateFriendsList = function(friends_list){
        for(let nick of friends_list){
            $('#items').append(
              $('<li></li>').append(
                $('<i></i>').attr('class', 'comment icon message'),
                $('<i></i>').attr('class', 'ban icon remove_friend'),
                $('<span></span>').text(nick)
              ).attr('aria', 'friend')
            );
        }
    };

    const _init = function(friends_list){
        _generateFriendsList(friends_list);
        for(let i of $('.ban.icon.remove_friend')){
            i.addEventListener('click', e => _removeFriend(e.target.parentElement));
        }
        for(let i of $('.ui.two.item.menu').children()){
          i.addEventListener('click', e => _switchSearch(e.target));
        }
        //document.getElementById('search_friend').addEventListener('keypress', e => _search(e.target.value, e.which));
        document.getElementById('search_friend').addEventListener('keyup', e => _search(e.target.value, e.which));
    };

    return {

        init : _init

    };

})();
