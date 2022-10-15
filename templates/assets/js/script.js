let passwordField = document.getElementById("password1");
let passwordField2 = document.getElementById("password2");
let registryButton = document.getElementById("successbtn");
registryButton.disabled = true;
function checkPassword(){

    if(passwordField2.value !== passwordField.value){
        registryButton.disabled = true;
    }else{
        registryButton.disabled = false;
        console.log(passwordField.value);
        console.log(passwordField2.value);
    }
}
checkPassword();

