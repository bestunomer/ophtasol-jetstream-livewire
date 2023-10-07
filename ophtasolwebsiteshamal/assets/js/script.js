function ChangeMenuState() {
    $(".menu-mover").toggleClass("active");
    $(".collapse-menu,.collapse-menu-first").toggleClass("shome-menu");
}



$(function () {

    var _Path = window.location.href;
    var _firstindex = _Path.indexOf("/", 8);
    if (_firstindex != -1) {
        var res = _Path.substring(_firstindex + 1, _firstindex + 3);
        if (res == "so") {
            $("a[href='/so/']").attr("href", '/so/');
        }
        else if (res == "en") {
            $("a[href='/so/']").attr("href", '/en/');
        }
        else if (res == "ar") {
            $("a[href='/so/']").attr("href", '/ar/');
        }
        else if (res == "ku") {
            $("a[href='/so/']").attr("href", '/ku/');
        }
        else if (res == "tr") {
            $("a[href='/so/']").attr("href", '/tr/');
        }
        else if (res == "fa") {
            $("a[href='/so/']").attr("href", '/fa/');
        }
    }
    else {
        $("a[href='/so/']").attr("href", '/so/');
    }
    $(".carousel").swipe({

        swipe: function (event, direction, distance, duration, fingerCount, fingerData) {
            if (direction == 'left') $(this).carousel('next');
            if (direction == 'right') $(this).carousel('prev');
        },
        allowPageScroll: "vertical"

    });
    if ($("#ImageNews").children().length == 0 && $("#ImageNews1").children().length == 0 && $("#ImageNews2").children().length == 0) {
        $("#ImageNews").parent().remove();
    }
    $(".related_article").each(function () {
        if ($(this).children().length == 0) {
            $(this).parent().children(".header").remove();
        }
    });
    setDefaultFontSize();
    $('[data-toggle="popover"]').popover();
    $('[data-toggle="popover"]').click(function () {
        $('.popover-title').html('<i class="material-icons">close</i>');
        $('.popover-content').html('<div class="share-link" data-val="Email" onclick="mailto2();">Email</div><div class="share-link" data-val="facebook" onclick="facebookShare()">Facebook</div><div class="share-link" data-val="Twitter" onclick="twitterShare();">Twitter</div><div class="share-link" data-val="Google" onclick="googleShare();">Google+</div><div class="share-link" data-val="Print" onclick="PrintArea(\'PrintArea\')">Print</div>');
        $('.popover-title').click(function () {
            $('[data-toggle="popover"]').click();
        })
    });
    $(".menu-mover").click(function (e) {
        if ($(".menu-mover").hasClass("active")) {
            ChangeMenuState();
            e.stopPropagation();
        }
    });
    $(".menu-mover a").click(function (e) {
        if ($(".menu-mover").hasClass("active")) {
            e.preventDefault();
        }
    });

    $("#btnprogram-tv").click(function () {

        $(".mainmenu li .submenu").each(function () {
            $(this).removeClass("open");
        });
        $(".mainmenu li .glyphicon").removeClass("glyphicon-chevron-up");
        $(".mainmenu li .glyphicon").removeClass("glyphicon-chevron-down");
        $(".mainmenu li .glyphicon").addClass("glyphicon-chevron-down");
        $(".mainmenu li").removeClass("hover");
        var sum = 0;
        $(".mainmenu>li").each(function (index, object) {
            if ($(object).attr("data-index") != 6) {
                sum += $(object).height();
            }
        });


        if ($("#btnprogram-tv").attr("aria-expanded") == 'false') {
            $('.collapse-menu').animate({
                scrollTop: sum
            }, 500);
            $("#btnprogram-tv .glyphicon").removeClass("glyphicon-chevron-down");
            $("#btnprogram-tv .glyphicon").addClass("glyphicon-chevron-up");
        }
        else {
            $('.collapse-menu').animate({
                scrollTop: 0
            }, 500);
            $("#btnprogram-tv .glyphicon").removeClass("glyphicon-chevron-up");
            $("#btnprogram-tv .glyphicon").addClass("glyphicon-chevron-down");
        }

    });
    $(".mainmenu li").click(function (e) {
        if ($(e.target).children(".submenu").hasClass("submenu")) {
            if ($(window).width() < 1200) {
                if ($(this).has(".submenu").length) {
                    if ($(this).children(".submenu").hasClass("open")) {
                        $(this).children(".submenu").removeClass("open");
                        $(this).removeClass("hover");
                        $(this).children(".glyphicon").removeClass("glyphicon-chevron-up");
                        $(this).children(".glyphicon").addClass("glyphicon-chevron-down");
                    }
                    else {
                        $(".mainmenu li .submenu").each(function () {
                            $(this).removeClass("open");
                        });
                        $(".mainmenu li .glyphicon").removeClass("glyphicon-chevron-up");
                        $(".mainmenu li .glyphicon").removeClass("glyphicon-chevron-down");
                        $(".mainmenu li .glyphicon").addClass("glyphicon-chevron-down");
                        $(".mainmenu li").removeClass("hover");
                        $(this).children(".submenu").addClass("open");
                        $(this).children(".glyphicon").removeClass("glyphicon-chevron-down");
                        $(this).children(".glyphicon").addClass("glyphicon-chevron-up");
                        $(this).addClass("hover");
                        var Item = $(this);
                        $('.collapse-menu').animate({
                            scrollTop: parseInt($(Item).attr("data-index")) * 40
                        }, 500);
                    }

                }
            }
        }
    });
    Galery_init();
    $('.collapse-menu').css("top", "167px");
    $('.collapse-menu-first').css("top", "67px");
    $(window).resize(function () {
        var xscroll = $(this).scrollTop();
        if (xscroll >= 46) {
            $(".top-menu").addClass("fixed-menu");
            if ($(window).width() >= 1200)
                $(".top-header").css("margin-top", "72px");
            else
                $(".top-header").css("margin-top", "0px");
        }
        else {
            if ($(window).width() >= 1200)
                $(".top-header").css("margin-top", "0");
            $(".top-menu").removeClass("fixed-menu");
        }
    });
    $(window).scroll(function () {
        var xscroll = $(this).scrollTop();
        if (xscroll >= 46) {
            $(".top-menu").addClass("fixed-menu");
            if ($(window).width() >= 1200)
                $(".top-header").css("margin-top", "72px");
            else
                $(".top-header").css("margin-top", "0px");
        }
        else {
            if ($(window).width() >= 1200)
                $(".top-header").css("margin-top", "0");
            $(".top-menu").removeClass("fixed-menu");
        }
    });

    // Create Tabs ******************************************
    $(".most-visited").each(function () {
        var ulNav = $(this).find(".nav");
        var divContent = $(this).find(".tab-content");
        $(this).parent().find(".li_header").each(function () {
            var _CId = $(this).find(".tab-pane").attr("id");
            $(divContent).find(".tab-pane").length
            $(this).find(".tab-pane").detach().appendTo(divContent);
            var _Title = ($(this).text().trim());
            $(ulNav).append('<li ><a data-toggle="tab" href="#' + _CId + '" aria-expanded="true">' + _Title + '</a></li>');
            $(this).remove();
        });
    });
    $(".nav-tabs li:first-child a").click();
	$.get("https://weather.awrosoft.krd/api/Default", function (data) {
        try {
            var currentWeather = jQuery.parseJSON(data).current_observation;
            $(".weather-temp").html(currentWeather.condition.temperature + " &deg;C");
            switch (currentWeather.condition.code) {
                case  3200:
                    $(".weather-icon").html('<span class="wi_version2 wi-na"></span>');
                    break;
                case 0:
                    $(".weather-icon").html('<span class="wi_version2 wi-tornado"></span>');
                    break;
                case 1:
                    $(".weather-icon").html('<span class="wi_version2 wi-sandstorm"></span>');
                    break;
                case 2:
                    $(".weather-icon").html('<span class="wi_version2 wi-strong-wind"></span>');
                    break;
                case 3:
                    $(".weather-icon").html('<span class="wi_version2 wi-lightning"></span>');
                    break;
                case 4:
                case 36:
                case 37:
                case 38:
                case 39:
                case 40:
                case 42:
                case 45:
                case 47:
                    $(".weather-icon").html('<span class="wi_version2 wi-day-lightning"></span>');
                    break;
                case 5:
                case 6:
                case 35:
                    $(".weather-icon").html('<span class="wi_version2 wi-day-rain-mix"></span>');
                    break;
                case 7:
                case 13:
                case 14:
                case 15:
                    $(".weather-icon").html('<span class="wi_version2 wi-day-snow"></span>');
                    break;
                case 8:
                case 16:
                case 41:
                case 43:
                case 46:
                    $(".weather-icon").html('<span class="wi_version2 wi-snow"></span>');
                    break;
                case 9:
                case 10:
                    $(".weather-icon").html('<span class="wi_version2 wi-day-showers"></span>');
                    break;
                case 11:
                case 12:
                    $(".weather-icon").html('<span class="wi_version2 wi-day-rain"></span>');
                    break;
                case 17:
                    $(".weather-icon").html('<span class="wi_version2 wi-day-hail"></span>');
                    break;
                case 18:
                    $(".weather-icon").html('<span class="wi_version2 wi-sleet"></span>');
                    break;
                case 19:
                    $(".weather-icon").html('<span class="wi_version2 wi-smoke"></span>');
                    break;
                case 20:
                case 21:
                case 22:
                    $(".weather-icon").html('<span class="wi_version2 wi-day-fog"></span>');
                    break;
                case 23:
                case 24:
                    $(".weather-icon").html('<span class="wi_version2 wi-day-windy"></span>');
                    break;
                case 25:
                    $(".weather-icon").html('<span class="wi_version2 wi-day-light-wind"></span>');
                    break;
                case 26:
                case 28:
                case 44:
                    $(".weather-icon").html('<span class="wi_version2 wi-day-cloudy"></span>');
                    break;
                case 27:
                    $(".weather-icon").html('<span class="wi_version2 wi-night-cloudy"></span>');
                    break;
                case 29:
                case 30:
                    $(".weather-icon").html('<span class="wi_version2 wi-cloudy"></span>');
                    break;
                case 31:
                    $(".weather-icon").html('<span class="wi_version2 wi-lunar-eclipse"></span>');
                    break;
                case 32:
                case 33:
                case 34:
                    $(".weather-icon").html('<span class="wi_version2 wi-day-sunny"></span>');
                    break;
                default:
                    $(".weather-icon").html('<span class="wi_version2 wi-na"></span>');
            }
        }
        catch (err) {
            console.log(err);
            $(".weather-temp").children("a").html("-");
        }
    });
});


// Program Slider ******************************************
function Next_Slide() {
    var _cur = parseInt($(".active-slide").attr("data-item"));
    var _count = $(".slider-parent").children(".item").length - 1;
    if (_cur < (_count - 1)) {
        $(".prev-slide").addClass("hide-slide").removeClass("prev-slide");
        $(".active-slide").addClass("prev-slide").removeClass("active-slide");
        $(".next-slide").addClass("active-slide").removeClass("next-slide");
        $("[data-item='" + (_cur + 2) + "']").addClass("next-slide").removeClass("hide-slide");
    }
    else if (_cur == (_count - 1)) {
        $(".prev-slide").addClass("hide-slide").removeClass("prev-slide");
        $(".active-slide").addClass("prev-slide").removeClass("active-slide");
        $(".next-slide").addClass("active-slide").removeClass("next-slide");
        $("[data-item='0']").addClass("next-slide").removeClass("hide-slide");
    }
    else if (_cur == _count) {
        $(".prev-slide").addClass("hide-slide").removeClass("prev-slide");
        $(".active-slide").addClass("prev-slide").removeClass("active-slide");
        $(".next-slide").addClass("active-slide").removeClass("next-slide");
        $("[data-item='1']").addClass("next-slide").removeClass("hide-slide");
    }

}
function Prev_Slide() {
    var _cur = parseInt($(".active-slide").attr("data-item"));
    var _count = $(".slider-parent").children(".item").length - 1;
    if (_cur > 1) {
        $(".next-slide").addClass("hide-slide").removeClass("next-slide");
        $(".active-slide").addClass("next-slide").removeClass("active-slide");
        $(".prev-slide").addClass("active-slide").removeClass("prev-slide");
        $("[data-item='" + (_cur - 2) + "']").addClass("prev-slide").removeClass("hide-slide");
    }
    else if (_cur == 1) {
        $(".next-slide").addClass("hide-slide").removeClass("next-slide");
        $(".active-slide").addClass("next-slide").removeClass("active-slide");
        $(".prev-slide").addClass("active-slide").removeClass("prev-slide");
        $("[data-item='" + _count + "']").addClass("prev-slide").removeClass("hide-slide");
    }
    else if (_cur == 0) {
        $(".next-slide").addClass("hide-slide").removeClass("next-slide");
        $(".active-slide").addClass("next-slide").removeClass("active-slide");
        $(".prev-slide").addClass("active-slide").removeClass("prev-slide");
        $("[data-item='" + (_count - 1) + "']").addClass("prev-slide").removeClass("hide-slide");
    }

}

function Find_HeaderLink(el) {
    window.location=$(el).parent().parent().parent().parent().find(".header a").attr("href");
}


//***********************************************************************************************************************
// Codes from last website



function PrintArea(n) {
    $('[data-toggle="popover"]').click();
    var t, r, u, i;
    if (document.getElementById != null) {
        if (t = "<HTML>\n<HEAD>\n", document.getElementsByTagName != null && (r = document.getElementsByTagName("head"), r.length > 0 && (t += r[0].innerHTML)), t += "\n<\/HEAD>\n<BODY>\n", u = document.getElementById(n), u != null) t += "<div style='margin: 10px; overflow-y: auto; overflow-x: hidden;line-height: 1.6em;padding: 13px;'>" + u.innerHTML + "<\/div>";
        else {
            alert("Error, no contents.");
            return
        }
        t += "\n<script>window.requestAnimationFrame(function() {window.requestAnimationFrame(function() {var timestamp = Date.now() + 1000; while (Date.now() < timestamp){};window.print();});});<\/script><\/BODY>\n<\/HTML>";
        i = window.open("", "", "left=0,top=0,width=800,height=900,toolbar=0,scrollbars=1,status=0");
        i.document.open();
        i.document.write(t);
        i.document.close();
        //i.print()
    } else alert("Browser not supported.")
}



function setDefaultFontSize() {
    $(".zoom").css("font-size", "14px");
    $(".zoom div").each(function () {
        var n = $(this).attr("class");
        n != undefined && n.toLowerCase().indexOf("vjs") < 0 && n.toLowerCase().indexOf("amp") < 0 && ($(this).css("font-size", ""))
    });
    $(".zoom p").each(function () {
        var n = $(this).attr("class");
        n != undefined && n.toLowerCase().indexOf("vjs") < 0 && n.toLowerCase().indexOf("amp") < 0 && ($(this).css("font-size", ""))
    });
    $(".zoom span").each(function () {
        var n = $(this).attr("class");
        n != undefined && n.toLowerCase().indexOf("vjs") < 0 && n.toLowerCase().indexOf("amp") < 0 && ($(this).css("font-size", ""))
    })
}

function zoomin() {
    fontSize = parseInt($(".zoom").css("font-size").replace("px", ""));
    fontSize -= 1;
    fontSize > 12 && ($(".zoom").css("font-size", fontSize + "px"), $(".zoom p").each(function () {
        var n = $(this).attr("class");
        (n == undefined || n.toLowerCase().indexOf("vjs") <= 0) && $(this).css("font-size") != undefined && (fontSize = parseInt($(this).css("font-size").replace("px", "")), $(this).data("Default-font-size") == undefined && $(this).data("Default-font-size", fontSize), fontSize--, $(this).css("font-size", fontSize + "px"))
    }), $(".zoom span").each(function () {
        var n = $(this).attr("class");
        (n == undefined || n.toLowerCase().indexOf("vjs") <= 0) && $(this).css("font-size") != undefined && (fontSize = parseInt($(this).css("font-size").replace("px", "")), $(this).data("Default-font-size") == undefined && $(this).data("Default-font-size", fontSize), fontSize--, $(this).css("font-size", fontSize + "px"))
    }), $(".zoom div").each(function () {
        var n = $(this).attr("class");
        (n == undefined || n != undefined && n.toLowerCase().indexOf("vjs") < 0) && $(this).css("font-size") != undefined && (fontSize = parseInt($(this).css("font-size").replace("px", "")), $(this).data("Default-font-size") == undefined && $(this).data("Default-font-size", fontSize), fontSize--, $(this).css("font-size", fontSize + "px"))
    }))
}

function removezoom() {
    $(".zoom").css("font-size", "14px");
    $(".zoom p").each(function () {
        var n = $(this).attr("class");
        (n == undefined || n.toLowerCase().indexOf("vjs") <= 0) && $(this).data("Default-font-size") != undefined && (fontSize = parseInt($(this).data("Default-font-size")), $(this).css("font-size", fontSize + "px"))
    });
    $(".zoom span").each(function () {
        var n = $(this).attr("class");
        (n == undefined || n.toLowerCase().indexOf("vjs") <= 0) && $(this).data("Default-font-size") != undefined && (fontSize = parseInt($(this).data("Default-font-size")), $(this).css("font-size", fontSize + "px"))
    });
    $(".zoom div").each(function () {
        var n = $(this).attr("class");
        (n == undefined || n.toLowerCase().indexOf("vjs") <= 0) && $(this).data("Default-font-size") != undefined && (fontSize = parseInt($(this).data("Default-font-size")), $(this).css("font-size", fontSize + "px"))
    })
}

function zoomout() {
    fontSize = parseInt($(".zoom").css("font-size").replace("px", ""));
    fontSize += 3;
    fontSize < 22 && ($(".zoom").css("font-size", fontSize + "px"), $(".Body-article-text p").each(function () {
        var n = $(this).attr("class");
        (n == undefined || n.toLowerCase().indexOf("vjs") <= 0) && $(this).css("font-size") != undefined && (fontSize = parseInt($(this).css("font-size").replace("px", "")), $(this).data("Default-font-size") == undefined && $(this).data("Default-font-size", fontSize), fontSize++, $(this).css("font-size", fontSize + "px"))
    }), $(".zoom span").each(function () {
        var n = $(this).attr("class");
        (n == undefined || n.toLowerCase().indexOf("vjs") <= 0) && $(this).css("font-size") != undefined && (fontSize = parseInt($(this).css("font-size").replace("px", "")), $(this).data("Default-font-size") == undefined && $(this).data("Default-font-size", fontSize), fontSize++, $(this).css("font-size", fontSize + "px"))
    }), $(".zoom div").each(function () {
        var n = $(this).attr("class");
        (n == undefined || n != undefined && n.toLowerCase().indexOf("vjs") < 0) && $(this).css("font-size") != undefined && (fontSize = parseInt($(this).css("font-size").replace("px", "")), $(this).data("Default-font-size") == undefined && $(this).data("Default-font-size", fontSize), fontSize++, $(this).css("font-size", fontSize + "px"))
    }))
}

function facebookShare() {
    var hrf = window.location.href;
    if (hrf.endsWith("/preview")) {
        hrf = hrf.replace("/preview", "");
    }
    window.open("http://www.facebook.com/sharer.php?u=" + hrf, "_blank")
}

function facebookShareSider(n) {
    window.open("http://www.facebook.com/sharer.php?u=" + GetFullDomainName() + n, "_blank")
}

function twitterShare() {
    var n = $(".news-reader h1").text();
    var t = "";
    $("tag-list>a").each(function () {
        t += $(this).text();
    });

    var hrf = window.location.href;
    if (hrf.endsWith("/preview")) {
        hrf = hrf.replace("/preview", "");
    }

    window.open("http://twitter.com/share?url=" + hrf + "&text=" + n + "&hashtags=" + t, "_blank")
}


function twitterShareSider(n, t, i) {
    window.open("http://twitter.com/share?url=" + GetFullDomainName() + n + "&text=" + t + "&hashtags=" + i, "_blank")
}

function googleShare() {
    var hrf = window.location.href;
    if (hrf.endsWith("/preview")) {
        hrf = hrf.replace("/preview", "");
    }

    window.open("https://plus.google.com/share?url=" + hrf, "_blank")
}

function googleShareSider(n) {
    window.open("https://plus.google.com/share?url=" + GetFullDomainName() + n, "_blank")
}

function pinterestShare() {
    window.open("javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());", "_blank")
}

function mailto(n, t) {
    window.open("mailto:?Subject=" + t + "&Body=" + n + "%0D%0A" + window.location.href)
}

function mailto2() {
    var hrf = window.location.href;
    if (hrf.endsWith("/preview")) {
        hrf = hrf.replace("/preview", "");
    }

    var i = $(".news-reader h1").text();
    var t = "";

    window.open("mailto:?Subject=" + i + "&Body=" + t + "%0D%0A" + hrf)
}

function mailto(n, t, i) {
    window.open("mailto:?Subject=" + i + "&Body=" + t + "%0D%0A" + GetFullDomainName() + n)
}



function GetFullDomainName() {
    var t = window.location.href,
        n = t.split("/"),
        i = n[2].split(":"),
        r = i[0];
    return n[0] + "//" + r
}

function GetDomainName() {
    var n = window.location.href,
        t = n.split("/"),
        i = t[2].split(":");
    return i[0]
}

function GetPortNumber() {
    var n = window.location.href,
        t = n.split("/"),
        i = t[2].split(":");
    return i[1]
}

function Galery_init() {
    try {
        $(".ArticleReaderGalery").lightGallery({
            showThumbByDefault: !0,
            addClass: "showThumbByDefault"
        })
    } catch (n) { }
}

function pagingForRelatedByCategory() {
    $(".related-By-Category .page-item").hide();
    $(".related-By-Category .page-item-1").show();
    $(".related-By-Category-paging li").click(function () {
        $(".related-By-Category .page-item").hide();
        var n = $(".related-By-Category-paging li.active").find("a").attr("id");
        $(".related-By-Category .page-item-" + n).show()
    });
    $("ul.pagination li.item").hide();
    $("ul.pagination .page1").show();
    $(".btnPrevPaging").hide();
    var n = $("ul.pagination .item").attr("pageid"),
        t = parseInt(parseInt($("ul.pagination .item").attr("pagecount")) / 5),
        i = parseInt($("ul.pagination .item").attr("pagecount")) % 5;
    parseInt(i) > 0 && t++;
    $(".btnPrevPaging").click(function () {
        $("ul.pagination li.item").hide();
        n = parseInt(n) - 1;
        $("ul.pagination .page" + n).show();
        n == "1" ? $(".btnPrevPaging").hide() : $(".btnPrevPaging").show();
        n == t ? $(".btnNextPaging").hide() : $(".btnNextPaging").show()
    });
    $(".btnNextPaging").click(function () {
        $("ul.pagination li.item").hide();
        n = parseInt(n) + 1;
        $("ul.pagination .page" + n).show();
        n == "1" ? $(".btnPrevPaging").hide() : $(".btnPrevPaging").show();
        n == t ? $(".btnNextPaging").hide() : $(".btnNextPaging").show()
    })
}

function votePoll(n) {
    var t = $("#__AjaxAntiForgeryForm_" + n),
        i = $('input[name="__RequestVerificationToken"]', t).val(),
        r = "input:radio[name='Poll_" + n + "']:checked",
        u = $(r).val();
    return $.ajax({
        url: "/Page/InsertPollChoice",
        type: "POST",
        data: {
            __RequestVerificationToken: i,
            poll: u
        },
        beforeSend: function () {
            waiting("formInsertPollChoice_" + n)
        },
        success: function (t) {
            if (console.log(t), t.model != undefined) {
                if (t.model.indexOf("error") != -1) return
            } else $("#formInsertPollChoice_" + n).html(t)
        },
        complete: function () {
            waitingDone("formInsertPollChoice_" + n)
        }
    }), !1
}

function votePoll2(n) {
    var t = $("#__AjaxAntiForgeryForm_" + n),
        i = $('input[name="__RequestVerificationToken"]', t).val(),
        r = "input:radio[name='Poll_" + n + "']:checked",
        u = $(r).val(),
        f = $("#hdnUniqId_" + n).val(),
        e = $("#captcha" + n).val();
    return $.ajax({
        url: "/Page/InsertPollChoice",
        type: "POST",
        data: {
            __RequestVerificationToken: i,
            poll: u,
            hdnUniqId: f,
            captcha: e
        },
        beforeSend: function () {
            waiting("formInsertPollChoice_" + n)
        },
        success: function (t) {
            if (t.model == "error") {
                ShowToastr(t.msg, "", "info", "toast-bottom-left");
                return
            }
            $("#formInsertPollChoice_" + n).empty();
            $("#formInsertPollChoice_" + n).append(t.msg)
        },
        complete: function () {
            waitingDone("formInsertPollChoice_" + n)
        }
    }), !1
}

function sendComment() {
    var n = $("#formRegisterComment"),
        t = $('input[name="__RequestVerificationToken"]', n).val(),
        i = $("#id").val(),
        r = $("#message").val();
    return $.ajax({
        url: "/Page/RegisterComment",
        type: "POST",
        data: {
            __RequestVerificationToken: t,
            id: i,
            message: r
        },
        beforeSend: function () {
            waiting("loadingForm")
        },
        success: function (n) {
            RegisterComment(n)
        },
        complete: function () {
            waitingDone("loadingForm")
        }
    }), !1
}

function SelectedPoll(n) {
    $("#listResultPollChoice").empty();
    $("#listResultPollChoice").append(n)
}

function selectPollOfArchive() {
    $("#listPoll button").click(function () {
        $(".hdnSelectedPollId").val($(this).attr("id"))
    })
}

function RegisterComment(n) {
    if (n.isSuccess) {
        var t = '<strong class="pull-left primary-font">' + n.username + '<\/strong><small class="pull-right text-muted"><span class="glyphicon glyphicon-time"><\/span>Just now<\/small><br><li class="ui-state-default">' + n.message + "<\/li><br />";
        $(".commentList").append(t);
        $("#formRegisterComment").remove();
        ShowToastr(n.message, "", "info", "toast-bottom-left")
    }
}

function RegisterPollChioce(n) {
    if (n.model == "error") {
        ShowToastr(n.msg, "", "info", "toast-bottom-left");
        return
    }
    $("#formInsertPollChoice_" + n.uniqId).empty();
    $("#formInsertPollChoice_" + n.uniqId).append(n.msg)
}

function ShowToastr(n, t, i, r) {
    toastr.options = {
        closeButton: !0,
        debug: !1,
        positionClass: r,
        onclick: null,
        showDuration: "5000",
        hideDuration: "5000",
        timeOut: "5000",
        extendedTimeOut: "5000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
    };
    i == "success" && toastr.success(t, n);
    i == "error" && toastr.error(t, n);
    i == "warning" && toastr.warning(t, n);
    i == "info" && toastr.info(t, n)
}

function ResetPassword(n) {
    if (n.isSuccess) {
        showMessage(n.errorMsg, "", "info");
        ClearForm("forget-form");
        return
    }
    showMessage(n.errorMsg, "", "error");
    ClearForm("forget-form");
    return
}

function RegisterResult(n) {
    if (n.isSuccess) return window.location = "../../AcAwpnl01/ResultRegister";
    showMessage(n.errorMsg, "", "error");
    return
}

function showMessage(n, t, i) {
    toastr.options = {
        closeButton: !0,
        debug: !1,
        progressBar: !0,
        positionClass: "toast-bottom-full-width",
        onclick: null,
        showDuration: "300",
        hideDuration: "5000",
        timeOut: "5000",
        extendedTimeOut: "5000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
    };
    i == "success" && toastr.success(t, n);
    i == "error" && toastr.error(t, n);
    i == "warning" && toastr.warning(t, n);
    i == "info" && toastr.info(t, n)
}

function readURL(n) {
    if (n.files && n.files[0]) {
        var t = new FileReader;
        t.onload = function (n) {
            $(".avatar").attr("src", n.target.result);
            $("#txtBase64").val(n.target.result)
        };
        t.readAsDataURL(n.files[0])
    }
}


function previewPageImageFix() {
    var n = window.location.href.toLowerCase();
    strEndsWith(n, "/preview") && $(".imageHolder").attr("style", "display: block !important")
}

function strEndsWith(n, t) {
    return n.match(t + "$") == t
}

function reCaptcha() { }

function refreshCaptcha(n) {
    var t = new Date;
    $.ajax({
        url: "/Page/RefreshCaptchaImage",
        type: "GET",
        data: {
            prefix: n,
            dt: t.getTime()
        },
        success: function (t) {
            $("#imgcpatcha_" + n).attr("src", "data:image/png;base64," + t.captcha)
        }
    })
}


function waiting(n) {
    $("#" + n).waiting()
}

function waitingDone(n) {
    $("#" + n).waiting("done")
}

function waitingPanel() {
    (function (n) {
        "use strict";

        function i(i, u) {
            this.element = i;
            this.$el = n(i);
            this.options = n.extend({}, r, u);
            this._defaults = r;
            this._name = t;
            this._addPositionRelative = !1;
            this.init()
        }
        var t = "waiting",
            r = {
                waitingClass: t,
                position: "center",
                overlay: !0,
                fixed: !1
            };
        i.prototype = {
            init: function () {
                this.$container = n('<div class="waiting-container hidden" />');
                this.$indicator = n('<div class="waiting-indicator" />').appendTo(this.$container);
                this.options.overlay && (this.$container.addClass("overlay"), this.$overlay = n('<div class="waiting-overlay" />').appendTo(this.$container));
                this.options.overlay && "custom" !== this.options.position && this.$indicator.addClass(this.options.position);
                this.options.fixed && this.$container.addClass("fixed");
                "" === this.element.style.position && (this._addPositionRelative = !0);
                this.show()
            },
            show: function () {
                this._addPositionRelative && (this.element.style.position = "relative");
                this.$el.addClass(this.options.waitingClass);
                this.$container.appendTo(this.$el).removeClass("hidden")
            },
            hide: function () {
                this.$container.addClass("hidden");
                this.$container.detach();
                this.$el.removeClass(this.options.waitingClass);
                this._addPositionRelative && (this.element.style.position = "")
            },
            again: function () {
                this.show()
            },
            done: function () {
                this.hide()
            }
        };
        n.fn[t] = function (r) {
            return this.each(function () {
                var u, f, e;
                if (n.data(this, "plugin_" + t)) {
                    if (u = n.data(this, "plugin_" + t), f = "again", e = {
                        again: !0,
                        done: !0
                    }, "string" == typeof r) {
                        if (!e[r]) return !1;
                        f = r;
                        r = null
                    }
                    u[f].call(u, r)
                } else n.data(this, "plugin_" + t, new i(this, r))
            })
        }
    })(jQuery, window, document)
}


//***********************************************************************************************************************
// Libraries

//Pagination
(function (e, d, a, f) { var b = e.fn.twbsPagination; var c = function (j, h) { this.$element = e(j); this.options = e.extend({}, e.fn.twbsPagination.defaults, h); if (this.options.startPage < 1 || this.options.startPage > this.options.totalPages) { throw new Error("Start page option is incorrect") } this.options.totalPages = parseInt(this.options.totalPages); if (isNaN(this.options.totalPages)) { throw new Error("Total pages option is not correct!") } this.options.visiblePages = parseInt(this.options.visiblePages); if (isNaN(this.options.visiblePages)) { throw new Error("Visible pages option is not correct!") } if (this.options.totalPages < this.options.visiblePages) { this.options.visiblePages = this.options.totalPages } if (this.options.onPageClick instanceof Function) { this.$element.first().bind("page", this.options.onPageClick) } if (this.options.href) { var g, k = this.options.href.replace(/[-\/\\^$*+?.|[\]]/g, "\\$&"); k = k.replace(this.options.hrefVariable, "(\\d+)"); if ((g = new RegExp(k, "i").exec(d.location.href)) != null) { this.options.startPage = parseInt(g[1], 10) } } var i = (typeof this.$element.prop === "function") ? this.$element.prop("tagName") : this.$element.attr("tagName"); if (i === "UL") { this.$listContainer = this.$element } else { this.$listContainer = e("<ul></ul>") } this.$listContainer.addClass(this.options.paginationClass); if (i !== "UL") { this.$element.append(this.$listContainer) } this.render(this.getPages(this.options.startPage)); this.setupEvents(); if (this.options.initiateStartPageClick) { this.$element.trigger("page", this.options.startPage) } return this }; c.prototype = { constructor: c, destroy: function () { this.$element.empty(); this.$element.removeData("twbs-pagination"); this.$element.unbind("page"); return this }, show: function (g) { if (g < 1 || g > this.options.totalPages) { throw new Error("Page is incorrect.") } this.render(this.getPages(g)); this.setupEvents(); this.$element.trigger("page", g); return this }, buildListItems: function (g) { var j = e(); if (this.options.first) { j = j.add(this.buildItem("first", 1)) } if (this.options.prev) { var l = g.currentPage > 1 ? g.currentPage - 1 : this.options.loop ? this.options.totalPages : 1; j = j.add(this.buildItem("prev", l)) } for (var h = 0; h < g.numeric.length; h++) { j = j.add(this.buildItem("page", g.numeric[h])) } if (this.options.next) { var k = g.currentPage < this.options.totalPages ? g.currentPage + 1 : this.options.loop ? 1 : this.options.totalPages; j = j.add(this.buildItem("next", k)) } if (this.options.last) { j = j.add(this.buildItem("last", this.options.totalPages)) } return j }, buildItem: function (i, j) { var h = e("<li></li>"), k = e("<a></a>"), g = null; switch (i) { case "page": g = j; h.addClass(this.options.pageClass); break; case "first": g = this.options.first; h.addClass(this.options.firstClass); break; case "prev": g = this.options.prev; h.addClass(this.options.prevClass); break; case "next": g = this.options.next; h.addClass(this.options.nextClass); break; case "last": g = this.options.last; h.addClass(this.options.lastClass); break; default: break } h.data("page", j); h.data("page-type", i); h.append(k.attr("href", this.makeHref(j)).html(g)); return h }, getPages: function (j) { var g = []; var k = Math.floor(this.options.visiblePages / 2); var l = j - k + 1 - this.options.visiblePages % 2; var h = j + k; if (l <= 0) { l = 1; h = this.options.visiblePages } if (h > this.options.totalPages) { l = this.options.totalPages - this.options.visiblePages + 1; h = this.options.totalPages } var i = l; while (i <= h) { g.push(i); i++ } return { currentPage: j, numeric: g } }, render: function (g) { var h = this; this.$listContainer.children().remove(); this.$listContainer.append(this.buildListItems(g)); this.$listContainer.children().each(function () { var j = e(this), i = j.data("page-type"); switch (i) { case "page": if (j.data("page") === g.currentPage) { j.addClass(h.options.activeClass) } break; case "first": j.toggleClass(h.options.disabledClass, g.currentPage === 1); break; case "last": j.toggleClass(h.options.disabledClass, g.currentPage === h.options.totalPages); break; case "prev": j.toggleClass(h.options.disabledClass, !h.options.loop && g.currentPage === 1); break; case "next": j.toggleClass(h.options.disabledClass, !h.options.loop && g.currentPage === h.options.totalPages); break; default: break } }) }, setupEvents: function () { var g = this; this.$listContainer.find("li").each(function () { var h = e(this); h.off(); if (h.hasClass(g.options.disabledClass) || h.hasClass(g.options.activeClass)) { h.click(function (i) { i.preventDefault() }); return } h.click(function (i) { !g.options.href && i.preventDefault(); g.show(parseInt(h.data("page"), 10)) }) }) }, makeHref: function (g) { return this.options.href ? this.options.href.replace(this.options.hrefVariable, g) : "#" } }; e.fn.twbsPagination = function (i) { var h = Array.prototype.slice.call(arguments, 1); var k; var l = e(this); var j = l.data("twbs-pagination"); var g = typeof i === "object" && i; if (!j) { l.data("twbs-pagination", (j = new c(this, g))) } if (typeof i === "string") { k = j[i].apply(j, h) } return (k === f) ? l : k }; e.fn.twbsPagination.defaults = { totalPages: 0, startPage: 1, visiblePages: 5, initiateStartPageClick: true, href: false, hrefVariable: "{{number}}", first: "<i class='material-icons'>skip_previous</i>", prev: "<i class='material-icons'>chevron_left</i>", next: "<i class='material-icons'>chevron_right</i>", last: "<i class='material-icons'>skip_next</i>", loop: false, onPageClick: null, paginationClass: "pagination", nextClass: "next", prevClass: "prev", lastClass: "last", firstClass: "first", pageClass: "page", activeClass: "active", disabledClass: "disabled" }; e.fn.twbsPagination.Constructor = c; e.fn.twbsPagination.noConflict = function () { e.fn.twbsPagination = b; return this } })(jQuery, window, document);