Number.prototype.map = function (in_min, in_max, out_min, out_max) {
    return (this - in_min) * (out_max - out_min) / (in_max - in_min) + out_min;
};

$(function () {
    $('.blocks').click(function (e) {
        console.log('click');
        $(e.target).remove();
    });

    $(window).scroll(function () {
        var s = $(window).scrollTop(),
            h = $(document).height() - $(window).height();

        $('.sidebar.background .background').css('top', s.map(0, h, 0, -10) + '%');
        if (s > 7) {
            $('.nav-bar-wrapper .nav-bar').css('top', s.map(0, h, 10, -10) + '%');
            $('.sidebar').addClass('closed');
            $('.nav-bar-wrapper').addClass('closed');
            $('.nav-item').removeClass('selected');
        } else {
            $('.nav-bar-wrapper .nav-bar').css('top', s.map(0, h, 40, 35) + '%');
            $('.sidebar').removeClass('closed');
            $('.nav-bar-wrapper').removeClass('closed');
            $('.nav-item').addClass('selected');
        }
    });

});