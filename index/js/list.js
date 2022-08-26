$( document ).ready(function() {
    list.init()
});

var list = {
    init:function () {
        list.switchChoise();
        list.switchAll();
        list.openProductDialog();
        list.addProduct();
        list.modifyProduct();
        list.shareProduct();
        list.disconnect();
    },
    switchChoise:function () {
        $('.buttonChoise').click( function () {
            if ($(this).attr('id') != undefined) {
                return
            }
            $('.buttonChoise').each( function () {
                $(this).removeAttr('id');
            })
            $(this).attr('id', 'selectedChoise')
            switch ($(this).attr('value')) {
                case 'all':
                    $('#buttonAdd').css('display','block');
                    list.switchAll();
                    break;
                case 'sharWithMe':
                    $('#buttonAdd').css('display','none');
                    list.switchShareWithMe();
                    break;
                case 'sharByMe':
                    $('#buttonAdd').css('display','none');
                    list.switchShareByMe();
                    break;
            }
        })
    },
    switchAll:function () {
        $.ajax({
            url: 'ajax/list.php',
            type: "post",
            data: {action: 'all'},
            success: function (e) {
                $('#listContainer').html(e);
            },
            error: function (e) {
                alert(e);
            }
        })
    },
    switchShareWithMe:function () {
        $.ajax({
            url: 'ajax/list.php',
            type: "post",
            data: {action: 'shareWithMe'},
            success: function (e) {
                $('#listContainer').html(e);
            },
            error: function (e) {
                alert(e);
            }
        })
    },
    switchShareByMe:function () {
        $.ajax({
            url: 'ajax/list.php',
            type: "post",
            data: {action: 'shareByMe'},
            success: function (e) {
                $('#listContainer').html(e);
            },
            error: function (e) {
                alert(e);
            }
        })
    },
    openProductDialog:function () {
        $('#buttonAdd').click( function () {
            $('#nameProduct').val("");
            $('#numberProduct').val("");
            $('#descriptionProduct').val("");
            $('#dialogAdd').dialog({ 
                modal: true,
                width: 500,
                height: 200
               });;
        })
    },
    addProduct:function () {
        $('#addProduct').click( function () {
            var description = $('#descriptionProduct').val();
            var name = $('#nameProduct').val();
            var number = $('#numberProduct').val();
            if (name.length > 50 ) {
                alert('Product name too long');
                return;
            }
            if (number.length > 50 ) {
                alert('number length too long');
                return;
            }
            if (name && $.isNumeric(number)) {
                $.ajax({
                    url: 'ajax/list.php',
                    type: "post",
                    data: {
                        action: 'addProduct',
                        description: description,
                        name: name,
                        number: number
                    },
                    success: function (e) {
                        alert(e);
                        $('#dialogAdd').dialog('close');
                        $('#buttonAdd').css('display','block');
                        list.switchAll();
                    },
                    error: function (e) {
                        alert(e);
                    }
                })
            } else {
                alert("one or more field are empty")
            }
        })
    },
    deleteProduct:function (e) {
        var id = $(e).parent('.listObjectButton').attr('id');
        $.ajax({
            url: 'ajax/list.php',
            type: "post",
            data: {
                action: 'delete',
                id: id
            },
            success: function (e) {
                location.reload()
            },
            error: function (e) {
                alert(e);
            }
        })
    },
    modifyProductDialog:function (e) {
        var id = $(e).parent('.listObjectButton').attr('id');
        var name = $(e).parent('.listObjectButton').parent('.listObjectContainer').children('.mainInfoContainer').children('.listObjectName').text();
        var number = $(e).parent('.listObjectButton').parent('.listObjectContainer').children('.mainInfoContainer').children('.listObjectNumber').text();
        var description = $(e).parent('.listObjectButton').parent('.listObjectContainer').children('.listObjectDescription').text();
        
            $('#dialogModify').dialog({ 
                modal: true,
                width: 500,
                height: 200
               });
            $('#modifyProductName').val(name);
            $('#modifyProductNumber').val(number);
            $('#modifyProductDescription').text(description);
            $('#modifyProduct').attr('value', id);
        
        
    },
    modifyProduct:function () {
        $('#modifyProduct').click( function() {
            var id = $('#modifyProduct').attr('value');
            var name = $('#modifyProductName').val();
            var number = $('#modifyProductNumber').val();
            var description = $('#modifyProductDescription').val();
            if (name.length > 50 ) {
                alert('Product name too long');
                return;
            }
            if (number.length > 50 ) {
                alert('number length too long');
                return;
            }
            if (name && $.isNumeric(number)) {
                $.ajax({
                    url: 'ajax/list.php',
                    type: "post",
                    data: {
                        action: 'modify',
                        id: id,
                        name: name,
                        number: number,
                        description: description
                    },
                    success: function (e) {
                        alert('modify');
                        $('#dialogModify').dialog('close');
                        list.switchAll();
                    },
                    error: function (e) {
                        alert(e);
                    }
                })
            } else {
                alert("one or more field are empty")
            }
        })
    },
    shareProductDialog:function (e) {
        var id = $(e).parent('.listObjectButton').attr('id');
        $('#shareProduct').attr('value', id);
        $('#dialogShare').dialog({ 
            modal: true,
            width: 500,
            height: 100
           });
    },
    shareProduct:function () {
        $('#shareProduct').click( function() {
            var email = $('#emailForShare').val();
            var idProduct = $('#shareProduct').attr('value');
            $.ajax({
                url: 'ajax/list.php',
                type: "post",
                data: {
                    action: 'share',
                    email: email,
                    idProduct
                },
                success: function (e) {
                    if (e == "") {
                        alert('success');
                        $('#dialogShare').dialog('close');
                        list.switchAll();
                    } else {
                        alert(e);
                    }
                    
                },
                error: function (e) {
                    alert(e);
                }
            })
        })
    },
    deleteShareProduct:function (e) {
        var idProduct = $(e).parent('.listObjectButton').attr('id');
        $.ajax({
            url: 'ajax/list.php',
            type: "post",
            data: {
                action: 'deleteShare',
                idProduct: idProduct
            },
            success: function (e) {
                alert(e);
                list.switchShareWithMe();
            },
            error: function (e) {
                alert(e);
            }
        })
    },
    disconnect:function () {
        $('#discoButton').click( function () {
            $.ajax({
                url: 'ajax/disconnect.php',
                type: "post",
                data: {
                },
                success: function (e) {
                    window.location.replace("login.php");
                },
                error: function (e) {
                    alert(e);
                }
            })
        })   
    },
    unshareShareProduct:function (e) {
        var idProduct = $(e).parent('.listObjectButton').attr('id');
        $.ajax({
            url: 'ajax/list.php',
            type: "post",
            data: {action: 'unshareProduct',
            idProduct: idProduct
            },
            success: function (e) {
                alert('unshare');
                list.switchShareByMe();
            },
            error: function (e) {
                alert(e);
            }
        })
    }
}
