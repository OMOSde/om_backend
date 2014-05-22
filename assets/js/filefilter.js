/**
 * Contao module om_backend
 * 
 * @copyright OMOS.de 2014 <http://www.omos.de>
 * @author    René Fehrmann <rene.fehrmann@omos.de>
 * @package   om_backend
 * @link      http://www.omos.de
 * @license   LGPL
 */

// filter function
function filter()
{
  var value = jQuery('.inpFilter').val();
  
  jQuery('.tl_file .tl_left').each(function() {
    var string = jQuery(this).text().split(' (');
    (string[0].indexOf(value) >= 0) ? jQuery(this).parent().show() : jQuery(this).parent().hide();
  });
}


// no conflict with mootools
jQuery.noConflict();


// do at domready
jQuery(document).ready(function() {  
  // if file management
  if (jQuery(document).getUrlParam('do') == 'files')
  {
    // add panel to layout
    jQuery('.main_headline').after('<div class="tl_panel"><div class="tl_search tl_subpanel"><strong>Dateifilter: </strong><input type="text" name="tl_value" class="tl_text inpFilter" value=""></div><div class="clear"></div></div>');

    // add events
    jQuery('.inpFilter').keyup(filter);
  }
});
