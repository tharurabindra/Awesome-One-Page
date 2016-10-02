jQuery(document).ready(function() {

  // Init WOW.js
  if (typeof WOW == 'function') {
    new WOW().init();
  }

  // js to scroll button to pop
  jQuery("#scroll-up").hide();

  jQuery(window).scroll(function() {
      if (jQuery(this).scrollTop() > 1000) {
          jQuery('#scroll-up').fadeIn();
      } else {
          jQuery('#scroll-up').fadeOut();
      }
  });
  jQuery('a#scroll-up').click(function() {
      jQuery('body,html').animate({
          scrollTop: 0
      }, 800);
      return false;
  });

  /* Page Scroll to id fn call */
  var headerHeight = jQuery('#masthead').outerHeight();
    jQuery('#site-navigation a,a[href="#top"],a[rel="m_PageScroll2id"]').mPageScroll2id({
    highlightSelector:'#site-navigation a',
    offset: headerHeight,
      scrollSpeed: 600,
      scrollEasing: 'easeOutQuad'
  });

  /* Responsive Video with body */
  if ( typeof jQuery.fn.fitVids !== 'undefined' ) {
    jQuery('body').fitVids();
  }

  // Colors for the widgts.
  var elements = 'h1,h2:not(.widget-title),h3,h4,h5,h6,a,div,span';
  jQuery('.page-template-template-awesome-one-page #main section').each( function() {
    if (jQuery(this).data('color') == 'inherit') {
      jQuery(this).find(elements).css('color','inherit');
    }   
  });

  /* Fun-Facts Counter Count start */
  if ( typeof jQuery.fn.counterUp !== 'undefined' ) {
    jQuery('.count-number').counterUp({
      delay: 10,
      time: 1000
    });
  }

  /* Posts Slider start */
  if ( typeof jQuery.fn.swiper !== 'undefined' ) {
    var post_swiper = new Swiper('.aop-posts-swiper-container', {
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

  /* Pages Slider start */
  if ( typeof jQuery.fn.swiper !== 'undefined' ) {
    var page_swiper = new Swiper('.aop-page-slider-container', {
          pagination: '.swiper-pagination',
          paginationClickable: true,
          nextButton: '.swiper-button-next',
          prevButton: '.swiper-button-prev',
          spaceBetween: 30
      });
  }
  
});