Number.prototype.map = function (in_min, in_max, out_min, out_max) {
    return (this - in_min) * (out_max - out_min) / (in_max - in_min) + out_min;
};


var articles;

function performLayout(orderFunc) {
    var infoBlock = $('#info-blocks');

    //clear old elements
    infoBlock.empty();
    $('#nav-bar*').empty();

    var navBar = $("#nav-bar");

    var topMostArticleID = null;
    var minOrder = Number.MAX_VALUE;

    var count = 0;

    for (var articleID in articles) if (articles.hasOwnProperty(articleID)) {
        var article = articles[articleID];

        //compare to see if this is the topmost article
        var order = orderFunc(article);
        if (order < minOrder) {
            minOrder = order;
            topMostArticleID = articleID;
        }

        //inject preview into HTML
        article.previewElem = $(
            "<div " +
            "id='article-preview-" + articleID + "' " +
            "class='info-block' style='order: " + order + ";'><div class='content'>" +
            article.preview +
            "</div></div>");
        infoBlock.append(article.previewElem);

        //inject nav link into HTML
        article.navBarElem = $(
            "<div id='nav-item-" + articleID + "' class='nav-item' style='order: " + order + ";'>" +
            article.navLabel +
            "</div>");
        navBar.append(article.navBarElem);

        count++;
    }

    //inject top to topmost article
    $("#article-preview-" + topMostArticleID).addClass('top');
    $("#nav-item-" + topMostArticleID).addClass('top');

    return count;
}

var hideLock;

function scrollCalc() {
    //calculate scroll location
    var s = $(window).scrollTop(),
        pgHeight = $(window).height(),
        h = $(document).height() - pgHeight;

    //background image parallax
    $('.background.parallax').css('transform', 'translate(0, ' + s.map(0, h, 0, -10) + '%)');

    // Intro -> Content transitions, nav bar parallax, down arrow fade
    if (s > 10) {
        $('#nav-bar').css('top', s.map(0, h, 35, 0) + '%');
        $('.sidebar').addClass('closed');
        $('#nav-bar-wrapper').addClass('closed');

        $('.down-arrow').addClass('hide');
    } else {
        $('#nav-bar').css('top', s.map(0, h, 40, 35) + '%');
        $('.sidebar').removeClass('closed');
        $('#nav-bar-wrapper').removeClass('closed');
        if (!hideLock)
            $('.down-arrow').removeClass('hide');
    }

    // Selected animations
    var errAllow = 50;
    var viewStart = s - errAllow,
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

function resizeCalc() {
    if ($(document).height() > $(window).height()) {
        $('.down-arrow').removeClass('hide');
        hideLock = false;
        console.log("lol");
    }
    else {
        $('.down-arrow').addClass('hide');
        hideLock = true;
    }
    scrollCalc();
}

$(function () {
    //Load content:
    var schema = JSON.parse(document.getElementById('injected-schema').innerHTML);
    articles = schema.articles;
    var count = performLayout(function (article) {
        return article.defaultDisplayOrder;
    });


    var downArrow = $('.down-arrow');

    //auto scroll down
    downArrow.click(function () {
        var elem = $('.info-block.top');
        $('html, body').animate({
            scrollTop: elem.offset().top + elem.height()
        }, 1000, "easeOutQuad");
    });

    if (count <= 1)
        downArrow.addClass('hide');

    $(window).scroll(scrollCalc);
    $(window).resize(resizeCalc);

    //ensure proper init calcs
    resizeCalc();
});