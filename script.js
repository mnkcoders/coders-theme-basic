/**/


document.addEventListener('DOMContentLoaded',function(){
    
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

