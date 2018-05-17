<nav class="navigation-fixed" role="navigation">

    <div class="navigation-fixed__toggle js-navigation-fixed__toggle">

        <div class="navigation-fixed__toggle-menu-icon js-navigation-fixed__toggle-menu-icon js-track" data-tracker='<?= rv_tracker_attrs($trackPage, "FootNav", "Toggle"); ?>'>

            <span></span>
            <span></span>
            <span></span>

        </div><!-- /.navigation-fixed__toggle-menu-icon -->

    </div><!-- /.navigation-fixed__toggle -->

    <div class="navigation-fixed__wrapper js-navigation-fixed__wrapper">

        <ul class="navigation-fixed__list">
            <li class="navigation-fixed__list-item navigation-fixed__list-item--availability js-modal-show js-track" data-modal="address-check" data-tracker='<?= rv_tracker_attrs($trackPage, 'FootNav', 'Check Availability'); ?>'><a href="#">
                <span>
                    <svg class="icon icon-flat--pinpoint" width="36" height="36" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><title>icon-flat/pinpoint</title><path d="M24.999 16.704a7.264 7.264 0 0 1-6.759 4.591h-.001c-4.008 0-7.264-3.235-7.264-7.221 0-3.991 3.256-7.224 7.264-7.224h.001a7.293 7.293 0 0 1 2.826.568 7.274 7.274 0 0 1 3.867 3.843 7.15 7.15 0 0 1 .066 5.443M18.24 3C12.032 3 7 8.002 7 14.169c0 3.343 1.48 6.341 3.821 8.388 0 0 1.719 1.598 2.546 2.994h.007l4.246 7.144c.11.231.339.394.62.394.274 0 .51-.163.622-.396l4.243-7.146c.831-1.392 2.552-2.99 2.552-2.99a11.106 11.106 0 0 0 3.82-8.388C29.477 8.002 24.448 3 18.24 3" fill="#009FDB" fill-rule="evenodd"/></svg><br>
                    Availability
                </span>
            </a></li>
            <li class="navigation-fixed__list-item navigation-fixed__list-item--shop"><a href="/internet.html" class="js-track" data-tracker='<?= rv_tracker_attrs($trackPage, 'FootNav', 'Shop'); ?>'>
                <span>
                    <svg class="icon icon-flat--tag" width="36" height="36" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><title>icon-flat/tag</title><defs><path id="a" d="M0 0h28.444v28.444H0V0z"/></defs><g transform="translate(4 4)" fill="none" fill-rule="evenodd"><path d="M7.493 7.494a2.646 2.646 0 0 1-3.348.326 2.65 2.65 0 1 1 3.348-4.073c.124.124.232.26.326.4a2.647 2.647 0 0 1-.326 3.347M10.728 0H.513A.513.513 0 0 0 0 .513V10.73c0 .282.162.676.362.874l16.421 16.421c.56.56 1.477.56 2.037 0l9.204-9.204c.56-.559.56-1.476 0-2.036L11.604.362c-.2-.199-.59-.362-.876-.362" fill="#00AFEB" /></g></svg><br>
                    Shop
                </span>
            </a></li>
            <li class="navigation-fixed__list-item navigation-fixed__list-item--order js-navigation-fixed__order"><a href="#" class="js-track" data-tracker='<?= rv_tracker_attrs($trackPage, 'FootNav', 'Order'); ?>'>
                <span>
                    <svg class="icon icon-flat--reciever-volume" width="36" height="36" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><title>icon-flat/reciever-volume</title><defs><path id="a" d="M26.058 28.858H0V0h26.058v28.858z"/></defs><g transform="translate(5 4)" fill="none" fill-rule="evenodd"><path d="M8.011 28.374c4.137 1.542 9.326-.69 12.043-5.396l4.322-7.486c2.604-4.51 2.104-9.853-.94-12.764-.405-.389-.457-.423-.457-.423-.492-.332-1.07-.302-1.284.07l-.39.672-2.752 4.767-.408.708c-.224.39-.075.9.334 1.136l.742.428a2.888 2.888 0 0 1 1.053 3.934l-3.546 6.142a2.888 2.888 0 0 1-3.934 1.054l-.742-.428c-.407-.236-.92-.12-1.138.258l-.396.687-2.952 5.112-.301.522c-.165.287.01.68.389.874l.357.133zm6.425-19.877a8.761 8.761 0 0 0-4.855 5.155 8.62 8.62 0 0 0-.432 4.018 1.125 1.125 0 1 0 2.23-.292c-.13-.998-.021-2 .324-2.978a6.508 6.508 0 0 1 3.606-3.83 1.124 1.124 0 0 0 .127-2.01 1.12 1.12 0 0 0-1-.063zm-1.684-4.232a13.436 13.436 0 0 0-7.427 7.895 13.172 13.172 0 0 0-.639 6.201 1.126 1.126 0 0 0 2.23-.302 10.92 10.92 0 0 1 .532-5.152 11.178 11.178 0 0 1 6.18-6.57 1.125 1.125 0 1 0-.877-2.072zm-.49-4.114a1.125 1.125 0 0 1-.167 2.027 15.165 15.165 0 0 0-8.984 9.178 15.282 15.282 0 0 0-.679 7.408 1.124 1.124 0 1 1-2.222.35 17.511 17.511 0 0 1 .78-8.503A17.408 17.408 0 0 1 11.303.072c.329-.123.677-.084.96.08z" fill="#00AFEB"/></g></svg><br>
                    Order

                    <?// button is visibility hidden to allow click to call without breaking layout ?>
                    <div class="button button--hidden js-button-call"><span class="h-phone" data-c2c-parent="js-button-call"></span></div>
                </span>
            </a></li>
            <li class="navigation-fixed__list-item navigation-fixed__list-item--explore"><a href="/bundles.html" class="js-track" data-tracker='<?= rv_tracker_attrs($trackPage, 'FootNav', 'Explore'); ?>'>
                <span>
                    <svg class="icon icon-flat--magnifying-glass" width="36" height="36" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><title>icon-flat/magnifying-glass</title><defs><path id="a" d="M0 0h25.128v25.071H0V.001z"/></defs><g transform="translate(5 5)" fill="none" fill-rule="evenodd"><path d="M15.571 3.756a5.785 5.785 0 0 1 5.778 5.778 5.785 5.785 0 0 1-5.778 5.778 5.784 5.784 0 0 1-5.778-5.778 5.784 5.784 0 0 1 5.778-5.778m6.761-.961A9.492 9.492 0 0 0 15.582 0a9.486 9.486 0 0 0-6.75 2.796 9.483 9.483 0 0 0-2.796 6.75c0 1.878.543 3.681 1.577 5.242l-7.06 7.058A1.874 1.874 0 0 0 0 23.182a1.882 1.882 0 0 0 1.889 1.889c.503 0 .977-.195 1.336-.553l7.047-7.048a9.44 9.44 0 0 0 5.31 1.622 9.484 9.484 0 0 0 6.75-2.796 9.487 9.487 0 0 0 2.796-6.75 9.49 9.49 0 0 0-2.796-6.751" fill="#00AFEB"/></g></svg><br>
                    Explore
                </span>
            </a></li>
        </ul>

    </div><!-- /.navigation-fixed__wrapper -->

</nav><!-- /.navigation-fixed -->