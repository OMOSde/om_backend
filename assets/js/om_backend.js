/**
 * Variables
 */
var isKeyDown = false;


/**
 * Events
 */
window.addEvent('scroll', function(){
    calculateFixedToolbar();    
});
window.addEvent('resize', function(){
    calculateFixedToolbar();
});
window.addEvent('keydown', function(event) {
    keyDown(event);
});
window.addEvent('keyup', function(event) {
    keyUp(event);
});


/**
 *
 */
function calculateFixedToolbar()
{
    // calculate fixed toolbar position
    pos = ($$('html').getSize()[0].x - $$('div#container').getSize()[0].x) / 2 + $$('div#container').getSize()[0].x + 10;    
    
    // fixed ??        
    if (window.getScroll().y >= $$('div#container').getPosition()[0].y)
    {
        $$('div#toolbar').addClass('fixed');
        $$('div#toolbar').setStyle('left', pos + 'px');
    } else {
        $$('div#toolbar').removeClass('fixed');
        $$('div#toolbar').setStyle('left', 'auto');
    }    
}


/**
 *
 * @param event
 */
function keyDown(event)
{
    if (event.code == 16 && !isKeyDown)
    {
        isKeyDown = true;
        $$('.om_viewInfoOnShift .tl_listing .tl_right, .om_viewInfoOnShift .tl_listing .tl_right_nowrap').each(function(elem) {
            var id = 0;
            elem.getElements('a').each(function(link) {
                pos = link.get('href').indexOf('&id=');
                if (pos > 0)
                {
                    part = link.get('href').substr(pos + 4);
                    id = part.substr(0, part.indexOf('&'));
                }
            });

            if (id > 0 && elem.getPrevious().get('html').indexOf('[ID:') <= 0)
            {
                elem.getPrevious().appendHTML('<span style="color:#b3b3b3;padding-left:3px">[ID: '+id+']</span>');
            }
        });
    }
}


/**
 *
 * @param event
 */
function keyUp(event)
{
    if (event.code == 16)
    {
        isKeyDown = false;
        $$('.om_viewInfoOnShift .tl_listing .tl_left, .om_viewInfoOnShift .tl_listing .tl_file_list').each(function(elem) {
            pos = elem.get('html').indexOf('<span style="color:#b3b3b3;padding-left:3px">[ID:');
            if (pos > 0)
            {
                elem.set('html', elem.get('html').substr(0, pos));
            }
        });
    }
}