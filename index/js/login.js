$( document ).ready(function() {
    login.init()
});

var login = {
    init:function () {
        login.registerAccess();
    },
    registerAccess:function () {
        $('#register').click( function () {
            $('#loginContainer').css('display','none')
            $('#registerContainer').css('display','flex')
        })
        $('#login').click( function () {
            $('#loginContainer').css('display','flex')
            $('#registerContainer').css('display','none')
        })
    }
}