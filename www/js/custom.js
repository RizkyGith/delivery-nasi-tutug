$(function() {

    //* show hide alamat keranjang *\\
    $(document).ready(function(){

        $('.red.box').hide();
        $('.green.box').hide();

        $('input[type="radio"]').click(function(){
            if($(this).attr("value")=="red"){
                $(".box").not(".red").hide();
                $(".red").show();
            }
            if($(this).attr("value")=="green"){
                $(".box").not(".green").hide();
                $(".green").show();
            }
            
        });
    });

    //* laporan belanja
    $("advanced-area").hide();
    $(document).ready(function() {
        $('.dropdown-button'). click(function() {
            $(".advanced-area").slideToggle();
        });
    });

    //* jika update sudah terpilih superadministrator maka hide branch location
    if ('input[type="checkbox"][value="1"]') {
        $('select[name="branch_id"]').hide();
    }

    //* jika user memilih user role id Super Administrator -> hide 
    $('input[type="checkbox"]').click(function(e){
        if ($(this).attr('value')=="1") {
            $('select[name="branch_id"]').toggle();         
        } 
    });               

    $('.dropdown-menu').hide();
    $('.dropdown-menu .dropdown').click(function(){
        $(this).toggleClass("open");
        $(this).parent().parent().siblings('.form-menu').slideToggle(100);
    });

    //* class calender
    $('table.calender tbody tr td p').hide();
    setTimeout(function(){
        var a = $('table.calender').width() / 9;
        $('table.calender tbody tr td p').css('width', Math.floor(a));
        $('table.calender tbody tr td p').show();
        $('table.calender').css('width', Math.floor(a))

    }, 1000);

    $("#searchbar").keypress(function(evt){

        if(evt.keyCode == 13){
            evt.preventDefault();

            var findValue = $(this).val();
            var Url = window.location.href.replace(/\?.*/g,"");
            if(findValue.length == 0){
                return;
            }else{
                var finderUrl = Url + '?!search=' + findValue;
            }
            window.location = finderUrl;
        }
    });

    $(".popup").popup({
        className: "detailPopup",
        closeButton: false
    });


// popup image detail asset
    $('#img-asset').popup({
        target : "#detail-img-asset",
        animation : "fadeIn"
    });

    $('.menu.expand').click(function(){
        var obj = $(this)
        var a = obj.nextUntil(".menu.expand");
        var hide = obj.attr('hide');

        var icon = obj.find('i');



        if(hide){
            obj.removeAttr('hide');
            $(this).removeClass('hide');
            icon.removeClass('xn-plus-squared');
            icon.addClass('xn-minus-squared');
        }else{
            obj.attr('hide',true);
            $(this).addClass('hide');
            icon.removeClass('xn-minus-squared');
            icon.addClass('xn-plus-squared');
        }
        
        $.each(a,function(){
            if(hide){
                $(this).show('slow','easeOutExpo');
            }else{
                $(this).hide('slow','easeOutExpo');
            }
            
        });

    });    


});

function uuid() {
    return Math.floor((1 + Math.random()) * 0x10000)
      .toString(16);
}






