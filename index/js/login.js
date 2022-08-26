$( document ).ready(function() {
    login.init()
});

var login = {
    init:function () {
        login.registerAccess();
        login.checkLogin();
        login.register();
    },
    registerAccess:function () {
        $('#register').click( function () {
            $('#loginContainer').css('display','none')
            $('#registerContainer').css('display','flex')
        })
        $('#returnLogin').click( function () {
            $('#loginContainer').css('display','flex')
            $('#registerContainer').css('display','none')
        })
    },
    checkLogin:function () {
        $('#connection').click( function () {
            var login = "";
            var password = "";
            $('input').each( function () {
                switch ($(this).attr('id')) {
                    case 'login':
                        login = $(this).val();
                        break;
                    case 'password':
                        password = $(this).val();
                        break;
                }
            })
            console.log(login+password);
            $.ajax({
                url: 'ajax/login.php',
                type: "post",
                data: {
                    action: 'login',
                    login: login,
                    password: password
                },
                success: function (e) {
                    if (e == true) {
                        window.location.replace("list.php");
                    } else {
                        alert ('login or password is invalid');
                    }
                },
                error: function (e) {
                    alert(e);
                }
            })
        })
    },
    register:function () {
        $('#registerUser').click( function () {
            var email = "";
            var lastname = "";
            var firstname = "";
            var password = "";
            var empty = false;
            $('input').each( function () {
                switch ($(this).attr('id')) {
                    case 'email':
                        if ($(this).val() != "") {
                            email = $(this).val();
                        } else {
                            empty = true;
                            break;
                        }
                        break;
                    case 'passwordRegister':
                        if ($(this).val() != "") {
                            password = $(this).val();
                        } else {
                            empty = true;
                            break;
                        }
                        break;
                    case 'lastname':
                        if ($(this).val() != "") {
                            lastname = $(this).val();
                        } else {
                            empty = true;
                            break;
                        }
                        break;
                    case 'firstname':
                        if ($(this).val() != "") {
                            firstname = $(this).val();
                        } else {
                            empty = true;
                            break;
                        }
                        break;
                }
            })
            if (email && password && firstname && lastname) {
                $.ajax({
                    url: 'ajax/login.php',
                    type: "post",
                    data: {
                        action: 'register',
                        email: email,
                        password: password,
                        lastname: lastname,
                        firstname: firstname
                    },
                    success: function (e) {
                        if (e==true) {
                            window.location.replace("list.php");
                        } else {
                            alert(e);
                        }
                    },
                    error: function (e) {
                        alert(e);
                    }
                })
            } else {
                alert('one or more field are empty');
            }
            
        })
    }
}