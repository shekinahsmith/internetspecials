<script>
  (function(w, undefined) {
 	if (!aio) return false;
        aio.on('ready', function (articulate) {

        	// include global listeners - http://confluence/display/AP/Articulate+Events
			articulate.subscribe('ui:maximized', function(){

                $.cookie('aio.displayed', true);

            });

        	// include experience only listeners
        	<? include_once(RV_LandingPage::find('includes/articulate/chat/_articulate-listeners-experience.php')); ?>

            if ( typeof $.cookie('aio.displayed') !== 'undefined' ) {
                clearTimeout(articulate_chat_window_timing_timeout);
            }
            
        });
    })(window);

</script>