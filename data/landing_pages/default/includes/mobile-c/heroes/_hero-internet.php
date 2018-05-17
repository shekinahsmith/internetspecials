<div class="hero hero--internet hero--interior">
    
    <div class="row">

        <div class="small-7 columns">

            <div class="hero__headline">Go faster with AT&T Internet</div>
            
            <div class="hero__address-check h-text-bold">

                <div class="hero__address-check-zip-code">Showing plans for <span class="js-hero__address-check-zip-code"><?= $WebLocation->postalCode == '0' ? '' : $WebLocation->postalCode; ?></span></div>
                <div class="hero__address-check-check-availability js-modal-show js-track" data-modal="address-check" data-tracker='<?= rv_tracker_attrs($trackPage, 'Hero', 'Check Availability'); ?>'>Check Availability</div>

            </div><!-- /.hero__zip-check -->

        </div><!-- /.columns -->

    </div><!-- /.row -->

    <div class="hero__image hero__image--positioned hero__image--right">

        <div class="devices hero__devices">

            <div class="device device--shadow device--laptop device--push-more">
                <img src="<?= $site_settings['path']['assets']?>/images/devices/laptop.png" alt="Laptop">

                <div class="device__screen" style="background-image: url(<?= $site_settings['movie']['featured']['7']['image']['src'];?>)"></div><!-- /.device__screen -->

            </div><!-- /.device -->

        </div><!-- /.devices -->

    </div><!-- /.hero__image -->

    <div class="legal legal--movie-caption"><?=$site_settings['movie']['featured']['7']['image']['caption']; ?></div>
    
</div><!-- /.hero--why-internet -->