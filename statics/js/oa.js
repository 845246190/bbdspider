$(function(){
    var win_h=$(window).height();
    var head_h=$(".header").height();
    $(".main_cont").css("min-height",win_h-head_h-40);
    $(".navs").css("min-height",win_h-head_h-40);
    $(".right_cont").css("min-height",win_h-head_h-40);
    $(".record").css("min-height",win_h-head_h-40);
    var navs_h=$(".navs").height()-110;
    $(".chat_record").height(win_h-160);
    $(".right_view_box").css('min-height',navs_h);
    $(".power_chose_left").height(win_h-221);
    $(".right_view").css('min-height',win_h-280);
     $(window).resize(function(){
        var win_h=$(window).height();
        var head_h=$(".header").height();
        $(".main_cont").css("min-height",win_h-head_h-40);
        $(".navs").css("min-height",win_h-head_h-40);
        $(".right_cont").css("min-height",win_h-head_h-40);
        $(".record").css("min-height",win_h-head_h-40);
        var navs_h=$(".navs").height()-110;
        $(".chat_record").height(win_h-160);
        $(".right_view_box").css('min-height',navs_h);
        $(".power_chose_left").height(win_h-221);
        $(".right_view").css('min-height',win_h-280);
    })
     
    var stdw=$(".from_infor").find('tr').eq(0).find('td').eq(1).width();
    $(".from_infor").find('table').width(stdw);

    $("body").on('click',".navs_cont .navs_list",function(){
        $(".navs_cont .navs_list").removeClass("hover_navs");
        $(this).addClass("hover_navs");
    });

    $(document).click(function (e){
        e.stopPropagation();
        $(".secrch_select ul").addClass("hide");
        $(".secrch_select input[type=text]").removeClass("text_style");
        $(".select ul").addClass("hide");
        $(".select1 ul").addClass("hide");
        $(".select2 ul").addClass("hide");
        $(".lianxiang ul").hide();
    });
    $(document).click(function (e){
        e.stopPropagation();
        if(!$(".user_do_list").hasClass("hide")){
            $(this).find("i").removeClass('hover_userdo');
            $(".user_do_list").addClass("hide");
        }
    });
    $(".select").click(function (e){
        e.stopPropagation();
        $(".select ul").addClass("hide");
        if($(this).find("ul").hasClass("hide")){
            $(this).find("ul").removeClass("hide");
        }
    });
    $(".select ul li").click(function(e){
         e.stopPropagation();
        var li_text=$(this).text();
        $(this).parent().parent().parent().find("input[type=text]").val(li_text);
        $(this).parent().addClass("hide");
    });
    $(".select").each(function(){
        if(!$(this).find("ul li").hasClass('checked')){
            var this_text=$(this).find("ul li:first").text();
            $(this).find("input[type=text]").val(this_text);
        }
        // var this_text=$(this).find("ul li:first").text();
        // $(this).find("input[type=text]").val(this_text);
    });

    $(".secrch_select ul li").click(function(){
        var li_text=$(this).text();
        $(this).parent().parent().parent().find("input[type=text]").val(li_text);
    });
    $(".secrch_select").each(function(){
        if(!$(this).find("ul li").hasClass('selected')){
            var this_text=$(this).find("ul li:first").text();
            $(this).find("input[type=text]").val(this_text);
        }
    });
    $(".secrch_select").click(function(e){
        e.stopPropagation();
        $(".secrch_select ul").addClass("hide");
        if($(this).find("ul").hasClass("hide")){
            $(this).find("ul").removeClass("hide");
            $(this).find("input[type=text]").addClass("text_style");
        }
    });
    $(".secrch_select input[type=text]").change(function(){
        alert("j");
    });

    $(".select1").click(function(e){
        e.stopPropagation();
        $(".select1 ul").addClass("hide");
        if($(this).find("ul").hasClass("hide")){
            $(this).find("ul").removeClass("hide");
        }
    });
    $(".select1 ul li").click(function(e){
        e.stopPropagation();
        var li_text=$(this).text();
        $(this).parent().parent().parent().find("input[type=text]").val(li_text);
        $(this).parent().addClass("hide");
    });
    $(".select1").each(function(){
        var this_text=$(this).find("ul li:first").text();
        $(this).find("input[type=text]").val(this_text);
    });

    $(".select2 input[type=button]").click(function(e){
        e.stopPropagation();
        $(".select2 ul").addClass("hide");
        if($(this).next().find("ul").hasClass("hide")){
            $(this).next().find("ul").removeClass("hide");
        }
    });
    $(".select2 ul li").click(function(){
        var li_text=$(this).text();
        $(this).parent().parent().parent().find("input[type=text]").val(li_text);
    });
    $(".select2").each(function(){
        var this_text=$(this).find("ul li:first").text();
        $(".select2").find("input[type=text]").val(this_text);
    });

    $(".pay_way input[type=radio]").click(function(){
        $(this).parent().parent().find("img").attr('src','/statics/images/no_pay.png')
        if($(this).attr('checked')=='checked'){
            $(this).prev().find("img").attr('src','/statics/images/pay.png');
        }
    });
    $(".chose_task input[type=radio]").click(function(){
        $(this).parent().parent().find("img").attr('src','/statics/images/no_pay.png')
        if($(this).attr('checked')=='checked'){
            $(this).prev().find("img").attr('src','/statics/images/pay.png');
        }
    });
    $(".pay_way input[type=checkbox]").click(function(){
        if($(this).attr('checked')=='checked'){
            $(this).prev().find("img").attr('src','/statics/images/checked.png');
        }else{
            $(this).prev().find("img").attr('src','/statics/images/check.png');
        }
    });
    $(".pay_way label").each(function(){
        if($(this).find("input[type=checkbox]").attr('checked')=='checked'){
            $(this).find("img").attr('src','/statics/images/checked.png');
        } 
        else if ($(this).find("input[type=radio]").attr('checked')=='checked'){
            $(this).find("img").attr('src','/statics/images/pay.png');
        } 
        else if (!$(this).find("input[type=radio]").attr('checked')=='checked'){
            $(this).find("img").attr('src','/statics/images/no_pay.png');
        }
        else if(!$(this).find("input[type=checkbox]").attr('checked')=='checked'){
            $(this).find("img").attr('src','/statics/images/check.png');
        } 
    });

    // $("#datepicker").datepicker();
    // $(".datepicker").datepicker();

    $(".chose_task input").click(function(){
        var this_href=$(this).data('href');
        $(".inform_center a").attr("href",this_href);
    });
    $(".search_th div").click(function(){
        $(this).addClass("hide");
        $(this).next().removeClass("hide");
        $(this).next().focus();
    });
    $(".search_th input[type=text]").blur(function(){
        $(this).parent().submit();
    });

    $(".user_name").click(function(e){
        e.stopPropagation();
        if($(this).next().hasClass("hide")){
            // $(this).find("img").attr("src","/statics/images/jiao.png");
            $(this).find("i").addClass('hover_userdo');
            $(this).next().removeClass("hide");
        }
    });
   

    $(".operation").click(function(){
        if($(".navs").hasClass("hide")){
            $(".navs").removeClass("hide");
            $(".right_cont").css("margin-left","310px");
        }else{
            $(".navs").addClass("hide");
            $(".right_cont").css("margin-left","0px");
        }
    });
})


//局部打印  wangw
function localprint(dom)
{
    var body=$('body').html(); 
    window.document.body.innerHTML=dom 
    window.print();
    window.document.body.innerHTML=body; 
}