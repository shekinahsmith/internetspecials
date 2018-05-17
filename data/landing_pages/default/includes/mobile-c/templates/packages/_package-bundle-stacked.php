<? global $trackPage; ?>
<div class="package-card package-card--<?= $packageType; ?> package-card--stacked <?= $packageFilter; ?>" data-package="<?php echo $packageFilter; ?>">
	<div class="row collapse">
		<div class="small-12 columns">
			<div class="package-card__plan-info package-card__plan-info--<?= $packageType; ?>">
				<div class="package-card__image">
					<div class="devices package-card__devices">
						<div class="device device--shadow device--laptop">
							<img src="<?= $site_settings['path']['assets'] ?>/images/devices/laptop.png" alt="Laptop">
							<div class="device__screen" style="background-image: url(<?= $site_settings['ui']['featured']['3']['image']['src']; ?>);">
							</div><!-- /.device__screen -->
						</div><!-- /.device -->
					</div><!-- /.devices -->
				</div><!-- /.package-card__image -->
				<ul class="package-card__plan-info-list">
					<li class="package-card__plan-info-list-item package-card__plan-info-list-item--speed">Internet <?= $packageInternetSpeed; ?></li>
					<li class="package-card__plan-info-list-item package-card__plan-info-list-item--tag-line"><?= $packageTagLine; ?></li>
					<li class="package-card__plan-info-list-item package-card__price package-card__price--<?= $packageClass; ?>">
						<div class="price-lockup">
							<div class="price-point">
								<div class="price-point__dollars"><?= $packagePriceDollars; ?></div>
								<div class="legal price-point__frequency"><?= $packageFrequency; ?></div>
							</div><!-- /.price-point -->
						</div><!-- /.price-lockup -->
					</li><!-- /.package-card__price -->
					<li class="package-card__plan-info-list-item package-card__plan-info-list-item--legal legal"><?= $packageProximityLegal; ?></li>
					<li class="package-card__plan-info-list-item package-card__plan-info-list-item--button">
						<div class="button button--secondary button--block js-track" data-tracker='<?= rv_tracker_attrs($trackPage, $packageTracking, 'get plan'); ?>'>
							<span class="h-phone" data-c2c-parent="button">Get this plan</span>
						</div>
					</li>
				</ul><!-- /.package-card__plan-info-list -->
			</div><!-- /.package-card__plan-info -->
			<div class="package-card__banner package-card__banner--bundle">Bundle with DIRECTV and save</div>
			<div class="package-card__plan-info package-card__plan-info--bundled">
				<div class="package-card__image">
					<div class="devices section__devices">
						<div class="device device--tv">
							<img src="<?= $site_settings['path']['assets'] ?>/images/devices/tv.png" alt="TV">
							<div class="device__screen" style="background-image: url( <?= $site_settings['movie']['featured']['8']['image']['src']; ?> );"></div><!-- /.device__screen -->
						</div><!-- /.device -->
						<div class="devices__group devices__group--positioned devices__group--no-caption devices__group--right">
							<div class="device device--shadow device--laptop">
								<img src="<?= $site_settings['path']['assets'] ?>/images/devices/laptop.png" alt="Laptop">
								<div class="device__screen" style="background-image: url(<?= $site_settings['ui']['featured']['3']['image']['src']; ?>);">
								</div><!-- /.device__screen -->
							</div><!-- /.device -->
						</div><!-- /.devices__group -->
					</div><!-- /.devices -->
				</div>
				<ul class="package-card__plan-info-list list-disc">
					<span class="package-card__plan-info-list-item package-card__plan-info-list-item--bundled-headline">DIRECTV + AT&T Internet</span>
					<li class="package-card__plan-info-list-item package-card__plan-info-list-item--bundled-speed"><?= $packageInternetSpeed; ?> Internet Plan</li>
					<li class="package-card__plan-info-list-item package-card__plan-info-list-item--bundled-package-title"><?= $packageBundled; ?> All-Included</li>
					<li class="package-card__plan-info-list-item package-card__plan-info-list-item--bundled-channels"><?= $packageBundledChannelCnt; ?>+ Channels
						<a href="#" class="js-modal-show" data-modal="channel-lineup" data-package="<?= $packageBundledModal; ?>">View all</a>
					</li>
					<span class="package-card__plan-info-list-item package-card__price package-card__price--bundled <?= $packageBundledPriceExtraWide ? 'package-card__price--extra-wide' : ''; ?>">
						<div class="price-lockup">
							<div class="price-point">
								<div class="price-point__dollars"><?= $packagePriceBundledDollars; ?></div>
								<div class="legal price-point__frequency">/per mo.<br>Plus taxes<br>& RSN Fees</div>
							</div><!-- /.price-point -->
						</div><!-- /.price-lockup -->
					</span><!-- /.package-card__price -->
				</ul><!-- /.package-card__plan-info-list -->
				<div class="package-card__bundled-legal legal"><?= $packageBundledProximityLegal; ?></div>
				<? // hidden by default ?>
				<div class="package-card__additional-info js-package-card__additional-info">
					<div class="package-card__plan-channels">
						<div class="package-card__plan-channels-headline"><?= $packageBundledChannelCnt; ?>+ Channels Including:</div>
						<ul class="package-card__logo-list">
							<? foreach ($packageBundledChannelLogos as $logo) { ?>
								<li class="package-card__logo-list-item">
									<img src="<?= $logo; ?>" alt="Network Logo">
								</li>
							<? } ?>
						</ul><!-- /.package-card__logo-list -->
					</div><!-- /.package-card__plan-channels -->
					<div class="package-card__plan-features">
						<ul class="package-card__plan-features-list">
							<li class="package-card__plan-features-list-item package-card__plan-features-list-item--premiums">
								<ul class="package-card__logo-list package-card__logo-list--premiums">
									<? foreach ($packageBundledPremiumLogos as $logo) { ?>
										<li class="package-card__logo-list-item package-card__logo-list-item">
											<img src="<?= $logo; ?>" alt="Network Logo">
										</li>
									<? } ?>
								</ul>
								<div class="package-card__logo-list-headline"><?= $packageBundledPremiumLegal ?></div>
								<div class="legal"><? include(RV_Web_SharedInclude::include_shared_file('ds', 'legal/disclaimers/premiums/_premiums-included.html')); ?></div>
							</li>
							<li class="package-card__plan-features-list-item">Standard professional Installation</li>
							<li class="package-card__plan-features-list-item">Includes a Genie<sup>&reg;</sup> HD DVR upgrade
							</li>
						</ul><!-- /.package-card__plan-features-list -->
					</div><!-- /.package-card__plan-features -->
				</div><!-- /.package-card__additional-info -->
				<div class="package-card__cta">
					<a class="package-card__cta-toggle js-package-card__cta-toggle">Plan Details</a>
					<div class="package-card__cta-button button button--secondary js-track" data-tracker='<?= rv_tracker_attrs($trackPage, $packageBundledTracking, 'get plan'); ?>'>
						<span class="h-phone" data-c2c-parent="button">Get this plan</span>
					</div>
				</div><!-- /.package-card__cta -->
			</div><!-- /.package-card__plan-bundle-info -->
		</div><!-- /.small-12 columns -->
	</div><!-- /.row -->
</div><!-- /.package-card -->