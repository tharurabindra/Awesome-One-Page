jQuery(document).ready(function() {
  /* Page Scroll to id fn call */
  var headerHeight = jQuery('#masthead').outerHeight();
    jQuery("#site-navigation a,a[href='#top'],a[rel='m_PageScroll2id']").mPageScroll2id({
    highlightSelector:"#site-navigation a",
    offset: headerHeight,
      scrollSpeed: 600,
      scrollEasing: "easeOutQuad"
  });

  /* Responsive Video with body */
  jQuery("body").fitVids();

  /* Fun-Facts Counter Count start */
  if ( typeof jQuery.fn.counterUp !== 'undefined' ) {
    jQuery('.count-number').counterUp({
        delay: 10,
        time: 1000
      });
  }

  /* Posts Slider start */
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

  /* Pages Slider start */
  if ( typeof jQuery.fn.swiper !== 'undefined' ) {
    var swiper = new Swiper('.aop-page-slider-container', {
          pagination: '.swiper-pagination',
          paginationClickable: true,
          nextButton: '.swiper-button-next',
          prevButton: '.swiper-button-prev',
          spaceBetween: 30
      });
  }
  
});