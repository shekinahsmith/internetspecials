<div class="modal modal--address-check js-modal js-modal--address-check" data-modal="address-check" data-modal-autopop>
	<div class="address-check">
		<div class="row">
			<div class="small-12 columns">
				<form-wizard color="#5a5a5a" title="" subtitle="" ref="addressCheck">
					<transition name="fade" v-cloak>
						<tab-content>
							<div class="address-check__tab-wrapper">
								<div class="row">
									<div class="small-10 small-centered columns">
										<h1 class="address-check__headline address-check__headline--zip-check">Let's see if AT&T is available at your home.</h1>
										<p>First, enter the zip code where you'd like service.</p>
										<div class="input-group">
											<input
												class="form-input"
												type="text"
												pattern="\d*"
												id="zip"
												name="zip"
                                                v-model.lazy="zip"
												@blur=$v.zip.$touch
												:class="{error: $v.zip.$error, valid: $v.zip.$dirty && !$v.zip.$invalid}"
												data-autocomplete="zip" required>
											<label for="zip">Enter Zip Code</label>
										</div>
										<button class="button button--tertiary button--block" v-on:click="zipCheckHandler">Continue</button>
									</div><!-- .columns -->
								</div><!-- /.row -->
							</div><!-- /.address-check__tab-wrapper -->

                            <div class="tab-content__link"><a href="/customer-support.html" v-on:click="trackingExistingCustomers">Already have AT&T service?</a></div>

						</tab-content><!-- /tab-content(zip-check) -->
					</transition>
					<transition name="fade" v-cloak>
						<tab-content>
							<div class="address-check__tab-wrapper">
								<div class="row">
									<div class="small-10 small-centered columns ">
										<h1 class="address-check__headline address-check__headline--full-address">Thanks! Next, enter your address.</h1>
										<p class="address-check__zip-check-result">{{city}}, {{state}} {{zip}}</p>
										<div class="address-check__zip-change" v-on:click="changeZipHandler">Change</div>
										<form method="post" name="addressCheckForm" id="addressCheckForm">
											<input type="hidden" id="city" ref="city" v-model="city">
											<input type="hidden" id="state" ref="state" v-model="state">
											<div class="input-group">
												<input
													class="form-input"
													type="text"
													name="street"
													id="street"
													ref="street"
													@blur="street = (street ? street : $event.target.value)"
													@input="$v.street.$touch"
													:class="{error: $v.street.$error, valid: $v.street.$dirty && !$v.street.$invalid}"
													data-autocomplete="street"
													required>
												<label for="street">Street Address</label>
											</div><!-- /.input-group -->
											<div class="input-group">
												<input
													class="form-input"
													type="checkbox"
													id="unitType"
													name="unitType"
													v-model="unitType"
													v-on:change="trackingAptCheck"
												>
												<label for="unitType">Apt</label>
											</div><!-- /.input-group -->
											<div class="input-group input-group__unit-value" v-show="unitNumberShow">
												<input
													class="form-input form-input__unit-value"
													name="unitValue"
													id="unitValue"
													v-model="unit"
													@input="$v.unit.$touch"
													@blur="unit = (unit ? unit : $event.target.value)"
													:class="{error: unitNumberShow && $v.unit.$error, valid: $v.unit.$dirty && !$v.unit.$invalid}">
												<label for="unitValue">Unit #</label>
											</div><!-- /.input-group -->
										</form>
										<button class="button button--tertiary button--block" v-on:click="serviceabilityCheckHandler">Continue</button>
									</div><!-- .columns -->
								</div><!-- /.row -->
							</div><!-- /.address-check__tab-wrapper -->
							<div class="loader-overlay" v-show="loaderShow">
								<ul class="loader-overlay__circles">
									<li class="circle circle-1"></li>
									<li class="circle circle-2"></li>
									<li class="circle circle-3"></li>
								</ul>
								<div class="loader-overlay__headline">Just one second</div>
                                <div class="loader-overlay__tagline">Finding AT&T offers for:<br><span class="tagline--address js-tagline--address">{{city}}, {{state}} {{zip}}</span></div>

							</div><!--- /.loader -->
						</tab-content><!-- /tab-content(address-check) -->
					</transition>
					<transition name="fade" v-cloak>
						<tab-content>
							<div class="address-check__tab-wrapper">
								<div class="row">
									<div class="small-10 small-centered columns ">
										<? // SERVICEABLE MESSAGE ?>

                                        <h1 class="address-check__headline address-check__headline--serviceable" v-show="isServiceable">Congrats!<br>AT&T Internet is available in your area.</h1>

										<p v-show="isServiceable">What are you shopping for today?</p>
										<div class="quick-links" v-show="isServiceable">
											<ul class="quick-links__list">
												<li class="quick-links__list-item">
													<a href="/internet.html" v-on:click="trackingInternet">
														<div class="quick-links__image">
															<svg class="icon icon-linear--laptop" width="36" height="36" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
																<title>icon-linear/laptop</title>
																<path d="M27.038 21.86v-9.661c0-.604-.491-1.095-1.095-1.095H10.1c-.604 0-1.095.49-1.095 1.095v5.842a.375.375 0 0 0 .75 0v-5.842c0-.19.155-.345.345-.345h15.842c.19 0 .345.155.345.345v9.66c0 .19-.155.346-.345.346H10.1a.375.375 0 0 0 0 .75h15.842c.604 0 1.095-.491 1.095-1.095zm5.255 3.246a.705.705 0 0 0-.705-.705H4.455a.706.706 0 0 0-.705.705v.52c0 .388.317.705.705.705h27.133a.706.706 0 0 0 .705-.705v-.52zm-24.8-1.455H28.55V11.416c0-.918-.748-1.666-1.667-1.666H9.159c-.918 0-1.665.748-1.665 1.666V23.65zm25.55 1.455v.52c0 .802-.652 1.455-1.455 1.455H4.455A1.457 1.457 0 0 1 3 25.626v-.52c0-.802.653-1.455 1.455-1.455h2.289V11.416A2.419 2.419 0 0 1 9.159 9h17.723a2.42 2.42 0 0 1 2.417 2.416V23.65h2.289c.803 0 1.455.653 1.455 1.455zm-13.296.704h-3.451a.375.375 0 0 1 0-.75h3.45a.375.375 0 0 1 0 .75z" fill="#009FDB" fill-rule="evenodd"/>
															</svg>
														</div>
														Internet
													</a>
												</li>
												<li class="quick-links__list-item">
													<a href="/bundles.html" v-on:click="trackingBundles">
														<div class="quick-links__image">
															<svg class="icon icon-linear--tv-laptop" width="36" height="36" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
																<title>icon-linear/tv-laptop</title>
																<defs>
																	<path id="a" d="M32.871 18.132V.015H.001v18.117h32.87z"/>
																</defs>
																<g fill="none" fill-rule="evenodd">
																	<g transform="translate(2 8.34)">
																		<mask id="b" fill="#fff">
																			<use xlink:href="#a"/>
																		</mask>
																		<path d="M31.971 16.123h-1.229V9.522c0-.765-.649-1.386-1.447-1.386h-8.796V.956c0-.519-.442-.941-.985-.941H.984C.44.015 0 .437 0 .957v12.51c0 .52.441.943.983.943h8.99v1.656H5.994a.272.272 0 0 0-.277.266c0 .146.125.265.277.265h8.508c.154 0 .278-.119.278-.265a.272.272 0 0 0-.278-.266h-3.977V14.41h7.246v1.713h-1.229c-.496 0-.9.387-.9.863v.283c0 .476.404.863.9.863h15.428c.496 0 .9-.387.9-.863v-.283c0-.476-.404-.863-.9-.863zm-2.676-7.44c.483 0 .876.376.876.839v6.601H18.344V9.522c0-.463.392-.839.874-.839h10.077zM.983 13.88a.42.42 0 0 1-.43-.412V.957a.42.42 0 0 1 .43-.41h18.53c.238 0 .432.183.432.41v7.179h-.727c-.09 0-.177.01-.262.025V2.149a.622.622 0 0 0-.632-.607H2.174c-.349 0-.631.27-.631.604v6.617c0 .147.123.266.277.266.152 0 .276-.12.276-.266V2.146c0-.04.034-.074.077-.074h16.152c.043 0 .078.034.078.074v6.232c-.38.25-.63.67-.63 1.144v2.693H3.602a.271.271 0 0 0-.277.265c0 .146.125.265.277.265h14.17v1.134H.982zm31.317 3.39a.322.322 0 0 1-.329.315H16.543a.322.322 0 0 1-.328-.315v-.283c0-.174.147-.315.328-.315h15.428c.181 0 .329.14.329.315v.283z" fill="#009FDB" mask="url(#b)"/>
																	</g>
																	<path d="M21.058 21.475a.28.28 0 0 0 .286.274.28.28 0 0 0 .286-.274v-3.186c0-.065.055-.118.124-.118h9.008c.068 0 .123.053.123.118v4.932a.121.121 0 0 1-.123.119h-9.008a.28.28 0 0 0-.286.274c0 .15.128.273.286.273h9.008c.383 0 .694-.299.694-.666V18.29c0-.367-.311-.666-.694-.666h-9.008c-.384 0-.696.3-.696.666v3.186zM27.044 25.251h-1.62a.231.231 0 0 0-.237.226c0 .125.106.226.237.226h1.62c.13 0 .236-.101.236-.226a.231.231 0 0 0-.236-.226" fill="#009FDB"/>
																</g>
															</svg>
														</div>
														Bundles
													</a>
												</li>
											</ul><!-- /.quick-links__list -->
										</div><!-- /.quick-links -->
										<? // UNSERVICEABLE MESSAGE ?>
										<h1 class="address-check__headline address-check__headline--serviceable" v-show="!isServiceable">Congrats!<br>Internet is available in your area.
										</h1>
										<p v-show="!isServiceable">Speak with an internet expert to go over your options and find the best deal.</p>
										<p class="address-check__phone" v-show="!isServiceable"><span class="h-phone" data-c2c-parent="address-check__phone"><?= $sitePhone; ?></span></p>
									</div><!-- /.columns -->
								</div><!-- /.row -->
							</div><!-- /.address-check__tab-wrapper -->
							<div class="tab-content__link tab-content__link--help">
								<a href="/help.html" v-on:click="trackingPkgPicker">Need help picking your package?</a>
							</div>
						</tab-content><!-- /tab-content(serviceableResult) -->
					</transition>
					<div class="address-check__card js-address-check__card"></div>
				</form-wizard><!-- /.form-wizard -->
			</div><!-- /.columns -->
		</div><!-- /.row -->
	</div><!-- /.address-check -->
	<div class="modal__close js-modal-close">
		<svg class="icon icon-flat--error" width="36" height="36" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
			<title>icon-flat/error</title>
			<path d="M27.624 24.785a2 2 0 1 1-2.828 2.828l-6.687-6.685-6.694 6.694a1.994 1.994 0 0 1-1.415.586 2 2 0 0 1-1.414-3.414L15.28 18.1l-6.686-6.686a2 2 0 1 1 2.828-2.828l6.686 6.686 6.687-6.686a2 2 0 1 1 2.828 2.828L20.938 18.1l6.686 6.686z" fill="#009FDB" fill-rule="evenodd"/>
		</svg>
	</div>
</div><!-- /.modal--address-check -->