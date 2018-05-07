<?php
if(defined('INTERNAL_ADDRESS') && INTERNAL_ADDRESS && $_GET['forceExternal'] != 1) {
	
		echo "\n<!-- INTERNAL_ADDRESS -->\n";
		echo RV_OnlineSearch_Analytics_Google_Tracker::render_async_debug_library();
		
} else {
	
	// Global skip on internal traffic (unless ?forceExternal=1)
	if($_GET['forceExternal'] == 1) {
		echo "\n<!-- Faking EXTERNAL -->\n";
	}
	
	if(in_array($_SESSION['Marketing']['ChannelID'], array(5, 13))) { 

		echo <<<END
		<script type="text/javascript">

			$.post("/webshared/js_enabled.php", {
				[action    : '0NpxYfeA3T8%3D',
				cid        : 'FCUP1Vb9Xco%3D',
				vid ]      : 'bmFTZki7DzTPRIftfn4v1g%3D%3D'
			});

		</script>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
			hQ.on("initialized", function(){
				var hud = halcyon.cookie.getHUD();
												
				ga('create', 'UA-38598652-1', {                                                                  
					'clientId': hud.i 
				});

				ga('set', 'dimension1',hud.i);
				ga('send', 'pageview');
			
			});
	
		</script>
	
		<script>
			if ('function' === typeof ga) {
				ga(function (tracker) {
					if ('function' === typeof tagular) {
						tagular('alias', 'ga.ua-cid',
							[
							tracker.get('trackingId'), tracker.get('clientId')
							].join('...')
						);
					}
				});
			}
		</script>
END;
	}
	
}
