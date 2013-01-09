function activateDropDown(pref, target) {
    var animate = true;
    var prefix = '#' + pref + 'dropdown-' + target;
    var menuPrefix = '#' + pref + 'item-' + target;
    var menu = $(prefix);
    var height = 0;
    var left = 0;
    height = $(prefix + ' .' + pref + 'dropdown-inner').height()+4+4+8;
    left = $(menuPrefix).position().left + $('#' + pref + 'bar').position().left;
        
    $(menuPrefix +', ' + prefix).hover(function(r){
        var item = $(this);
        if(item[0].className && item[0].className.indexOf('item') > -1 )
            //var left = item.position().left;
            menu.css('left', left+'px');
        menu.clearQueue().animate({
            height:height+'px'
        }, 200);
        $(menuPrefix).addClass('active');
        
        animate = false;
        setTimeout(function(){
            animate = true;
        },1);
    }, function(r) {
        setTimeout(function(){
            if (animate) {
                menu.animate({
                    height:'0px'
                }, 200);
                $(menuPrefix).removeClass('active');
            }
        }, 0);
    });
}

function hideLeftMenuBar(){
    var closeWidth="20px";
    var openWidth="300px";
    var leftMenuBar = $("#left-menu-bar");
    var leftMenuBarContent = $("#left-menu-bar-content");
    var buttonImg = $("#left-bar-tooolbar-button img");
    var content = $("#content");
        
    if(leftMenuBar.css("width")==openWidth){
        leftMenuBar.css("width",closeWidth);
        //leftMenuBarContent.css("display", "none");
        leftMenuBarContent.hide("fade", {}, "slow");
        buttonImg.attr("src", "Assets/Images/right-arrow-mini.png");
        content.css("margin-left", closeWidth);
    }else{
        leftMenuBar.css("width",openWidth);
        //leftMenuBarContent.css("display", "block");
        leftMenuBarContent.show("fade", {}, "slow");
        buttonImg.attr("src", "Assets/Images/left-arrow-mini.png");
        content.css("margin-left", openWidth);
    }
}

$(function() {
    $( "#tabs" ).tabs();
});
