<div class="package-card package-card--<?= $packageType; ?>">

    <div class="row collapse">

        <div class="small-12 columns">

            <div class="package-card__headline package-card__headline--<?= $packageClass; ?>"><?= $packageTitle; ?></div>

            <div class="package-card__plan-info">

                <ul class="package-card__plan-info-list">

                    <li class="package-card__plan-info-list-item package-card__plan-info-list-item--download"><?= $packageInternetSpeed; ?> max download speed</li>
                    <li class="package-card__plan-info-list-item package-card__plan-info-list-item--upload"><?= $packageUploadSpeed; ?> max upload speed</li>

                </ul><!-- /.pakcage-card__speed-list -->

            </div><!-- /.package-card__speed-info -->

            <div class="package-card__price package-card__price--<?= $packageClass; ?> <?= $packagePriceExtraWide ? 'package-card__price--extra-wide' : ''; ?>">

                <div class="price-lockup">

                    <div class="price-point">

                        <div class="price-point__dollars"><?= $packagePriceDollars; ?></div>
                        <div class="legal price-point__frequency">per mo.<br>plus taxes</div>

                    </div><!-- /.price-point -->

                </div><!-- /.price-lockup -->

            </div><!-- /.package-card__price -->

            <div class="package-card__cta">
                
                <div class="button button--secondary"><span class="h-phone" data-c2c-parent="button">Order Now</span></div>
            </div>

        </div><!-- /.columns -->

    </div><!-- /.row -->

</div><!-- .package-card -->