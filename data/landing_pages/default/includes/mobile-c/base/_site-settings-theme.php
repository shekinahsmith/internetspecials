<?
	// Assign default values to variables
	global $site_settings;
	$site_settings['site_loader']['enabled'] = true;


	// Include experience config: Use this file so we can preform logic based on anything here or above
	include_once(RV_LandingPage::find($site_settings['path']['includes'] . '/base/_site-settings-experience-config.php'));

	/**
     * immediately display a template with optional parameters
     * @param  string $template         file path
     * @param  array  $params           array of parameters
     * @param  array  $site_settings    array of site setting vars global to the RVLP theme
     */
    function render_template( $template, $params = array(), $site_settings ) {
        extract($params);
        include($template);
    }

	// function to spit out rv_tracker data-track attribute
	function rv_tracker_attrs($category = '', $action = '', $label = '', $value = null) {
		return '{"category" : "' . $category . '", "action" : "' . $action . '", "label" : "' . $label . '", "value" : "' . $value . '"}';
	}

	// Button Variables
	$site_settings['buttons']['order_now_button']['href'] = '/plans-and-pricing';
	$site_settings['buttons']['order_now_button']['text'] = 'Order now';


	// Legal Footer Width
	$site_settings['legal']['footer']['width'] = 414;
	// Legal Footer colors
	$site_settings['legal']['footer']['fg'] = 0xFFFFFF;
	$site_settings['legal']['footer']['bg'] = 0x000000;


	// Get page name for hailo event names
	$urlPath = $_SERVER['SCRIPT_NAME'];
	// Get page name for hailo event names
	$urlPath = $_SERVER['SCRIPT_NAME'];
	switch($urlPath) {
		case '/index.html':
			$trackPage = 'homepage';
			$site_settings['quick_link']['enabled'] = true;
			$site_settings['quick_link']['on_page'] = array('Internet', 'Bundles');
			break;
		case '/deals.html':
			$trackPage = 'deals';
			$site_settings['quick_link']['enabled'] = true;
			$site_settings['quick_link']['on_page'] = array('Internet', 'Bundles');
			break;
		case '/why-att.html':
			$trackPage = 'why-att';
			$site_settings['quick_link']['enabled'] = true;
			$site_settings['quick_link']['on_page'] = array('Help Me Choose', 'Bundles');
			break;
		case '/directv.html':
			$trackPage = 'dtv';
			$site_settings['quick_link']['enabled'] = true;
			$site_settings['quick_link']['on_page'] = array('Help Me Choose', 'Bundles');
			break;
		case '/internet.html':
			$trackPage = 'internet';
			$site_settings['quick_link']['enabled'] = true;
			$site_settings['quick_link']['on_page'] = array('Bundles', 'Help Me Choose');
			break;
		case '/bundles.html':
			$trackPage = 'bundles';
			$site_settings['quick_link']['enabled'] = true;
			$site_settings['quick_link']['on_page'] = array('Internet', 'Help Me Choose');
			break;
		case '/customer-support.html':
			$trackPage = 'support';
			$site_settings['quick_link']['enabled'] = false;
			break;
		default:
			$trackPage = $urlPath;
			$site_settings['quick_link']['enabled'] = false;
	} // END Active Page Switch

	////
	// Quick Links
	////
	$site_settings['quick_link']['link'] = array (
		'Internet' => array (
			'img' => '<svg class="icon icon-linear--laptop" width="36" height="36" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><title>icon-linear/laptop</title><path d="M27.038 21.86v-9.661c0-.604-.491-1.095-1.095-1.095H10.1c-.604 0-1.095.49-1.095 1.095v5.842a.375.375 0 0 0 .75 0v-5.842c0-.19.155-.345.345-.345h15.842c.19 0 .345.155.345.345v9.66c0 .19-.155.346-.345.346H10.1a.375.375 0 0 0 0 .75h15.842c.604 0 1.095-.491 1.095-1.095zm5.255 3.246a.705.705 0 0 0-.705-.705H4.455a.706.706 0 0 0-.705.705v.52c0 .388.317.705.705.705h27.133a.706.706 0 0 0 .705-.705v-.52zm-24.8-1.455H28.55V11.416c0-.918-.748-1.666-1.667-1.666H9.159c-.918 0-1.665.748-1.665 1.666V23.65zm25.55 1.455v.52c0 .802-.652 1.455-1.455 1.455H4.455A1.457 1.457 0 0 1 3 25.626v-.52c0-.802.653-1.455 1.455-1.455h2.289V11.416A2.419 2.419 0 0 1 9.159 9h17.723a2.42 2.42 0 0 1 2.417 2.416V23.65h2.289c.803 0 1.455.653 1.455 1.455zm-13.296.704h-3.451a.375.375 0 0 1 0-.75h3.45a.375.375 0 0 1 0 .75z" fill="#009FDB" fill-rule="evenodd"/></svg>',
			'url' => '/internet.html',
			'tracking' => 'Internet'
		),
		'Bundles' => array (
			'img' => '<svg class="icon icon-linear--tv-laptop" width="36" height="36" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><title>icon-linear/tv-laptop</title><defs><path id="a" d="M32.871 18.132V.015H.001v18.117h32.87z"/></defs><g fill="none" fill-rule="evenodd"><g transform="translate(2 8.34)"><mask id="b" fill="#fff"><use xlink:href="#a"/></mask><path d="M31.971 16.123h-1.229V9.522c0-.765-.649-1.386-1.447-1.386h-8.796V.956c0-.519-.442-.941-.985-.941H.984C.44.015 0 .437 0 .957v12.51c0 .52.441.943.983.943h8.99v1.656H5.994a.272.272 0 0 0-.277.266c0 .146.125.265.277.265h8.508c.154 0 .278-.119.278-.265a.272.272 0 0 0-.278-.266h-3.977V14.41h7.246v1.713h-1.229c-.496 0-.9.387-.9.863v.283c0 .476.404.863.9.863h15.428c.496 0 .9-.387.9-.863v-.283c0-.476-.404-.863-.9-.863zm-2.676-7.44c.483 0 .876.376.876.839v6.601H18.344V9.522c0-.463.392-.839.874-.839h10.077zM.983 13.88a.42.42 0 0 1-.43-.412V.957a.42.42 0 0 1 .43-.41h18.53c.238 0 .432.183.432.41v7.179h-.727c-.09 0-.177.01-.262.025V2.149a.622.622 0 0 0-.632-.607H2.174c-.349 0-.631.27-.631.604v6.617c0 .147.123.266.277.266.152 0 .276-.12.276-.266V2.146c0-.04.034-.074.077-.074h16.152c.043 0 .078.034.078.074v6.232c-.38.25-.63.67-.63 1.144v2.693H3.602a.271.271 0 0 0-.277.265c0 .146.125.265.277.265h14.17v1.134H.982zm31.317 3.39a.322.322 0 0 1-.329.315H16.543a.322.322 0 0 1-.328-.315v-.283c0-.174.147-.315.328-.315h15.428c.181 0 .329.14.329.315v.283z" fill="#009FDB" mask="url(#b)"/></g><path d="M21.058 21.475a.28.28 0 0 0 .286.274.28.28 0 0 0 .286-.274v-3.186c0-.065.055-.118.124-.118h9.008c.068 0 .123.053.123.118v4.932a.121.121 0 0 1-.123.119h-9.008a.28.28 0 0 0-.286.274c0 .15.128.273.286.273h9.008c.383 0 .694-.299.694-.666V18.29c0-.367-.311-.666-.694-.666h-9.008c-.384 0-.696.3-.696.666v3.186zM27.044 25.251h-1.62a.231.231 0 0 0-.237.226c0 .125.106.226.237.226h1.62c.13 0 .236-.101.236-.226a.231.231 0 0 0-.236-.226" fill="#009FDB"/></g></svg>',
			'url' => '/bundles.html',
			'tracking' => 'Bundles'
		),
		'Help Me Choose' => array (
			'img' => '<svg class="icon icon-linear--select" width="36" height="36" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><title>icon-linear/select</title><path d="M20.208 12.524c0 .39.316.705.705.705h6.07a.705.705 0 0 0 .704-.705V6.455a.705.705 0 0 0-.705-.705h-6.069a.705.705 0 0 0-.705.705v6.07zm-.75 0V6.455c0-.802.653-1.455 1.455-1.455h6.07c.802 0 1.454.653 1.454 1.455v6.07c0 .802-.652 1.454-1.455 1.454h-6.069a1.456 1.456 0 0 1-1.455-1.455zm9.79 8.325v6.97a.375.375 0 0 1-.75 0v-6.97a1.615 1.615 0 0 0-.479-1.149 1.654 1.654 0 0 0-1.154-.474c-.613 0-1.157.338-1.44.882v1.157a.374.374 0 1 1-.75 0v-1.444l.002-.008-.002-.992a1.688 1.688 0 0 0-1.687-1.68h-.003a1.68 1.68 0 0 0-1.595 1.19v2.288a.375.375 0 0 1-.75 0V17.82a1.682 1.682 0 0 0-1.69-1.678 1.673 1.673 0 0 0-1.652 1.404l.003 2.534a.375.375 0 0 1-.75.001l-.015-12.613a1.66 1.66 0 0 0-.492-1.18 1.673 1.673 0 0 0-1.19-.495h-.005a1.686 1.686 0 0 0-1.68 1.685l.027 13.085a.374.374 0 1 1-.683.214 13.187 13.187 0 0 1-.566-.885c-.947-1.605-2.094-2.419-3.309-2.354-1.029.056-1.779.726-1.889.971.012.122.407.537.755.905.985 1.037 2.634 2.774 3.912 6.01 1.162 2.944 2.232 4.655 2.635 5.15a.375.375 0 1 1-.58.472c-.46-.563-1.559-2.323-2.753-5.346-1.224-3.102-2.81-4.772-3.758-5.77-.683-.719-1.134-1.194-.896-1.728.25-.549 1.267-1.344 2.533-1.412 1.017-.058 2.497.34 3.846 2.476l-.025-11.787a2.438 2.438 0 0 1 2.43-2.436h.001l.002.001h.001c.65 0 1.261.252 1.722.712.46.458.712 1.066.712 1.711l.01 8.584a2.42 2.42 0 0 1 1.652-.659h.005c1.088 0 2.014.721 2.325 1.71a2.437 2.437 0 0 1 1.705-.71h.005a2.44 2.44 0 0 1 2.437 2.428l.001.141c.404-.31.904-.484 1.438-.484h.006c.633 0 1.23.246 1.678.693.45.447.7 1.043.7 1.68z" fill="#00AFEB" fill-rule="evenodd"/></svg>',
			'url' => '/help.html',
			'tracking' => 'Pkg Picker'
		)

	);

	////
	// Navigation
	////

	$site_settings['navigation']['primary'] = array(
		0 => array(
			'submenu' => 'Shop',
			'links' => array(
				'AT&T Internet' => array(
					'text' => 'Internet',
					'url' => '/internet.html',
					'tracking' => 'data-tracker=\'' . rv_tracker_attrs($trackPage, 'MainNav', 'Int Plans') . '\''
				),
				'Internet + DIRECTV' => array(
					'text' => 'Internet + TV',
					'url' => '/bundles.html',
					'tracking' => 'data-tracker=\'' . rv_tracker_attrs($trackPage, 'MainNav', 'Bundles') . '\''
				),
				'DIRECTV Packages' => array(
					'text' => 'TV Packages',
					'url' => '/directv.html',
					'tracking' => 'data-tracker=\'' . rv_tracker_attrs($trackPage, 'MainNav', 'DTV Pkgs') . '\''
				),
				'Deals' => array(
					'text' => 'Deals',
					'url' => '/deals.html',
					'tracking' => 'data-tracker=\'' . rv_tracker_attrs($trackPage, 'MainNav', 'Deals') . '\''
				)
			)
		),
		1 => array(
			'submenu' => 'Discover',
			'links' => array(
				'Check Availability' => array(
					'text' => 'Check Availability',
					'url' => '#',
					'tracking' => 'data-tracker=\'' . rv_tracker_attrs($trackPage, 'MainNav', 'Check Availability') . '\''
				),
				'Help Me Choose a Plan' => array(
					'text' => 'Help Me Choose a Plan',
					'url' => '/help.html',
					'tracking' => 'data-tracker=\'' . rv_tracker_attrs($trackPage, 'MainNav', 'Pkg Picker') . '\''
				),
				'Why AT&T' => array(
					'text' => 'Why AT&T?',
					'url' => '/why-att.html',
					'tracking' => 'data-tracker=\'' . rv_tracker_attrs($trackPage, 'MainNav', 'Why ATT') . '\''
				)
			)
		)
	);

	////
	// Price Points
	////

	$site_settings['price']['internet']['default']['total'] = '30.00';
	$site_settings['price']['internet']['default']['dollars'] = '30';
	$site_settings['price']['internet']['default']['cents'] = '00';

	// AT&T variables
	$site_settings['att']['price']['total'] = '30.00';
	$site_settings['att']['price']['dollars'] = '30';
	$site_settings['att']['price']['cents'] = '00';

	////
	// Device Images and Captions
	////

	// -- MOVIE/TV IMAGES
    $site_settings['movie']['featured']['1']['image']['src'] = $site_settings['path']['assets'] . '/images/movies/movie-1.jpg';
    $site_settings['movie']['featured']['1']['image']['caption'] = '<span>Moana</span> now playing on DIRECTV CINEMA®';

    $site_settings['movie']['featured']['2']['image']['src'] = $site_settings['path']['assets'] . '/images/movies/movie-2.jpg';
    $site_settings['movie']['featured']['2']['image']['caption'] = '<span>The Jungle Book</span> now playing on DIRECTV CINEMA®';

    $site_settings['movie']['featured']['3']['image']['src'] = $site_settings['path']['assets'] . '/images/movies/movie-3.jpg';
    $site_settings['movie']['featured']['3']['image']['caption'] = '<span>The Secret Life of Pets</span> now playing on DIRECTV CINEMA®';

	$site_settings['movie']['featured']['4']['image']['src'] = $site_settings['path']['assets'] . '/images/movies/movie-4.jpg';
    $site_settings['movie']['featured']['4']['image']['caption'] = '<span>Trolls</span> now playing on DIRECTV CINEMA®';

	$site_settings['movie']['featured']['5']['image']['src'] = $site_settings['path']['assets'] . '';
    $site_settings['movie']['featured']['5']['image']['caption'] = '<span>Everest</span> now playing on DIRECTV CINEMA®';

	$site_settings['movie']['featured']['6']['image']['src'] = $site_settings['path']['assets'] . '';
    $site_settings['movie']['featured']['6']['image']['caption'] = '<span>Silicon Valley</span> now playing on HBO<sup>&reg;</sup>';

	$site_settings['movie']['featured']['7']['image']['src'] = $site_settings['path']['assets'] . '/images/movies/movie-7.jpg';
    $site_settings['movie']['featured']['7']['image']['caption'] = '<span>The Secret Life of Pets</span> now playing on HBO<sup>&reg;</sup>';

	$site_settings['movie']['featured']['8']['image']['src'] = $site_settings['path']['assets'] . '/images/movies/movie-8.jpg';
    $site_settings['movie']['featured']['8']['image']['caption'] = '<span>Finding Dory</span> now playing on DIRECTV CINEMA®';

	// -- UI Images (DTV MENUS, DTV ONLINE, ETC)
	$site_settings['ui']['featured']['1']['image']['src'] = $site_settings['path']['assets'] . '/images/devices/screens/ui-dtv-1.jpg';
    $site_settings['ui']['featured']['1']['image']['caption'] = '';

	$site_settings['ui']['featured']['2']['image']['src'] = $site_settings['path']['assets'] . '/images/devices/screens/ui-dtv-2.jpg';
    $site_settings['ui']['featured']['2']['image']['caption'] = '';

	$site_settings['ui']['featured']['3']['image']['src'] = $site_settings['path']['assets'] . '/images/devices/screens/directv-online-1.jpg';
    $site_settings['ui']['featured']['2']['image']['caption'] = '';

	//Customer service
	$site_settings['ui']['featured']['4']['image']['src'] = $site_settings['path']['assets'] . '/images/device-screens/customer-service.png';
    $site_settings['ui']['featured']['4']['image']['caption'] = '';

	////
	// Modals
	////

	$site_settings['modals']['channels']['path'] = '/modals/channels/_modal-channels.php';
	$site_settings['modals']['address_check']['path'] = '/modals/address-check/_modal-address-check.php';



	// Include experience override: Use this file to override anything above. It has last say.
	include_once(RV_LandingPage::find($site_settings['path']['includes'] . '/base/_site-settings-experience-override.php'));
?>
