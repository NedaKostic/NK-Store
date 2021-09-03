$(document).ready(function () {
	let imgNum = $("#slider li").length; 
	let imgPos = 1;

	for (i = 1; i <= imgNum; i++) {
		$("#circles").append("<li><i class='fas fa-circle'></i></li>");
	}


	$("#slider li").hide(); 
	$("#slider li:first").show(); 
	$("#circles li:first").css({
		"color": "#e8ac33"
	}); 

	$("#circles li").click(circles);
	$("#right i").click(next);
	$("#left i").click(prev);


	let timer = setInterval(function () {
		next();
	}, 4000);


	function circles() {
		let circlePos = $(this).index() + 1;

		$("#slider li").hide();
		$("#slider li:nth-child(" + circlePos + ")").fadeIn();

		$("#circles li").css({
			"color": "white"
		});
		$(this).css({
			"color": "#e8ac33"
		});

		imgPos = circlePos;
	}

	function next() {
		clearInterval(timer);
		if (imgPos >= imgNum)
			imgPos = 1;
		else
			imgPos++;

		$("#circles li").css({
			"color": "white"
		});
		$("#circles li:nth-child(" + imgPos + ")").css({
			"color": "#e8ac33"
		});

		$("#slider li").hide();
		$("#slider li:nth-child(" + imgPos + ")").fadeIn();
		timer = setInterval(function () {
			next();
		}, 4000);
	}

	function prev() {
		clearInterval(timer);
		if (imgPos <= 1)
			imgPos = imgNum;
		else
			imgPos--;

		$("#circles li").css({
			"color": "white"
		});
		$("#circles li:nth-child(" + imgPos + ")").css({
			"color": "#e8ac33"
		});

		$("#slider li").hide();
		$("#slider li:nth-child(" + imgPos + ")").fadeIn();
		timer = setInterval(function () {
			next();
		}, 4000);
	}

})