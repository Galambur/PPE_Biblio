document.getElementById('store').storeID.onchange = function() {
    var newaction = this.value;
    document.getElementById('store').action = newaction;
};


function changeAction(val){
    document.getElementById('storeID').setAttribute('action', val);
}
