$(function(){

    $('#slide-submenu').on('click',function() {
        $('#admin_content').removeClass('col-md-9').addClass('col-md-11');
        $(this).closest('.list-group').fadeOut(100,function(){
            $('.mini-submenu').fadeIn();
        });
    });

    $('.mini-submenu').on('click',function(){
        $('#admin_content').removeClass('col-md-11').addClass('col-md-9');
        $(this).next('.list-group').toggle('slide');
        $('.mini-submenu').hide();
    })

    setTimeout(function() {
        $('#admin_content').removeClass('col-md-9').addClass('col-md-11');
        $('#slide-submenu').closest('.list-group').fadeOut(1000,function(){
            $('.mini-submenu').fadeIn();
        });
    }, 5000);
});