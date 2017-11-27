const FriendsList = (function(){

    const _Users = [];

    const _ChatList = [];

    let _ChatElements = [];

    let _ChatOpened = false;

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

    const _openChatWithFriend = function(friend){
      console.log(friend);
      if(_ChatList.indexOf(friend) > -1){
        throw `Chat with ${friend} is already opened.`;
        return;
      }
       $('#msg>.start').hide();
       _ChatList.push(friend);
       console.log(_ChatList);
       if(!_ChatOpened) _openChat();
       let node = $('<li></li>').append(
         $('<span></span>').text(friend)
       ).append(
         $('<i class="remove icon" style="position: absolute; right: 0.5rem;"></i>')
       );
       $(node).on('click', e => _changeChat(e.target)).on(
         'click', 'span', e => {e.stopPropagation(); $(e.target.parentElement).trigger('click')}
       );
       $('#list').append(
         node
       );
       $('#list>li>i').on('click', e => _closeChatWithFriend(e.target));
       _ChatList.length == 1 ? _changeChat($('#list>li')) : _changeChat($('#list>li:last-child'));
    };

    const _changeChat = function(target){
     console.log(target);
     $('#list>li').css('background-color', '#F9F9F9');
     $(target).css('background-color', 'red');
    };

    const _closeChatWithFriend = function(friend){
      friend.parentElement.remove();
      for(let i in _ChatList){
        if(_ChatList[i] == $(friend).siblings('span').text()){
          console.log($(friend).siblings('span').text());
          _ChatList.splice(i,1);
        }
      }
            console.log(_ChatList);
      if(!_ChatList.length){
        _ChatOpened = false;
        _closeChat();
      }
      _changeChat($('#list>li:last-child'));
    };

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

    const _closeChat = function(){
      _ChatElements = [
        $('#s_chat_list'),
        $('#s_messages'),
        $('#s_write')
      ];
      for(let i of _ChatElements){
        $(i).hide();
      }
      $('#msg>.start').show();
    };

    const _openChat = function(){
      for(let i of _ChatElements){
        $(i).show();
      }
      $('#msg>.start').hide();
    };

    const _slide = function(direction){
      const _friendsBar = document.getElementsByClassName('chat_list')[0];
      const _max = _friendsBar.scrollWidth - _friendsBar.clientWidth;
      const _current = _friendsBar.scrollLeft;
      let _scale = 22 * parseFloat(getComputedStyle(document.documentElement).fontSize);
      console.log(_scale + ' ' + _max);
      if(direction == 'right'){
       if(_current < _max) _friendsBar.scrollLeft += _scale;
     } else{
       if(_current > 0) _friendsBar.scrollLeft -= _scale;
     }
    };

    const _init = function(friends_list){
        _generateFriendsList(friends_list);
        $('#see_more').hide();
        //Listeners
        $(document).ready(_closeChat);
        $(document).ready(function(){
          $('.chat_list').on('overflow', function(){
            $('.chat_list>i').each(function(){
              this.style.setProperty( 'display', 'inline-block', 'important' );
            });
            $($('.chat_list>i')[0]).on('click', function(){_slide('left');});
            $($('.chat_list>i')[1]).on('click', function(){_slide('right');});
          });
          $('.chat_list').on('underflow', function(){
            $('.chat_list>i').each(function(){
              this.style.setProperty( 'display', 'none', 'important' );
            });
          });
        });
        $('.comment.icon.message').on('click', e => _openChatWithFriend($(e.target).siblings('span').text()));
        $('.ban.icon.remove_friend').on('click', e => _removeFriend(e.target.parentElement));
        $('.ui.two.item.menu').children().on('click', e => _switchSearch(e.target));
        $('#search_friend').on('keyup', e => _search(e.target.value, e.which));
        $('#see_more').on('click', _seeMoreUsers);

    };

    return {

        init : _init

    };

})();
