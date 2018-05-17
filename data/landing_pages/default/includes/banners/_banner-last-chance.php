<div class="banner-last-chance">
	
	<div class="row">

		<div class="grid-16 banner-wrapper">

			<div class="secondary-content">
				<div class="call-to-action">Last Chance!</div>
				<div class="promo-image"></div>
				<div class="promo-text">
					Get up to a <span>$<?= $attPromoRewardCardResidential->Amount; ?></span> Visa Reward Card with qualifying services!
					<div class="promo-tooltip js-tooltip-small--click" title="<?= $attPromoRewardCardResidential->Language->English->Legal; ?>">i</div>
				</div>
			</div>

			<div class="primary-content">
					
					<a href="tel://<?= $sitePhone; ?>" class="phone"><span class="h-phone"><?= $sitePhone; ?></span></a>

					<?
						// set it to nothing to start with
						$countDown = (isset($_GET['fakecount'])
							? new RV_Countdown_Mock() // easy way to add support for "fakecount"
							: new RV_Countdown(85));

						// make sure we are open & count down is valid
						if ( $countDown->is_valid() ) {
					?>


						<div class="countdown">
							<span class="countdown-label">We're<br>Open!</span> <span class="time-label">ONLY</span>

						<?
							if(!empty($countDown->hours)) { ?>

								<div class="time hours"><span class="number"><?=$countDown->hours?></span> <?=$countDown->label('hrs')?></div>
						<?
							}

							if(!empty($countDown->minutes)) {
						?>
								<div class="time minutes"><span class="number"><?=$countDown->minutes?></span> <?=$countDown->label('mins')?></div>
						<?
							}
						?>
							<span class="time-label">LEFT!</span>
						</div>
						<!-- /.countdown -->

						

					<?
						} else {
					?>
					
						<div class="after-hours">Call us! We'll help you find the plan that's right for you!</div>

					<? } ?>
	
			</div>

		</div>
		<!-- /.grid-16 -->

	</div>
	<!-- /.row-->

</div>
<!-- /.banner-last-chance -->