<div class="package-card package-card--product-recommendation package-card--<?= $packageClass; ?>">

    <div class="row collapse">

        <div class="small-12 columns">

            <div class="package-card__headline package-card__headline--<?= $packageClass; ?>"><?= $packageTitle; ?></div>

            <div class="package-card__plan-info">

                <ul class="package-card__plan-info-list">

                    <? if( $isBundled ) { ?>

                        <li class="package-card__plan-info-list-item package-card__plan-info-list-item--speed"><?= $packageDownloadSpeed; ?></li>
	                    <li class="package-card__plan-info-list-item package-card__plan-info-list-item--channel-count"><?= $packageChannelCnt; ?>+ channels<br /><a href="#" class="js-modal-show" data-modal="channel-lineup" data-package="<?= $packageBundled; ?>">View All</a></li>

                    <? } else { ?>

                        <li class="package-card__plan-info-list-item package-card__plan-info-list-item--download"><?=  $packageDownloadSpeed; ?> max download speed</li>
                        <li class="package-card__plan-info-list-item package-card__plan-info-list-item--upload"><?=  $packageUploadSpeed; ?> max upload speed</li>

                    <? } ?>

                </ul><!-- /.pakcage-card__speed-list -->

            </div><!-- /.package-card__speed-info -->


            <div class="package-card__price package-card__price--<?= $packageClass; ?> <?= $packagePriceExtraWide ? 'package-card__price--extra-wide' : ''; ?>">

                <div class="price-lockup">

                    <div class="price-point">

                        <div class="price-point__dollars"><?= $packagePrice; ?></div>

                        <? if( $isBundled ) { ?>
                            <div class="legal price-point__frequency">per mo.<br>plus taxes<br/>and RSN Fees</div>
                        <? } else { ?>
                            <div class="legal price-point__frequency">per mo.<br>plus taxes</div>
                        <? } ?>

                    </div><!-- /.price-point -->

                </div><!-- /.price-lockup -->

            </div><!-- /.package-card__price -->

            <? if( $isBundled ) { ?>

                <div class="package-card__additional-info js-package-card__additional-info">

                    <div class="package-card__legal package-card__legal--<?= $packageClass; ?> legal">

                        <?= $packageProximityLegal; ?>

                        <? if( isset($packageToolTip) ) { ?>

                            <a v-tooltip.bottom-start="{ content: '<?= $packageToolTip; ?>', classes: 'internet-tooltip' }">Offer Details</a>

                        <? }?>

                    </div>

                </div>

                <div class="package-card__plan-features package-card__plan-features--primary">

                    <ul class="package-card__plan-features-list">

                        <li class="package-card__plan-features-list-item package-card__plan-features-list-item--channel-count">
                            <span class="channel-header"><?= $packageBundledTitle; ?></span>
                            <span class="channel-count"><?= $packageChannelCnt; ?>+ Channels</span>
                        </li>

                    </ul><!-- /.package-card__plan-features-list -->

                </div><!-- /.package-card__plan-features -->

                <div class="package-card__additional-info js-package-card__additional-info">

                    <div class="package-card__plan-features package-card__plan-features--secondary">

                        <ul class="package-card__plan-features-list">

                            <li class="package-card__plan-features-list-item package-card__plan-features-list-item--premiums">

                                <ul class="package-card__logo-list package-card__logo-list--premiums">
                                <? foreach( $packageBundlePremiumLogos as $logo ) { ?>

                                    <li class="package-card__logo-list-item package-card__logo-list-item"><img src="<?= $logo; ?>" alt="Network Logo"></li>

                                <?  } ?>
                                </ul>

                                <div class="package-card__logo-list-headline"><?= $packageBundlePremiumLegal ?></div>
                                <div class="legal"><? include( RV_Web_SharedInclude::include_shared_file('ds', 'legal/disclaimers/premiums/_premiums-included.html') ); ?></div>

                            </li>
                            <li class="package-card__plan-features-list-item">Standard professional Installation</li>
                            <li class="package-card__plan-features-list-item">Includes a Genie<sup>&reg;</sup> HD DVR upgrade</li>

                        </ul><!-- /.package-card__plan-features-list -->

                    </div><!-- /.package-card__plan-features -->

                </div><!-- /.package-card__additional-info -->

            <? }  else { ?>

                <div class="package-card__legal package-card__legal--<?= $packageClass; ?> legal">

                    <?= $packageProximityLegal; ?>

                    <? if( isset($packageToolTip) ) { ?>

                        <a v-tooltip.bottom-start="{ content: '<?= $packageToolTip; ?>', classes: 'internet-tooltip' }">Offer Details</a>

                    <? }?>

                </div>

                <div class="package-card__plan-features">

                    <ul class="package-card__plan-features-list">

                        <? foreach( $packageFeatures as $feature ) { ?>

                            <li class="package-card__plan-features-list-item"><?= $feature; ?></li>

                        <? } ?>
                    </ul>

                </div><!-- /.package-card__plan-features-list -->

            <? } ?>

            <div class="package-card__cta">

                <? if( $isBundled ) { ?>

                    <a class="package-card__cta-toggle js-package-card__cta-toggle">View Plan Details</a>

                <? } ?>

            </div><!-- /.package-card__cta -->

        </div><!-- /.columns -->

    </div><!-- /.row -->

</div><!-- .package-card -->