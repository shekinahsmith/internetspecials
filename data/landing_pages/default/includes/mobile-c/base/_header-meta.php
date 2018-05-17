<?
	// no index for paid
	if ($_SESSION['Marketing']['ChannelID'] == 5) {
		$metaRobots = 'noindex, follow, noodp';
	}
	
    /*
     * Inject meta html tags (robots, description, keyword, canonical, title). Robots and canonical will only
     * show up if we are not on a WordPress site.
     *
     * NOTE: this include is specifically for $metaRobots, $metaDescription, $metaKeywords, $canonicalURL, $headerTitle
     * 	     if you need to add additional meta, that would go in _header-meta-additional.php
     */
	echo RV_Web_PageMeta::build_meta_tags($metaRobots, $metaDescription, $metaKeywords, $canonicalURL, $headerTitle);
?>

<? // We want the site initial scale to match the device width ?> 
<meta name="viewport" content="width=device-width, initial-scale=1">