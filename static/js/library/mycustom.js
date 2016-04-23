$(function(){

    setTimeout(function(){
        window.location.reload(true);
    }, 900000); // auto reload 15mins

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
    } else if (document.location.href.indexOf("/admin/index") == -1) {
        setTimeout(function () {
            $('#admin_content').addClass('col-md-11').removeClass('col-md-9');
            $('.list-group').fadeOut(200,function(){
                $('.mini-submenu').fadeIn();
            });
        }, 7000)
    }

    $(".btn-get-embed-code").on("click", function() {
        $("#getcodeModal").find("code#embedZone").text('<ins class="adsbypspl" data-zone="' + this.getAttribute("data-zone-id") + '" data-ad-width="' + this.getAttribute("data-zone-width") + '" data-ad-height="' + this.getAttribute("data-zone-height") + '"></ins><script> (adsbypspl = window.adsbypspl || []).push({}); </script>')
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

    $("#format").change(function() {
        if ($(this).val() == "202") {
            $("#placement").val("480x270");
            $("#divMediafile").css('display', 'block');
            $("#hint").css('display','block');
            $("#hint").html('<i>Size 480x270 is suitable for Rich Media Video format</i>');
        } else {
            $("#divMediafile").css('display', 'none');
        }
    });

    $("#placement").change(function() {
        if ($(this).val() == "480x270") {
            $("#format").val("202")
            $("#divMediafile").css('display', 'block');
            $("#hint").css('display','block');
            $("#hint").html('<i>Size 480x270 is suitable for Rich Media Video format</i>');
        } else {
            $("#divMediafile").css('display', 'none');
        }
    });

    $(".list-group-item").on("click", function(){
        $(this).addClass("active");
    });

    $("#amount").keyup(function() {
        var amount = $(this).val();
        var amountRegex = new RegExp(/^[0-9]/g);
        if (!amountRegex.test(amount)) {
            alert("Error -> should be positive numbers!");
            $(this).val(amount.replace(/[^[0-9] ]/g, ""))
        }
        if (parseInt(amount, 10) > 1E11) {
            alert("Error -> exceed limit value!");
            $(this).val("");
        }
    });

    var timer = $('.timer');
    if (typeof timer.countTo == "function") {timer.countTo({speed: 2000, refreshInterval: 50});}

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    function isInputNumber(str) {
        var regex = /^[0-9()-]+$/;
        return regex.test(str);
    }

    $("#email").blur(function() {
        if ( $(this).val() !== '' && !isEmail($(this).val())) {
            alert("Email is invalid!");
            $(this).val("")
        }
    });

    $("#phone").blur(function(){
        if ( $(this).val() !== '' && !isInputNumber($(this).val())) {
            alert("Phone is invalid!");
            $(this).val("")
        }
    });

    $("#price").blur(function(){
        if(parseInt($(this).val(), 10) < 1500) {
            alert("Price must > 1500");
            $(this).val("1500")
        }
    });

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#previewImage').css('display', 'block');
                $('#previewImage').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);

            $("#image").val("")
        }
    }

    $("#uploadimage").change(function(){
        readURL(this);
    });

    $("#uploadmediafile").change(function(){
        if (this.files && this.files[0]) {
            $("#mediafile").val("")
        }
    });

    //$("#uploadmediafile").change(function(){
    //    $("#mediafile").val("");
    //});

    //$("#form_add_banner").submit(function() {
    //    var current = (new Date()).getTime();
    //    var to = current + 5000;
    //    var t = setInterval(function(){
    //        $('body').css('opacity', 0.3);
    //        if ((new Date()).getTime() < to) {
    //            return;
    //        }
    //        clearInterval( t );
    //        $('body').css('opacity', 1);
    //    }, 100);
    //})

    $("#form_add_banner").bind('ajax:complete', function() {

    })

});