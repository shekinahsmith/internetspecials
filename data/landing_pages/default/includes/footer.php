<footer>
	<div class="row">
		<div class="grid-16">

			<div class="legal">
				<? include(RV_LandingPage::find('includes/legal/_legal-footer-global.php')); ?>

				<? if ($_SERVER['SCRIPT_URL'] == '/small-business.html') {

					include( RV_Web_SharedInclude::include_shared_file('att', 'footer_legal_business.html') );

				} else {

					include( RV_Web_SharedInclude::include_shared_file('att', 'footer_legal.html') );

				} ?>

			</div>

			<a href="/" class="logo-tie">The Internet Experts</a>

			<nav role="navigation" class="footer-nav">
				<ul>
					<li><a href="/">Home</a></li>
					<li><a href="/plans.html">Plans & Pricing</a></li>
					<li><a href="/u-verse-internet.html">AT&T Internet</a></li>
					<li><a href="/u-verse-phone.html">AT&T Phone</a></li>
					<li><a href="/bundles.html">Bundles</a></li>
					<li><a href="/contact.html">Contact</a></li>
					<li><a href="/order.html">Order AT&T</a></li>
				</ul>
			</nav>
			<!-- END .footer-nav -->

			<ul class="legal-nav">
				<li><a href="/terms.html">Offer Details</a></li>
				<li><a href="/terms-conditions.html">Terms & Conditions</a></li>
				<li><a href="/ada-notice.html">ADA Notice</a></li>
				<li><a href="/directv-full-offer-legal.html">DIRECTV Terms &amp; Conditions</a></li>
				<li><a href="/privacy-policy.html">Privacy Policy</a></li>
			</ul>


		</div>
		<!-- END .grid-16 -->
	</div>
	<!-- END .row -->
</footer>
<!-- END footer -->

<? include_once(RV_LandingPage::find('includes/_footer_assets.html')); ?>
<? include_once(RV_LandingPage::find('includes/_footer_assets_additional.html')); ?>

<?
	// CHAT - include if CHAT is in the experience name
	if ($hasChat) {
		include_once(RV_LandingPage::find('includes/articulate/chat/_articulate-init.php'));
	}

	// SMS - include if SMS is in the experience name
	if ($hasSMS) {
		include_once(RV_LandingPage::find('includes/articulate/sms/_articulate-init.php'));
	}

?>


<? include_once(BASE_INCLUDE_DIR . 'pix3lator_core.inc'); ?>
<? require_once(BASE_INCLUDE_DIR . 'debug_footer.inc'); ?>

<!-- Mobile C2C Fix Script -->
<script type="text/javascript" src="/global_js/mobile-c2c.js"></script>

</body>
</html>
