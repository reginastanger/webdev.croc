!function (t) {
    function a() {
        var a = t(".animate"), e = t(window).height(), n = t(window).scrollTop(), i = n + e;
        t.each(a, function () {
            var a = t(this), e = a.outerHeight(), o = a.offset().top;
            o + e >= n && o <= i && a.addClass("animated")
        })
    }

    function e() {
        t(".header-image").each(function () {
            t(document).width() < 768 ? t(this).attr("src", t(this).data("src-sm")) : t(this).attr("src", t(this).data("src-lg"))
        })
    }

    function n() {
        t(".header-bg-image").each(function () {
            t(document).width() < 768 ? t(this).css("background-image", "url(" + t(this).data("src-sm") + ")") : t(this).css("background-image", "url(" + t(this).data("src-lg") + ")")
        })
    }

    function i() {
        var a = t("#toTop"), e = t("#page-header"), n = e.offset().top + e.outerHeight();
        t(window).scrollTop() > n ? a.addClass("show") : a.removeClass("show")
    }

    t(document).ready(function () {
        t("html").removeClass("no-js").addClass("js"), a(), i(), e(), n(), t("#main-nav .menu-item-has-children > a").each(function (a, e) {
            var n = t(this).parent().attr("id") + "-toggle";
            t(this).after('<input type="checkbox" id="' + n + '">\n                <label for="' + n + '" class="menu-toggle">\n                    <span class="toggle-icon" aria-hidden="true"></span>\n                    <span class="screen-reader-text">open</span>\n                </label>')
        }), t('#main-nav .current-menu-parent > input[type="checkbox"]').attr("checked", "checked"), t('a[href$=".jpg"],a[href$=".png"]').each(function (a, e) {
            t(this).attr("data-lightbox", "image" + a);
            var n = t(this).children("img").attr("alt");
            void 0 !== n && !1 !== n && t(this).attr("data-title", n)
        }), t(".gallery").each(function (a, e) {
            t(this).find('a[href$=".jpg"],a[href$=".png"]').attr("data-lightbox", "gallery" + a)
        }), "undefined" != typeof lightbox && lightbox.option({albumLabel: "Bild %1 von %2"}), t.isFunction(t.fn.owlCarousel) && t(".owl-carousel").owlCarousel({
            items: 1,
            autoplay: !0,
            loop: !0
        }), t("body.blog .category-nav .cat-item-all").addClass("current-cat")
    }), t(window).scroll(function () {
        a(), i()
    }), t(window).resize(function () {
        a(), i(), e(), n()
    })
}(jQuery);