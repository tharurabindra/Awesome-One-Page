;(function($) {

   	'use strict'

   	/* Page Scroll to id fn call */
   	var menuPage2id = function() {
   		var headerHeight = $('#masthead').outerHeight();
   		$("#site-navigation a,a[href='#top'],a[rel='m_PageScroll2id']").mPageScroll2id({
			highlightSelector:"#site-navigation a",
			offset: headerHeight,
		    scrollSpeed: 600,
		    scrollEasing: "easeOutQuad"
		});
	};

	/* Responsive Video with body */
    var responsiveVideo= function(){
	  $(document).ready(function(){
	    $("body").fitVids();
	  });
    };

    /* Fun-Facts Counter Count start */
	var counter = function() {
		if ( typeof jQuery.fn.counterUp !== 'undefined' ) {
			$('.count-number').counterUp({
		      delay: 10,
		      time: 1000
		    });
		}
	};

	/* Posts Slider start */
	var posts_slider = function() {
		if ( typeof jQuery.fn.swiper !== 'undefined' ) {
			var swiper = new Swiper('.aop-posts-swiper-container', {
		        pagination: '.swiper-pagination',
		        nextButton: '.swiper-button-next',
		        prevButton: '.swiper-button-prev',
		        paginationClickable: true,
		        spaceBetween: 30,
		        centeredSlides: true,
		        autoplay: 2500,
		        autoplayDisableOnInteraction: false
		    });
		}
	};

	/* Pages Slider start */
	var pages_slider = function() {
		if ( typeof jQuery.fn.swiper !== 'undefined' ) {
			var swiper = new Swiper('.aop-page-slider-container', {
		        pagination: '.swiper-pagination',
		        paginationClickable: true,
		        nextButton: '.swiper-button-next',
		        prevButton: '.swiper-button-prev',
		        spaceBetween: 30
		    });
		}
	};


	// Dom Ready
	$(function() {
		menuPage2id();
		responsiveVideo();
		counter();
		posts_slider();
		pages_slider();
   	});
})(jQuery);
