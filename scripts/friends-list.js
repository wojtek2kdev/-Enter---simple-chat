const removeFriend = function(friend){
    let result = confirm('Are you sure to delete this user?');
    if(result) friend.remove();
    // in future, xhr remove from database.
};

const preinit = function(){
    for(let i of document.getElementsByClassName('ban icon remove_friend')){
        i.addEventListener('click', e => removeFriend(e.target.parentElement));
    }
};

(function init(){
    document.addEventListener('DOMContentLoaded', preinit);
})();
