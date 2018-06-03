// $(window).resize(function() {
//     if ($(window).width() < 740) {
//         $(".page-title").removeClass("display-4");
//     } else {
//         $(".page-title").addClass("display-4");
//     }
// });

$(document).ready(function() {
    $('.display').DataTable();
});

function activateInsertion() {

    if(userUpdateForm.new_pswd_setting.checked){
        document.userUpdateForm.new_password.disabled=false;
        document.userUpdateForm.new_password_confirmation.disabled=false;
    } else {
        document.userUpdateForm.new_password.disabled=true;
        document.userUpdateForm.new_password_confirmation.disabled=true;
    }
}