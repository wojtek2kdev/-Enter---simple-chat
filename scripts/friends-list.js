const FriendsList = (function(){

    const _Users = [];

    const _removeFriend = function(friend){
        let result = confirm('Are you sure to delete this user?');
        if(result){
        friend.remove();
        $.ajax({
          type: "POST",
          url: "main.php",
          data: 'friend=' + friend.innerText,
          cache: false,
        });
      }
    };

    const _searchFriend = function(target){
            const friendsList = $('#items>li');
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

    const _sendFriendRequest = function(target){
      $.ajax({
          type: "POST",
          url: "/php/user/friend-request.php",
          data: 'action=add&user=' + $(target).text(),
          cache: false
        }).done(function(data){
           if(data){
             throw data;
           }else{
             target.parentElement.remove();
           }
        });
    }

    const _searchUser = function(target){
      _Users.length = 0;
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
        _seeMoreUsers();
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

    const _seeMoreUsers = function(){
              let users;
              const maxUsers = 10;
              _Users.length >= maxUsers ? users = _Users.splice(0,maxUsers) : users = _Users;
              for(let user of users){
                $('#items').append(
                  $('<li></li>').append(
                    $('<i></i>').attr('class', 'add user icon message'),
                    $('<span></span>').text(user)
                  ).attr('aria', 'user')
                );
              }

              $('li[aria=user]>i').on('click', e => _sendFriendRequest($(e.target).siblings('span')[0]));

              _Users.length < maxUsers ? (()=>{$('#see_more').hide(); _Users.length = 0;})() : $('#see_more').show();
    };

    const _init = function(friends_list){
        _generateFriendsList(friends_list);
        $('#see_more').hide();
        //Listeners
        $('.ban.icon.remove_friend').on('click', e => _removeFriend(e.target.parentElement));
        $('.ui.two.item.menu').children().on('click', e => _switchSearch(e.target));
        $('#search_friend').on('keyup', e => _search(e.target.value, e.which));
        $('#see_more').on('click', _seeMoreUsers);

    };

    return {

        init : _init

    };

})();
