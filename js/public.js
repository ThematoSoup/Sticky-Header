(function ($) {
	"use strict";
	$(document).ready(function () {
		thsp_sticky_header();
	});
	
	$(window).scroll(function () {
		thsp_sticky_header();
	});

	$(window).resize(function () {
		thsp_sticky_header();
	});
	
	function thsp_sticky_header() {
		// Check browser window width
		if ($(window).scrollTop() > StickyHeaderParams.show_at && $(window).width() > StickyHeaderParams.hide_if_narrower) {
			// Show
			$('#thsp-sticky-header').stop().animate({"margin-top": '0'}, 25);
		} else {
			// Hide
			$('#thsp-sticky-header').stop().animate({"margin-top": '-200'}, 25);
		}
	}
}(jQuery));