$(function () {
	$('.event').removeClass('event--nojs').addClass('event--js');
	
	$(window).on('resize', function() {
		var width = document.documentElement.clientWidth;
		var columns;
		
		if (width < 768)
			columns = 1;
		else if (width < 992)
			columns = 2;
		else if (width < 1200)
			columns = 3;
		else
			columns = 4;
		
		if (columns > 1) {
			var events = $('.eventsContainer');
			
			events.children('.layoutSeparator').each(function() {
				var event = $(this);
				var prevEvents = event.prevUntil('.layoutSeparator', '.event');
				
				prevEvents.filter('.event--width2').removeClass('event--width2').addClass('event--width1');
				prevEvents.filter('.event--width3').removeClass('event--width3').addClass('event--width1');
				
				var blankSpace = columns - (prevEvents.length % columns);
				var eventCount = prevEvents.length;
				
				if (blankSpace !== 0) {
					if (blankSpace === 1) {
						prevEvents.first().removeClass('event--width1').addClass('event--width2');
					}
					else if (blankSpace === 2) {
						if (columns === 3) {
							prevEvents.last().removeClass('event--width1').addClass('event--width3');
						}
						else if (columns === 4) {
							prevEvents.first().removeClass('event--width1').addClass('event--width2');
							prevEvents.last().removeClass('event--width1').addClass('event--width2');
						}
					}
					else if (blankSpace === 3 && eventCount > 4) {
						prevEvents.first().removeClass('event--width1').addClass('event--width2');
						prevEvents.last().removeClass('event--width1').addClass('event--width2');
						prevEvents.last().next().removeClass('event--width1').addClass('event--width2');
					}
				}
			});
		}
	});
	
	$(window).trigger('resize');
	
	$('.event__gallery').each(function() {
		var gallery = $(this);
		var wrapper = gallery.find('.event__galleryWrapper');
		var images = gallery.find('.event__image');
		
		var btnLeft = gallery.find('.event__navigation--left > .event__navigationArrow > button');
		var btnRight = gallery.find('.event__navigation--right > .event__navigationArrow > button');
		
		gallery.scroll = function() {
			$('body').animate({ scrollTop: parseInt(wrapper.offset().top - document.documentElement.clientHeight/20, 10) }, 600);
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