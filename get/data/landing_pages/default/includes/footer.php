<footer>
	<div class="row">
		<div class="grid-16">

			<a href="/" class="logo-tie">The Internet Experts</a>

			<nav role="navigation" class="footer-nav">
				<ul>
					<li><a href="/">Home</a></li>
					<li><a href="/plans.html">Plans & Pricing</a></li>
					<li><a href="/u-verse-internet.html">U-verse Internet</a></li>
					<li><a href="/u-verse-phone.html">U-verse Phone</a></li>
					<li><a href="/bundles.html">Bundles</a></li>
					<li><a href="/contact.html">Contact</a></li>
					<li><a href="/order.html">Order AT&T</a></li>
				</ul>
			</nav>
			<!-- END .footer-nav -->

			<ul class="legal-nav">
				<li><a href="/terms.html">Offer Terms</a></li>
				<li><a href="/terms-conditions.html">Terms & Conditions</a></li>
				<li><a href="/ada-notice.html">ADA Notice</a></li>
				<li><a href="/privacy-policy.html">Privacy Policy</a></li>
			</ul>
		

			<? if ($_SERVER['SCRIPT_URL'] == '/small-business.html') { ?>
				<p class="legal">*1 year term required. Reward card requires retention of services for minimum of 60 days. Subject to availability. Additional restrictions apply. <a href="/business-terms.html">Business Offer Details</a></p>

				<p class="legal">&copy; 2014 AT&T Intellectual Property. All rights reserved. AT&T and the Globe logo are registered trademarks of AT&T Intellectual Property.  All other marks are the property of their respective owners.  Subsidiaries and affiliates of AT&T Inc. provide products and services under the AT&T brand.</p>

			<? } else { ?>
				<p class="legal">&copy; 2014 AT&T Intellectual Property. All rights reserved. AT&T and the Globe logo are registered trademarks of AT&T Intellectual Property.  All other marks are the property of their respective owners.  Subsidiaries and affiliates of AT&T Inc. provide products and services under the AT&T brand.</p>

			<? } ?>


		</div>
		<!-- END .grid-16 -->
	</div>
	<!-- END .row -->
</footer>
<!-- END footer -->

<? include_once(RV_LandingPage::find('includes/_footer_assets.html')); ?>

<? include_once(BASE_INCLUDE_DIR . 'pix3lator_core.inc'); ?>
<? require_once(BASE_INCLUDE_DIR . 'debug_footer.inc'); ?>

<!-- Mobile C2C Fix Script -->
<script type="text/javascript" src="/global_js/mobile-c2c.js"></script>

</body>
</html>