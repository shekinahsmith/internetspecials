<div class="mastfoot-quick-links" role="navigation">

    <ul class="mastfoot-quick-links__list">

    <?
        // looping through array that says what quick links are page, order determined by order listed in array in site settings
        foreach( $site_settings['quick_link']['on_page'] as $key  ) {

            // setting variable that allows access to each "quick link" array to print values on page
            $value = $site_settings['quick_link']['link'][$key];

            if( !empty($value) ) {

            ?>
                <li class="mastfoot-quick-links__list-item mastfoot-quick-links__list-item--<?= strtolower( str_replace(' ', '-', $key) ); ?> js-mastfoot-quick-links__list-item">
                    <a href=<?= $value['url']; ?> class="js-track" data-tracker='<?= rv_tracker_attrs($trackPage, 'FootShelf', $value['tracking']); ?>'>
                        <div class="mastfoot-quick-links__image"><?= $value['img'] ?></div>
                        <?= $key; ?>
                    </a>
                </li>

            <?
            }
            
        } 
    ?>

    </ul>
    
</div><!-- /.navigation--mastfoot -->