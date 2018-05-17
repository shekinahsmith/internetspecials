<div class="banner banner-availability">

	<p>Check Availability: <em>Find the best AT&T <? if ($_SERVER['SCRIPT_URL'] == '/u-verse-tv.html') {  echo 'U-verse<sup>&reg;</sup>'; } else { echo 'Internet'; } ?> deals in your area!</em></p>
			
	<form method="post" action="/zip_check_post2.php">
		
		<input type="text" placeholder="<?= isset($_SESSION['ATTServiceability']['Zip']) && $_SESSION['ATTServiceability']['EnteredZip'] ? $_SESSION['ATTServiceability']['Zip'] : 'Enter ZIP' ?>" name="AvailabilityZipCode" required pattern="(\d{5}([\-]\d{4})?)" title="enter a valid five-digit ZIP code" />
		<input type="submit" class="button is-blue-light" value="Find Deals" />

	</form>
	<!-- END form -->

</div>
<!-- /.banner banner-availability -->