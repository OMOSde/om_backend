// do when DOM is loaded
window.addEvent('domready', function() {
  
  // set no conflict mode
  $.noConflict();

  // do on window scroll  
  jQuery(window).scroll(function()
  {
    diff = (jQuery(window).scrollTop() - jQuery('#container').position().top) > 0 ? jQuery(window).scrollTop() - jQuery('#container').position().top : 0;

    jQuery('#toolbar').css('top', diff+'px');
    jQuery('#left').css('margin-top', diff+'px');
  });
});
