
window.addEvent('scroll', function(){
    calculateFixedToolbar();    
});
window.addEvent('resize', function(){
    calculateFixedToolbar();
});


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
