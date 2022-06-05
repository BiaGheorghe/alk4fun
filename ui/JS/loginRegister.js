function addActive() {
    let formBx = document.getElementById('formBx');
    formBx.classList.add('active');
}

function removeActive() {
    let formBx = document.getElementById('formBx');
    formBx.classList.remove('active');
}
function samecombowarning(){
    alert("A user with the same username and email combination already exists.");
}