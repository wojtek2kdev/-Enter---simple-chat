const FriendsList = (function(){
    const _removeFriend = function(friend){
        let result = confirm('Are you sure to delete this user?');
        if(result) friend.remove();
        // in future, xhr remove from database.
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
    }

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
            item.appendChild(message_icon)
            item.appendChild(remove_icon);
            item.appendChild(nickname);
            list.appendChild(item);
        }
    }

    const _init = function(friends_list){
        _generateList(friends_list);
        for(let i of document.getElementsByClassName('ban icon remove_friend')){
            i.addEventListener('click', e => _removeFriend(e.target.parentElement));
        }
        document.getElementById('search').addEventListener('input', e => _searchFriend(e.target.value));
    };

    return {
        
        init : _init

    };

})();
