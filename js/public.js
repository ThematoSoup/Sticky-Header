(function ($) {
	"use strict";
	$(document).ready(function () {
		thsp_sticky_header();
	});
	
	$(window).scroll(function () {
		thsp_sticky_header();
	});
	
	function thsp_sticky_header() {
	if (document.body.scrollTop > StickyHeaderParams.show_at)
		$('#thsp-sticky-header').stop().animate({"margin-top": '0'}, 50);
	else
		$('#thsp-sticky-header').stop().animate({"margin-top": '-100'}, 50);
	}
}(jQuery));