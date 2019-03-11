   
    var t = $(".totop");
	 t.hide();
     t.click(function() {
      $(window).scrollTop(0)
    });
    var e = !0;
    $(window).scroll(function() {
        if (e) {
            e = !1;
            var n = setTimeout(function() {
                e = !0,
                clearTimeout(n),
                window.pageYOffset > window.innerHeight ? t.show() : t.hide()
            },
            200)
        }
    });
    
