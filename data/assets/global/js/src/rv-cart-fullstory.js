// check to see if Cart already exist on the window
window.Cart = window.Cart || {};

// creates a cookie for full story based on hailo interaction id
// so that we can have a persistent experience from site to cart
// when watching in fullstory.
window.Cart.FullStorySessionId = function() {

	var interactionId = 0;

	function setFullStorySessionIdCookie(interactionId) {
		var expires = '';
		var minutes = 60;
		if (minutes) {
			var date = new Date();
			date.setTime(date.getTime() + minutes * 60 * 1000);
			expires = '; expires=' + date.toUTCString();
		}

		// Stringify the cookie if they pass in an object
		return document.cookie = 'fullStorySessionId=' + interactionId + expires + '; path=/';
  }

	// gets the hailo interaction id make sure we have an hQ object
	if (typeof hQ !== 'undefined') {
			
		// wait for hailo to be initialized
		hQ.on('initialized', function() {
			
			// if it exists, grab interaction id from hud
			if(typeof halcyon !== 'undefined') {

        interactionId = halcyon.cookie.getHUD().i;
        setFullStorySessionIdCookie(interactionId);
			}
		});
	}
}

// execute
Cart.FullStorySessionId();