<?
	/*
	 * loop through modal array and only include modals that are set in _site-settings-theme.php
	 * or overriden on an experience level. this should keep us from having to split this file
	 * to add/remove modals. instead, you will need to split _site-settings-experience-override.php
	 * and either add/remove/update modal there.
	 *
	 * @example (this would go in _site-settings-experience-override.php):
	 *
	 * ADD a new modal: $site_settings['modals']['new_key'] = '/modals/{path_to_new_modal}';
	 * REMOVE an existing modal: unset($site_settings['modals']['existing_customer'];
	 * UPDATE (uncommon) an existing modal: $site_settings['modals']['order_now'] = '/modals/order-now/order-now-NEW.php';
	 */
	foreach($site_settings['modals'] as $modal => $vals) {

		// get the path
		$path = $vals['path'];
		
		// make sure the file exists
		if ( !empty($path) ) {

			include(RV_LandingPage::find($site_settings['path']['includes'] . $path));
		}
	}
?>

<div class="modal-overlay js-modal-overlay"></div>
