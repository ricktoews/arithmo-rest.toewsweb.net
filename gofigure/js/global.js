var popup = function(id) {
    var t = parseInt(($(window).height() - $(id).height()) / 2 - 100) + 'px';
    var l = parseInt(($(window).width() - $(id).outerWidth()) / 2) + 'px'; 

    $(id).css({'top':t, 'left':l});
    $('#overlay').fadeIn('fast', function() { $(id).show(); });
};



