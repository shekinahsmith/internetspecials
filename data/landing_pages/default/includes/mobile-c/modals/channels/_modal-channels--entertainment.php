<?
	// we have to load this since we are ajax'ing in this file and need access to the pricing variables
	require_once($_SERVER['DOCUMENT_ROOT'] . 'define.php');
?>

<div class="modal__header">

	<h2 class="modal__header-channel-title">DIRECTV Entertainment&trade;<br>All Included</h2>
	<p class="modal__header-channel-count"><?= $dtvProductsEntertainment->Channels->Total; ?>+ Channels</p>

</div><!-- /.modal__header -->

<ul class="channel-lineup">

<?
	// Setup Packages and Headers
    $Packages = getDisplayPackages('English');
    $Channels = getDisplayChannels();
	$previousLetter = null;

	foreach($Packages as $Package) {

		if ($Package->PackageName == 'Entertainment') {

			foreach($Channels as $Channel) {
			
				$packagesArray = explode(",", $Channel->ChannelPackageString);

				if ( in_array($Package->ChannelPackageID, $Channel->Packages) ) {

					$firstLetter = strtoupper( substr($Channel->ChannelName, 0, 1) );

					if( $previousLetter !== $firstLetter ) {
				?>
					<li class="channel-lineup__channel-header"><?= $firstLetter; ?></li>
				
				<?	
					$previousLetter = $firstLetter;

				}
					

				?>
					<li class="channel-lineup__channel">
						<span class="channel-lineup__channel-name"><?= $Channel->ChannelName; ?></span>
						<span class="channel-lineup__channel-type"><? echo $Channel->ChannelHD == 1 ? 'HD' : ''; ?></span>

					</li>
				<?

				}
			}
		}
	}
?>

</ul><!-- /.channel-lineup -->
