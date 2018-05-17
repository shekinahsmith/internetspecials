<?
    global $trackPage;
?>

<div class="package-card package-card--<?= $packageType; ?> <?= $packageFilter . ' ' . $packageChannelFilter; ?>" data-package="<?php echo $packageTracking; ?>">

    <div class="row collapse">

        <div class="small-12 columns">

            <div class="package-card__headline package-card__headline--<?= $packageClass; ?>"><?= $packageTitle; ?></div>

            <div class="package-card__plan-info">

                <ul class="package-card__plan-info-list">

                    <? if( $packageType != 'bundle') { ?>

                        <li class="package-card__plan-info-list-item package-card__plan-info-list-item--tag-line"><?= $packageChannelHeading; ?></li>
                        <li class="package-card__plan-info-list-item package-card__plan-info-list-item--channel-count"><?= $packageChannelCnt; ?>+ channels<br /><a href="#" class="js-modal-show" data-modal="channel-lineup" data-package="<?= $package; ?>">View All</a></li>

                    <? } else { ?>

                        <li class="package-card__plan-info-list-item package-card__plan-info-list-item--speed"><?= $packageInternetSpeed; ?></li>
                        <li class="package-card__plan-info-list-item package-card__plan-info-list-item--channel-count"><?= $packageChannelCnt; ?>+ channels<br /><a href="#" class="js-modal-show" data-modal="channel-lineup" data-package="<?= $package; ?>" >View all</a></li>

                    <? } ?>

                </ul><!-- /.pakcage-card__speed-list -->

            </div><!-- /.package-card__speed-info -->

            <div class="package-card__price package-card__price--<?= $packageClass; ?> <?= $packagePriceExtraWide ? 'package-card__price--extra-wide' : ''; ?>">

                <div class="price-lockup">

                    <div class="price-point">

                        <div class="price-point__dollars"><?= $packagePriceDollars; ?></div>

                        <? if( packageType === 'directv' ) { ?>
                            <div class="legal price-point__frequency">/mo. plus<br />taxes and<br>RSN Fees</div>
                        <?} else { ?>
                            <div class="legal price-point__frequency">/mo. plus<br />taxes and<br>RSN Fees</div>
                        <? } ?>

                    </div><!-- /.price-point -->

                </div><!-- /.price-lockup -->

            </div><!-- /.package-card__price -->

            <? // hidden by default ?>
            <div class="package-card__additional-info js-package-card__additional-info">

                <div class="package-card__legal package-card__legal--<?= $packageClass; ?> legal"><?= $packageProximityLegal; ?></div>

                <div class="package-card__plan-channels">

                    <div class="package-card__plan-channels-headline"><?= $packageChannelCnt; ?>+ Channels Including:</div>

                    <ul class="package-card__logo-list">

                        <? foreach( $packageChannelLogos as $logo ) { ?>

                            <li class="package-card__logo-list-item"><img src="<?= $logo; ?>" alt="Network Logo"></li>

                        <?  } ?>
                    </ul><!-- /.package-card__logo-list -->

                </div><!-- /.package-card__plan-channels -->

                <div class="package-card__plan-features">

                    <ul class="package-card__plan-features-list">

                        <? if($packagePremiumFree) { ?>

                            <li class="package-card__plan-features-list-item package-card__plan-features-list-item--premiums">

                                <ul class="package-card__logo-list package-card__logo-list--premiums">
                                <? foreach( $packageBundlePremiumLogos as $logo ) { ?>

                                    <li class="package-card__logo-list-item package-card__logo-list-item"><img src="<?= $logo; ?>" alt="Network Logo"></li>

                                <?  } ?>
                                </ul>
                                <div class="package-card__logo-list-headline"><?= $packageBundlePremiumLegal ?></div>
                                <div class="legal"><? include( RV_Web_SharedInclude::include_shared_file('ds', 'legal/disclaimers/premiums/_premiums-included.html') ); ?></div>

                            </li>

                        <? } ?>

                        <? if ($packageNflst) { ?>

                            <li class="package-card__plan-features-list-item">

                                <?= $packageNflstHeading; ?>
                                <div class="legal"><? include( RV_Web_SharedInclude::include_shared_file('ds', 'legal/disclaimers/nflst/_nflst-free.html') ); ?></div>

                            </li>

                        <? } ?>

                        <li class="package-card__plan-features-list-item">Standard professional Installation</li>
                        <li class="package-card__plan-features-list-item">Includes a Genie<sup>&reg;</sup> HD DVR upgrade</li>

                    </ul><!-- /.package-card__plan-features-list -->

                </div><!-- /.package-card__plan-features -->

            </div><!-- /.package-card__additional-info -->

            <div class="package-card__cta">

                <a class="package-card__cta-toggle js-package-card__cta-toggle">View Plan Details</a>
                <div class="package-card__cta-button button button--secondary js-track" data-tracker='<?php echo rv_tracker_attrs($trackPage, ucfirst($packageTracking), "get plan" ); ?>'><span class="h-phone" data-c2c-parent="button">Get this plan</span></div>

            </div><!-- /.package-card__cta -->

        </div><!-- /.columns -->

    </div><!-- /.row -->

</div><!-- .package-card -->