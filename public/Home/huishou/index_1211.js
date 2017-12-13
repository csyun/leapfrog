jQuery(document).ready(function() { 
	$(".property-value").click(function(){
		var e = $(this),
            goods_attr_id = $(this).attr('data-id'),
			t = e.closest("dl"),
			i = t.hasClass("checkbox");
			t.height();
        	$("#attrform").append('<input id="goods_attr_id'+goods_attr_id+'" type="hidden" value="'+goods_attr_id+'" name="goods_attr_id[]" >');
			if (e.closest(".select-property").hasClass("base-property1")) return ! 1;
			
			if (i ? e.toggleClass("checked") : (e.closest("dl").hasClass("checked"), e.addClass("checked").siblings().removeClass("checked"), t.addClass("checked selected").find("dt .selected-property").attr('data-id',goods_attr_id).text(e.find(".value-text").text()), t.hide().fadeIn()), 0 == t.next().length) {
				var r = e.closest(".select-property").next();
				r.removeClass("deactive"),
				r.find("dl").eq(0).removeClass("deactive")
			} else t.next().removeClass("deactive");
	});

	$(".select-property").on("click", "dl.selected dt",function() {
		var e = $(this),
			goods_attr_id = $(this).find('span').attr('data-id'),
		t = e.closest("dl");
		t.hasClass("checkbox");
		console.log(goods_attr_id);
		$("#goods_attr_id"+goods_attr_id).remove();
		t.removeClass("selected").find("dt .selected-property").text("")
	});

});
