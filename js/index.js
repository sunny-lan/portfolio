Number.prototype.map = function (in_min, in_max, out_min, out_max) {
    return (this - in_min) * (out_max - out_min) / (in_max - in_min) + out_min;
};

function performLayout(articles, orderFunc) {
    var infoBlock = $('#info-blocks');

    //clear old elements
    infoBlock.empty();
    $('#nav-bar*').empty();

    var navBar = $("#nav-bar");

    for (var articleID in articles) if (articles.hasOwnProperty(articleID)) {
        var article = articles[articleID];
        article.previewElem = $(
            "<div " +
            "id='article-preview-" + articleID + "' " +
            "class='info-block'><div class='content'>" +
            article.preview +
            "</div></div>");
        infoBlock.append(article.previewElem);

        article.navBarElem = $(
            "<div id='nav-item-" + articleID + "' class='nav-item'>" +
            article.navLabel +
            "</div>");
        navBar.append(article.navBarElem);
    }
}

$(function () {
    //Load content:
    var schema = JSON.parse(document.getElementById('injected-schema').innerHTML);
    var articles = schema.articles;
    performLayout(articles);

    $('#name-block').addClass('selected');

    function scrollCalc() {
        //calculate scroll location
        var s = $(window).scrollTop(),
            pgHeight = $(window).height(),
            h = $(document).height() - pgHeight;

        //background image parallax
        $('.background').css('top', s.map(0, h, 0, -10) + '%');

        // Intro -> Content transitions, navbar parallax
        if (s > 10) {
            $('#nav-bar').css('top', s.map(0, h, 35, 0) + '%');
            $('.sidebar').addClass('closed');
            $('#nav-bar-wrapper').addClass('closed');
        } else {
            $('#nav-bar').css('top', s.map(0, h, 40, 35) + '%');
            $('.sidebar').removeClass('closed');
            $('#nav-bar-wrapper').removeClass('closed');
        }

        // Selected animations
        var errAllow = 50;
        var viewStart = s  - errAllow,
            viewEnd = s + pgHeight + errAllow;

        // console.log("View start:", viewStart, "View end:", viewEnd);

        for (var articleID in articles) if (articles.hasOwnProperty(articleID)) {
            var article = articles[articleID];
            var element = article.previewElem;
            var top = element.offset().top,
                bottom = top + element.height();

            // console.log("top: ", top, "bottom: ", bottom);

            if (top >= viewStart && bottom <= viewEnd)
                article.navBarElem.addClass('selected');
            else
                article.navBarElem.removeClass('selected');
        }
    }

    $(window).scroll(scrollCalc);

    scrollCalc();
});