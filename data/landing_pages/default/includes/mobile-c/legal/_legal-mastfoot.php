<div class="mastfoot__legal">

    <?
        /*
        *   Do -NOT- test this file, split _legal-footer-experience.php
        */

        // Set the var to an empty string
        $legalFooterAdditional = '';

        // include the experience legal
        //include(RV_LandingPage::find('includes/legal/_legal-footer-experience.php'));

    ?>

    <? if ($_SERVER['SCRIPT_URL'] == '/small-business.html') {

        include( RV_Web_SharedInclude::include_shared_file('att', 'footer_legal_business.html') );

    } else {

        include( RV_Web_SharedInclude::include_shared_file('att', 'footer_legal.html') );

    } ?>

</div><!-- /.mastfoot__legal -->