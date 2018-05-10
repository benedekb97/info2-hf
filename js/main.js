$(document).ready(function() {
    $('#login_button').click(function(){
        $('#login_form').fadeIn();
        $('#page-mask').fadeIn();
    });

    $('#close_login_form').click(function(){
        $('#login_form').fadeOut();
        $('#page-mask').fadeOut();
    });

    url = window.location.toString();

    login = url.substring(url.indexOf('#')+1);

    console.log(login);

    if(login == "login"){
        $('#login_form').css('display','block');
        $('#page-mask').css('display','block');
    }
});