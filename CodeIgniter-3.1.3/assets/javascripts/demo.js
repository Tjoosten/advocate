$(document).ready(function() {

    var c = readCookie('limon_style');
    if (c) switchStylesheet(c);

    //var d = readCookie('limon_bg');
    //if (d) switchBg(d);

    $(".color-picker").miniColors({
        letterCase: 'uppercase',
        change: function(hex, rgb) {
            $("section.page_heading").css("background", hex);
            $("h1, h2").css("color", hex);
            $(".icon, .color").css("color", hex);
            $("div.events ul li .date").css("background", hex);
            $(".donate_button").css("background", hex);
            //$("section a").css("color", hex);
            $("#toTop").hover(function() { $(this).css("color", hex); });
        }
    });

    $("#theme_options ul.backgrounds li").click(function() {
        switchBg($(this).attr("class"));
    });

    $("#theme_options ul.colors li").click(function() {
        switchStylesheet($(this).attr("class"));
    });

    $(".show_switcher").hover(function() {
        $(this).stop(true, true).hide();
        $(".color_picker").fadeIn(200);
    });
    $(".color_picker").live("mouseleave", function() {
        $(this).stop(true, true).fadeOut(200, function() {
            $(".show_switcher").stop(true, true).fadeIn(200);
        });
    });
});
function switchStylesheet(styleName) {
    if(styleName == "") {

    } else {
        $("link[media='screen']").attr("href", 'stylesheets/'+styleName+'.css');
    }
    createCookie('scrolio_style', styleName, 365);
}
function switchBg(bg) {
    if(bg == "") {

    } else {
        $("body").removeClass();
        $("body").addClass(bg)
    }
    //createCookie('limon_bg', bg, 365);
}
function createCookie(name,value,days)
{
    if (days)
    {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}
function readCookie(name)
{
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++)
    {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name)
{
    createCookie(name,"",-1);
}

