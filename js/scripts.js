function scrollActions() {
	scroll = $(window).scrollTop();
	scrollB = $(window).scrollTop() + $(window).height();
	windowHeight = $(window).height();

	if ($(window).width() < 768) {
		$('#intro').css('background-position','0px '+((scroll/2)+82)+'px');
	}


	if (scrollB > ($('.bestuur').offset().top + 100)) {
		$('.bestuur .boardmember').css('left','0');
	}

	if (scroll < 100 && scroll >= 0 && $('.viewport-width-flag').is(':visible')) {
		$('.home .logo').css('height', (30-scroll/2) + 72);
		$('.home nav ul').css('padding-top',(25-scroll/2)+"px");
	} else if (scroll <= 0 && $('.viewport-width-flag').is(':visible')) {
		$('.home .logo').css('height', '102px');
		$('.home nav ul').css('padding-top',"25px");
	} else {
		$('.home .logo').css('height', '52px');
		$('.home nav ul').css('padding-top',"0px");
	}

	if ($(window).width() > 767) {
		$('nav ul').show();
	}
}

$(window).scroll(function() { scrollActions(); });
$(window).resize(function() { scrollActions(); });
$(document).bind("scrollstart", function() { scrollActions(); });
$(document).bind("scrollstop", function() { scrollActions(); });

$(document).ready(function() {
	$('#intro').css('height',$(window).height());
	$('.home .logo').css('height', '102px');
	$('.home nav ul').css('padding-top',"25px");

	$('#intro .intro').css('left','0');
	setTimeout(function() { $('#intro .readmore').css('top','0') },500);

	$('#intro').css('opacity','0').animate({opacity: 1}, 1000);

	$('a.menubutton').bind('click touchend', (function(e) {
		e.preventDefault();
		$('nav ul').toggle();
	}));

	$('nav ul a').bind('click touchend', (function(e) {
		if ($(window).width() < 768) {
			$('nav ul').hide();
		}
	}));

	scrollActions();

	$('.bestuur .boardmember:nth-child(1)').css('left',-1000);
	$('.bestuur .boardmember:nth-child(2)').css('left',-1000);
	$('.bestuur .boardmember:nth-child(3)').css('left',1000);
	$('.bestuur .boardmember:nth-child(4)').css('left',1000);
});
