$(function(){
    if ((document.location.host.indexOf('.dev') > -1) || (document.location.host.indexOf('modernui') > -1) ) {
        $("<script/>").attr('src', 'View/js/metro/metro-loader.js').appendTo($('head'));
    } else {
        $("<script/>").attr('src', 'View/js/metro.min.js').appendTo($('head'));
    }
})