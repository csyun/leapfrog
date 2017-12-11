jQuery(document).ready(function() { 
	$(".property-value").click(function(){
		var e = $(this),
			t = e.closest("dl"),
			i = t.hasClass("checkbox");
			t.height();
			if (e.closest(".select-property").hasClass("base-property1")) return ! 1;
			
			if (i ? e.toggleClass("checked") : (e.closest("dl").hasClass("checked"), e.addClass("checked").siblings().removeClass("checked"), t.addClass("checked selected").find("dt .selected-property").text(e.find(".value-text").text()), t.hide().fadeIn()), 0 == t.next().length) {
				var r = e.closest(".select-property").next();
				r.removeClass("deactive"),
				r.find("dl").eq(0).removeClass("deactive")
			} else t.next().removeClass("deactive");
	});

	$(".select-property").on("click", "dl.selected dt",function() {
		var e = $(this),
		t = e.closest("dl");
		t.hasClass("checkbox");
		t.removeClass("selected").find("dt .selected-property").text("")
	});

});
