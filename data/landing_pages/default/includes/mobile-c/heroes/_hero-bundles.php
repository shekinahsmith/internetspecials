<div class="hero hero--bundles hero--interior">

    <div class="row">

        <div class="small-12 columns">

            <div class="devices hero__devices">

                <div class="device device--tv device--pull">
                    <img src="<?= $site_settings['path']['assets']?>/images/devices/tv.png" alt="TV">

                    <div class="device__screen" style="background-image: url(<?= $site_settings['path']['assets']; ?>/images/movies/movie-parts/siliconvalley-tv.jpg)"></div><!-- /.device__screen -->

                </div><!-- /.device -->

                <div class="devices__group devices__group--positioned devices__group--no-caption devices__group--right">

                    <div class="device device--shadow device--laptop device--push-more">
                        <img src="<?= $site_settings['path']['assets']?>/images/devices/laptop.png" alt="Laptop">

                        <div class="device__screen" style="background-image: url(<?= $site_settings['path']['assets']; ?>/images/movies/movie-parts/siliconvalley-laptop.jpg)"></div><!-- /.device__screen -->

                    </div><!-- /.device -->

                </div><!-- /.devices__group -->

                <div class="devices__group devices__group--positioned devices__group--no-caption">

                    <div class="device device--dvr device--pull-more">
                        <img src="<?= $site_settings['path']['assets']?>/images/equipment/hd-dvr.png" alt="Home DVR">
                    </div><!-- /.device--dvr -->

                </div><!-- /.devices__group -->

            </div><!-- /.devices -->

        </div><!-- /.columns -->

    </div><!-- /.row -->
    
    <div class="row">

        <div class="small-12 columns">

            <div class="hero__headline">Build your perfect bundle with DIRECTV + AT&T Internet</div>
            
            <div class="hero__address-check h-text-bold">

                <div class="hero__address-check-zip-code">Showing plans for <span class="js-hero__address-check-zip-code"><?= $WebLocation->postalCode == '0' ? '' : $WebLocation->postalCode; ?></span></div>

                <div class="hero__address-check-check-availability js-modal-show js-track" data-modal="address-check" data-tracker='<?= rv_tracker_attrs($trackPage, 'Hero', 'Check Availability'); ?>'>Check Availability</div>

            </div><!-- /.hero__zip-check -->

            <div class="legal legal--movie-caption"><?=$site_settings['movie']['featured']['6']['image']['caption']; ?></div>

        </div><!-- /.columns -->

    </div><!-- /.row -->
    
</div><!-- /.hero--why-att -->