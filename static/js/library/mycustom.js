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

    $(".btn-get-embed-code").on("click", function() {
        console.log($("#getcodeModal").find("code#embedZone").text('<ins class="adsbypspl" data-zone="' + this.getAttribute("data-zone-id") + '" data-ad-width="' + this.getAttribute("data-zone-width") + '" data-ad-height="' + this.getAttribute("data-zone-height") + '"></ins><script> (adsbypspl = window.adsbypspl || []).push({}); </script>'))
    });

    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };

    var url = window.location.href.split('?')[0];
    var status = getUrlParameter("status");
    var error = getUrlParameter("err") || getUrlParameter("error");
    if (status) {
        alert("Notification: " + status);
        window.location.href = url;
    }
    if (error) {
        alert("Error -> " + error);
        window.location.href = url;
    }

});