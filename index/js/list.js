$( document ).ready(function() {
    list.init()
});

var list = {
    init:function () {
        list.switchChoise();
        list.switchAll();
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
                    list.switchAll();
                    break;
                case 'sharWithMe':
                    break;
                case 'sharByMe':
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
                // console.log(e);
            },
            error: function (e) {
                alert(e);
            }
        })
    }
}