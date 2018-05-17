<div class="js-modal  modal modal--address-check-two-steps" data-modal-autopop>

    <div class="modal__container js-modal-container-size modal-resize">

        <div class="js-hailo js-modal-close modal__close" data-modal="modal--address-check-three-steps" data-hailo-event="address_check_x" data-hailo-event-type="click" ></div>

        <div class="modal-content">

            <div class="steps-counter">

                <div class="steps-row">

                    <div class="step-bar pre-bar">
                        <div class="bar-mask complete"></div>
                        <!-- /.bar-mask -->
                    </div>
                    <!-- /.step-bar /.js-step-bar-1 -->

                    <div class="step-circle circle-1 active">1

                        <div class="step-label step-1"> Step 1: <br/>Enter ZIP</div>

                    </div>
                    <!-- /.step-circle /.circle-1 -->

                    <div class="step-bar js-step-bar-1">
                        <div class="bar-mask active"></div>
                        <!-- /.bar-mask -->
                    </div>
                    <!-- /.step-bar /.js-step-bar-1 -->

                    <div class="step-circle circle-2">2

                        <div class="step-label step-2">Step 2: <br/>Discover Deals</div>

                    </div>
                    <!-- /.step-circle /.circle-2 -->

                    <div class="step-bar post-bar js-step-bar-2">
                        <div class="bar-mask"></div>
                        <!-- /.bar-mask /.js-step-bar-2 -->
                    </div>
                    <!-- /.step-bar -->

                </div>
                <!-- /.steps-row -->

            </div>
            <!-- /.steps-counter -->

            <div class="main-content">

                <div class="address-check__step step-1">

                    <div class="content-box zip-code">

                        <div class="headline">Check for<br /> AT&T availability</div>
                        <div class="tagline">AT&T Internet speeds and offers vary by location. Check to see what’s available near you.</div>


                            <input class="step-one-zip js-zip-step-1" type="text" placeholder="Enter your ZIP code" required>
                            <button class="btn js-hailo js-btn-step-1" data-hailo-event="address_check_s1" data-hailo-event-type="click" >Check Availability</button>
                            <!-- /.btn -->

                            <div class="legal">Note: Your privacy is important to us. We’ll only use your information to confirm AT&T availability. Or, give us a call. <span class="h-color-orange">1-877-218-5759</span></div>
                    </div>
                    <!-- /.content-box /.existing-customer -->

                </div>
                <!-- /.address-check__step /.step-1 -->

                <div class="address-check__step step-2 is-hidden">

                    <div class="content-box">

                        <div class="headline">Enter Address</div>
                        <div class="tagline">Enter your street address for the most accurate offers. </div>
                        <!-- /.headline -->

                        <!-- START ADDRESS CHECK FORM -->
                        <section class="address-check" id="address-check">

                             <? include(RV_LandingPage::find($site_settings['path']['includes'] . '/forms/_address-check-form.php')); ?>

                            <button class="btn js-hailo js-btn-step-2" data-hailo-event="address_check_s2" data-hailo-event-type="click" >Check Availability</button>
                        </section><!-- /.address-check -->
                        <!-- END ADDRESS CHECK FORM -->


                        <div class="loader-overlay is-hidden">

                            <ul class="loader-overlay__circles">

                                <li class="circle circle-1"></li>
                                <li class="circle circle-2"></li>
                                <li class="circle circle-3"></li>

                            </ul>

                            <div class="loader-overlay__headline">Just one second</div>

                        </div><!--- /.loader -->

                        <!-- /.btn -->

                    </div>
                    <!-- /.content-box -->

                </div>
                <!-- /.address-check__step /.step-2 -->


            </div>
            <!-- /.main-content -->

                <div class="support-link is-hidden">

                    <a href="#">I just need some help! <span class="large-text">Get Support</span></a>

                </div>
                <!-- /.support-link -->

        </div>
        <!-- /.modal-content -->

    </div>
    <!-- /.modal-container -->

</div>
<!-- /modal-address-check-two-steps -->
