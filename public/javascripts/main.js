$(function () {
	$('.event').removeClass('event--nojs').addClass('event--js');
	
	$('.event__gallery').each(function() {
		var gallery = $(this);
		var wrapper = gallery.find('.event__galleryWrapper');
		var images = gallery.find('.event__image');
		
		var btnLeft = gallery.find('.event__navigation--left > .event__navigationArrow > button');
		var btnRight = gallery.find('.event__navigation--right > .event__navigationArrow > button');
		
		gallery.scroll = function() {
			$('body').animate({ scrollTop: parseInt(wrapper.offset().top, 10) }, 600);
		};
		
		gallery.slide = function(direction) {
			var curr = images.filter('.event__image--active');
			var next;
			
			if (direction === 1) {
				next = curr.nextAll('.event__image').first();
				
				if (next.length === 0) {
					next = curr.siblings('.event__image').first();
				}
			}
			else {
				next = curr.prevAll('.event__image').first();
				
				if (next.length === 0) {
					next = curr.siblings('.event__image').last();
				}
			}
			
			next.addClass('event__image--active');
			
			curr.removeClass('event__image--active');
			
			gallery.scroll();
		};
		
		btnLeft.on('click', function() { gallery.slide(-1); });
		btnRight.on('click', function() { gallery.slide(1); });
		
		wrapper.on('click', function() { gallery.scroll(); });
	});
	
	$('.header').removeClass('header--nojs').addClass('header--js');
	
	$('.header__toggleMore').on('click', function() {
		var t = $(this);
		var more = t.parent().children('.header__more');
		
		more.toggleClass('header__more--hidden');
	});
});