<section class="hero-wrapper hero-home-wrapper">
	<div class="hero-slide hero-home">
		<div class="headline">Sweet Home<br>Chicago.</div>
		<div class="subheadline">Save up to 20% when you switch to AT&T.</div>
		<p class="hero-legal">
			<span class="excerpt js-excerpt-copy">Online price comparison in Chicago as of 7/26/16, based on 2 years of an AT&T bundle of digital home phone service, DIRECTV SELECT All Included Package, and 45Mbps Internet Plan, including monthly fees for one wireless gateway, one HD DVR receiver and one mini Genie receiver vs. 2 years of Comcast bundle of home phone, Digital Starter w/Streampix and 75Mbps Internet, including the leasing of one wireless gateway and one HD DVR receiver.</span>
			<a class="js-read-more read-more" href=#>Read More</a>
		</p>
		<a href="/order.html" class="btn grad-secondary">Shop now</a>
		<div class="sticker sticker--orange sticker--price">
			<div class="sticker__heading"><?= $attChicagoInternet30Offer->Language->English->Name; ?></div>
			<span class="rv-pricing">
				<sup class="rv-pricing__currency">$</sup>
				<?= $attChicagoInternet30Offer->Price->Dollars; ?>
				<sup class="rv-pricing__frequency">
					<?= $attChicagoInternet30Offer->Price->FrequencyShortWithTaxes; ?>
				</sup>
			</span>
			<div class="sticker__subheading"><?= $attChicagoInternet30Offer->Language->English->Subheading; ?></div>
			<p class="sticker__legal"><?= $attChicagoInternet30Offer->Language->English->Legal->PricePoint; ?></p>
		</div>
		<img alt="Exclusive Offer For Chicagoland" class="hero-home__sticker" src="/assets/desktop-a/images/experiences/291/exclusive-offer-for-chicagoland.png">
	</div>
</section>