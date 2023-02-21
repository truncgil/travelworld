! function (a, b, c) {
    function d(a, b) {
        var c = String.fromCharCode;
        l.clearRect(0, 0, k.width, k.height), l.fillText(c.apply(this, a), 0, 0);
        var d = k.toDataURL();
        l.clearRect(0, 0, k.width, k.height), l.fillText(c.apply(this, b), 0, 0);
        var e = k.toDataURL();
        return d === e
    }

    function e(a) {
        var b;
        if (!l || !l.fillText) return !1;
        switch (l.textBaseline = "top", l.font = "600 32px Arial", a) {
            case "flag":
                return !(b = d([55356, 56826, 55356, 56819], [55356, 56826, 8203, 55356, 56819])) && (b = d([55356,
                    57332, 56128, 56423, 56128, 56418, 56128, 56421, 56128, 56430, 56128, 56423, 56128,
                    56447
                ], [55356, 57332, 8203, 56128, 56423, 8203, 56128, 56418, 8203, 56128, 56421, 8203, 56128,
                    56430, 8203, 56128, 56423, 8203, 56128, 56447
                ]), !b);
            case "emoji":
                return b = d([55357, 56424, 55356, 57342, 8205, 55358, 56605, 8205, 55357, 56424, 55356, 57340], [
                    55357, 56424, 55356, 57342, 8203, 55358, 56605, 8203, 55357, 56424, 55356, 57340
                ]), !b
        }
        return !1
    }

    function f(a) {
        var c = b.createElement("script");
        c.src = a, c.defer = c.type = "text/javascript", b.getElementsByTagName("head")[0].appendChild(c)
    }
    var g, h, i, j, k = b.createElement("canvas"),
        l = k.getContext && k.getContext("2d");
    for (j = Array("flag", "emoji"), c.supports = {
            everything: !0,
            everythingExceptFlag: !0
        }, i = 0; i < j.length; i++) c.supports[j[i]] = e(j[i]), c.supports.everything = c.supports.everything && c
        .supports[j[i]], "flag" !== j[i] && (c.supports.everythingExceptFlag = c.supports.everythingExceptFlag && c
            .supports[j[i]]);
    c.supports.everythingExceptFlag = c.supports.everythingExceptFlag && !c.supports.flag, c.DOMReady = !1, c
        .readyCallback = function () {
            c.DOMReady = !0
        }, c.supports.everything || (h = function () {
            c.readyCallback()
        }, b.addEventListener ? (b.addEventListener("DOMContentLoaded", h, !1), a.addEventListener("load", h, !
            1)) : (a.attachEvent("onload", h), b.attachEvent("onreadystatechange", function () {
            "complete" === b.readyState && c.readyCallback()
        })), g = c.source || {}, g.concatemoji ? f(g.concatemoji) : g.wpemoji && g.twemoji && (f(g.twemoji), f(g
            .wpemoji)))
}(window, document, window._wpemojiSettings);

function setREVStartSize(e) {
    try {
        e.c = jQuery(e.c);
        var i = jQuery(window).width(),
            t = 9999,
            r = 0,
            n = 0,
            l = 0,
            f = 0,
            s = 0,
            h = 0;
        if (e.responsiveLevels && (jQuery.each(e.responsiveLevels, function (e, f) {
                f > i && (t = r = f, l = e), i > f && f > r && (r = f, n = e)
            }), t > r && (l = n)), f = e.gridheight[l] || e.gridheight[0] || e.gridheight, s = e.gridwidth[l] || e
            .gridwidth[0] || e.gridwidth, h = i / s, h = h > 1 ? 1 : h, f = Math.round(h * f), "fullscreen" == e
            .sliderLayout) {
            var u = (e.c.width(), jQuery(window).height());
            if (void 0 != e.fullScreenOffsetContainer) {
                var c = e.fullScreenOffsetContainer.split(",");
                if (c) jQuery.each(c, function (e, i) {
                        u = jQuery(i).length > 0 ? u - jQuery(i).outerHeight(!0) : u
                    }), e.fullScreenOffset.split("%").length > 1 && void 0 != e.fullScreenOffset && e.fullScreenOffset
                    .length > 0 ? u -= jQuery(window).height() * parseInt(e.fullScreenOffset, 0) / 100 : void 0 != e
                    .fullScreenOffset && e.fullScreenOffset.length > 0 && (u -= parseInt(e.fullScreenOffset, 0))
            }
            f = u
        } else void 0 != e.minHeight && f < e.minHeight && (f = e.minHeight);
        e.c.closest(".rev_slider_wrapper").css({
            height: f
        })
    } catch (d) {
        console.log("Failure at Presize of Slider:" + d)
    }
};

/*
var c = document.body.className;
c = c.replace(/woocommerce-no-assets/js / , 'woocommerce-js');
document.body.className = c;
*/
function revslider_showDoubleJqueryError(sliderID) {
    var errorMessage =
        "Revolution Slider Error: You have some jquery.js library include that comes after the revolution files js include.";
    errorMessage += "<br> This includes make eliminates the revolution slider libraries, and make it not work.";
    errorMessage +=
        "<br><br> To fix it you can:<br>&nbsp;&nbsp;&nbsp; 1. In the Slider Settings -> Troubleshooting set option:  <strong><b>Put JS Includes To Body</b></strong> option to true.";
    errorMessage += "<br>&nbsp;&nbsp;&nbsp; 2. Find the double jquery.js include and remove it.";
    errorMessage = "<span style='font-size:16px;color:#BC0C06;'>" + errorMessage + "</span>";
    jQuery(sliderID).show().html(errorMessage);
}
/* <![CDATA[ */
var wc_add_to_cart_params = {
    "ajax_url": "\/altair\/demo\/wp-admin\/admin-ajax.php",
    "wc_ajax_url": "\/altair\/demo\/?wc-ajax=%%endpoint%%",
    "i18n_view_cart": "View cart",
    "cart_url": "https:\/\/themes.themegoods.com\/altair\/demo\/cart\/",
    "is_cart": "",
    "cart_redirect_after_add": "no"
};
/* ]]> */
/* <![CDATA[ */
var woocommerce_params = {
    "ajax_url": "\/altair\/demo\/wp-admin\/admin-ajax.php",
    "wc_ajax_url": "\/altair\/demo\/?wc-ajax=%%endpoint%%"
};
/* ]]> */
/* <![CDATA[ */
var wc_cart_fragments_params = {
    "ajax_url": "\/altair\/demo\/wp-admin\/admin-ajax.php",
    "wc_ajax_url": "\/altair\/demo\/?wc-ajax=%%endpoint%%",
    "cart_hash_key": "wc_cart_hash_8678fb482340f5d5de0bbc72d715fa39",
    "fragment_name": "wc_fragments_8678fb482340f5d5de0bbc72d715fa39",
    "request_timeout": "5000"
};
/* ]]> */