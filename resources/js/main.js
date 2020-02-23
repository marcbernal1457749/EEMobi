"use strict";
jQuery(document).ready(function(i) {
    function n(n) {
        n.each(function() {
            var n = i(this),
                e = parseInt(n.children(".cd-pricing-features").width()),
                s = parseInt(n.width());
            n.scrollLeft() >= e - s - 1 ? n.parent("li").addClass("is-ended") : n.parent("li").removeClass("is-ended")
        })
    }

    function e(i) {
        i.addClass("is-selected")
    }

    function s(n, e) {
        i.each(n, function(n, s) {
            n != e ? i(this).removeClass("is-visible is-selected").addClass("is-hidden") : i(this).addClass("is-visible").removeClass("is-hidden is-selected")
        })
    }
    i("#navbar-collapse").find("a[href*=#]:not([href=#])").click(function() {
        if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
            var n = i(this.hash);
            if ((n = n.length ? n : i("[name=" + this.hash.slice(1) + "]")).length) return i("html,body").animate({
                scrollTop: n.offset().top - 40
            }, 1e3), "none" != i(".navbar-toggle").css("display") && i(this).parents(".container").find(".navbar-toggle").trigger("click"), !1
        }
    }), n(i(".cd-pricing-body")), i(window).on("resize", function() {
        window.requestAnimationFrame(function() {
            n(i(".cd-pricing-body"))
        })
    }), i(".cd-pricing-body").on("scroll", function() {
        var e = i(this);
        window.requestAnimationFrame(function() {
            n(e)
        })
    }), i(".cd-pricing-container").each(function() {
        var n = i(this),
            t = n.children(".cd-pricing-switcher").find('input[type="radio"]'),
            a = n.find(".cd-pricing-wrapper"),
            o = {};
        t.each(function() {
            var n = i(this).val();
            o[n] = a.find('li[data-type="' + n + '"]')
        }), t.on("change", function(t) {
            t.preventDefault();
            var c = i(t.target).val();
            e(o[c]), Modernizr.cssanimations ? a.addClass("is-switched").eq(0).one("webkitAnimationEnd oanimationend msAnimationEnd animationend", function() {
                s(o, c), a.removeClass("is-switched"), n.find(".cd-pricing-list").hasClass("cd-bounce-invert") && a.toggleClass("reverse-animation")
            }) : (s(o, c), a.removeClass("is-switched"))
        })
    }), i.localScroll(), i(window).scroll(function() {
        i(this).scrollTop() > 600 ? i(".scrollup").fadeIn("slow") : i(".scrollup").fadeOut("slow")
    }), i(".scrollup").click(function() {
        return i("html, body").animate({
            scrollTop: 0
        }, 1e3), !1
    })
});