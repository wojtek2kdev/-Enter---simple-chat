const removeFriend = function(friend){
    let result = confirm('Are you sure to delete this user?');
    if(result) friend.remove();
    // in future, xhr remove from database.
};

const searchFriend = function(target){
        const friendsList = document.getElementById('items').children;
        for(let i of friendsList){
            if(target.toUpperCase() != i.children[0].innerText.slice(0, target.length).toUpperCase()){
                i.style = 'display: none;';
            }else{
                i.style = '';
            }
        }
}

const preinit = function(){
    for(let i of document.getElementsByClassName('ban icon remove_friend')){
        i.addEventListener('click', e => removeFriend(e.target.parentElement));
    }
    document.getElementById('search').addEventListener('input', e => searchFriend(e.target.value));
};

(function init(){
    document.addEventListener('DOMContentLoaded', preinit);
})();
