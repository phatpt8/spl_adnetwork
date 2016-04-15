$(function(){

    $('#slide-submenu').on('click',function() {
        $('#admin_content').addClass('col-md-11').removeClass('col-md-9');
        $(this).closest('.list-group').fadeOut(100,function(){
            $('.mini-submenu').fadeIn();
        });
    });

    $('.mini-submenu').on('click',function(){
        $('#admin_content').addClass('col-md-9').removeClass('col-md-11');
        $(this).next('.list-group').toggle('slide');
        $('.mini-submenu').hide();
    });

    if (document.location.href.indexOf("/index") == -1) {
        $("#anchorIndex").css("display", "block");
        $('#admin_content').addClass('col-md-11').removeClass('col-md-9');
        $('.mini-submenu').css("display", "block");
        $('.list-group').css("display", "none");
    } else {
        setTimeout(function () {
            $('#admin_content').addClass('col-md-11').removeClass('col-md-9');
            $('.list-group').fadeOut(200,function(){
                $('.mini-submenu').fadeIn();
            });
        }, 7000)
    }

});