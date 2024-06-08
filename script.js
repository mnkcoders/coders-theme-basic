/**/


document.addEventListener('DOMContentLoaded',function(){
    
    
    var _btnMenu = jQuery('#site-menu').parent().append('<span id="responsive-menu-button"></span>');
    
    _btnMenu.on('click',function(e){
        //console.log(e);
        jQuery('#site-main').toggleClass('active-menu');
    });
    
    console.log('OK');
    
    jQuery( '#list_request').on('click', function(e){
	var data = {
		'action': 'coders_list_request',
		'something': 'Hello world',
		'another_thing': 14,
                'nonce': CodersScript.nonce,
	}
        console.log( window.location.href);
	jQuery.post(
                CodersScript.url,
                data,
                response => console.log( JSON.parse( response ) )
        );
    });
});

