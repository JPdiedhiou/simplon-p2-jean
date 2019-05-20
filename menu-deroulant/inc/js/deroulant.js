/*
 **Script d'affichage et de retrait du menu sur version mobile**
 */
var menu = false;
$('.fa-list.modify').click(function() {
    if (menu == false) {
        $('.nav').fadeIn();
        menu = true;
    } else {
        $('.nav').fadeOut();
        menu = false;
    }
})