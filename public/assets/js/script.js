function showPopup() {
    document.getElementById("#popup-login").style.display = "none";
}

function activateInsertion() {

    if(userUpdateForm.new_pswd_setting.checked){
        document.userUpdateForm.new_password.disabled=false;
        document.userUpdateForm.new_password_confirmation.disabled=false;
    }

    else{
        document.userUpdateForm.new_password.disabled=true;
        document.userUpdateForm.new_password_confirmation.disabled=true;
    }
}
