$(function(){
	parralax = 500;
	parralaxState = false;
	if($(window.top).width()>768){
		parralaxState = true;
	}
	//load
	$(".content").animate({"opacity": "1"}, 600);
	
	//scroll
	href = $(".main-icon a").attr("href")
	customClass = $(".main-icon a").attr("data-class");
	text = $(".main-icon a").html()
	$(".navbar-brand").html(text);
	nav = '<span class="item"><a href="'+href+'" class="'+customClass+'">'+text+'</a></span>';
	$(".navigation .navbar-form .btn").each(function(index, element) {
		href = $(element).attr("href");
		customClass = $(element).attr("data-class");
		text = $(element).html();
		$(element).addClass(customClass);
		nav += '<span class="item divider">&middot;</span>';
		nav += '<span class="item"><a href="'+href+'" class="'+customClass+'">'+text+'</a></span>';
	});
	$(".fixed-navigation").append(nav);
	$(window).scroll(function() {
		if($(window).scrollTop()>50) {
			$(".fixed-navigation").css({"background-color":"#ED0058"}).stop().animate({
				"height":40,
				"padding-top":10,
				"padding-bottom":10
			});
			$(".fixed-navigation > .item.main-icon").slideUp();
			$(".fixed-navigation > .item").not('.main-icon').slideDown();
		}else{
			$(".fixed-navigation").css({"background-color":"#FF2D7A"}).stop().animate({
				"height":30,
				"padding-top":5,
				"padding-bottom":5
			});
			$(".fixed-navigation > .item.main-icon").slideDown();
			$(".fixed-navigation > .item").not('.main-icon').slideUp();
		}
		if(parralaxState){
			$("#welcome").css("background-position","-"+(($(window).scrollTop()*0.5)+parralax)+"px center ");
		}
	});
	
	//redirecting
	$("as").on("click", function(e) {
		var target = this;
		e.preventDefault();
		$(".content").animate({opacity: 0.25}, 400, function(){
			window.location = target.href;
		});
	})
	
	//submit
	$('form').submit(function(e){
		eq = 0;
		if($(this).hasClass("validate-form")){
			eq = $(this).index(".validate-form");
		};
		if($(".alert-submit").eq(eq).html()==""){
			var target = this;
			e.preventDefault();
			$(this).find("button[type=submit]").button('loading').html('<span class="glyphicon glyphicon-refresh spin"></span>');
			$('.main-icon').html('<span class="glyphicon glyphicon-refresh spin"></span> SECURHAT');
			$(".content").animate({opacity: 0.25}, 200, function(){
				target.submit();
			});
		}
	});
	
	//tooltip
	$('.btn').tooltip();
	
	//windows height
	contentHeight = $(window.top).height();
	headerHeight = $("#securhat").height();
	lineHeight = 5;
	newHeight = (contentHeight-headerHeight-lineHeight)+"px"
	$("#welcome").css({
		"height":newHeight,
		"min-height":newHeight,
		"background-size":"auto "+(($(window.top).height()))+"px"
	});
	
	//login center
	jQuery.fn.center = function () {
		this.parent().css("position","absolute").css("height",$("#welcome").css("height"));
		var t = this.parent().css("top");
		var l = this.parent().css("left");
		this.css("position","absolute");
		this.css("top", ((this.parent().height() - this.outerHeight()) / 2) + this.parent().scrollTop() + "px");
		this.css("left", ((this.parent().width() - this.outerWidth()) / 2) + this.parent().scrollLeft() + "px");
		return this;
	}
	$(".dim #login").center().fadeIn();
	
	//image square
	if($(".item-img.square").eq(0).css("width")){
		containerWidth = $(".item-img.square").eq(0).css("width");
		$(".item-img.square").css("height", containerWidth); 
	}
	   
	//image potrait
	if($(".item-img.potrait").eq(0).css("width")){
		containerWidth = ($(".item-img.potrait").eq(0).css("width")).replace("px", "");
		$(".item-img.potrait").css("height", containerWidth*2);
	}
	
	//sidebar
	html = $(".sidebar").html();
	if(html==""){
		html = $(".main-header .btn-group").html();
		html = html.replace(/<a/g, "<li><a").replace(/<\/a>/g, "<\/a></li>").replace(/btn/g, "");
		$(".sidebar").html('<ul class="nav navbar-nav">'+html+'</ul>');
	}
	$(".navbar-toggle").click(function(){
		css = $(".sidebar").css("display");
		if(css=="none"){
			$(".sidebar").css({"display":"block", "margin-left":"-250px"}).animate({"margin-left":"0"});
			$("body").css({"overflow":"hidden"});
		}else{
			closeSidebar();
		}
	})
	
	//internal link
	$(".internal-link").click(function(event){
		event.preventDefault();
		$(".modal").modal('hide');
		closeSidebar();
		id = $(this).attr("href");
		adjustment = 30;
		scrollTarget = ($(id).offset().top)-adjustment
		if(id=="#securhat"){
			scrollTarget = 0;
		}
		$("html, body").animate({ scrollTop: scrollTarget}, 1000);
	})
	
	//map
	google.maps.event.addDomListener(window, 'load', initialize);
})

function closeSidebar(){
	$(".sidebar").animate({"margin-left":"-250px"}, function(){
		$(".sidebar").css({"display":"none"});
	})
	$("body").css({"overflow-y":"auto"});
}

//map
function initialize() {
	var myLatlng = new google.maps.LatLng(-6.238728, 106.823899);
	var mapOptions = {
		zoom: 15,
		center: myLatlng,
		disableDefaultUI: true
	}
	var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	var marker = new google.maps.Marker({
		position: myLatlng,
		map: map,
		title: 'Posisi Server Kami'
	});
}