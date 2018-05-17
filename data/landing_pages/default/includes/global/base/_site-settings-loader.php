<?
/***
 * THEME PAGE MANAGER -
 * Dev: Brian Hamlett
 * Created: 06/26/2015
 * Updated by:
 * Updated date:
 * Updated notes:
 * PURPOSE:
 * This file includes a set of processing scripts that create a simple "manifest" file that includes all URL's that are a
 * part of the active theme. This file is used as a comparison check for the page loading script below as a way to determine
 * if the currently accessed URL is: a) part of the theme and loaded normally, b) not part of the theme and auto-redirected
 * to "index.html", or not an HTML file within the domain and therefore passed to either a 404, WordPress, or Geonator.
 ***/

// Include the site settings
global $site_settings;

/***
 * SETUP FILES/PATHS -
 * These paths help us find our theme files as well as do comparison checks.
 ***/

// Setup WordPress paths - index loads WP to process the URL - wp-load initiates the WP environment
$site_settings['wordpress']['index'] = '/usr/share/www/redwpv3/data/index.php';
$site_settings['wordpress']['loader'] = '/usr/share/www/redwpv3/data/wp-load.php';

// Set the "blank" file path that RV_LP class uses. We'll use this in a comparison check.
$file_blank     = '/usr/share/www/base_includes/website/blank.php';

// Identify our manifest file
$file_manifest = 'manifest.txt';

// Let's establish a list of file extensions for the scripts used on this stei
$extensions_scripts = array('php');

// Let's get the current URL's extension to use to check if it is a script or not (minus the dot)
$extension_current_url = parse_url(substr(strrchr($_SERVER['REQUEST_URI'], '.'),1), PHP_URL_PATH);

// Let's get the absolute path to the current URL - we use substr because REQUEST_URI starts with an opening slash '/' and DOCUMENT_ROOT ends with one
// so we need to prevent the double slashes.
// We also use parse_url to strip out anything other than the file path (like query strings, hashes, etc.)
$path_current_url = $_SERVER['DOCUMENT_ROOT'] . parse_url(substr($_SERVER['REQUEST_URI'], 1), PHP_URL_PATH);

// Set the absolute folder to the theme root
$path_theme_root = $_SERVER['DOCUMENT_ROOT'] . 'landing_pages/default' . $site_settings['path']['includes'];

// Set the absolute folder path to the pages folder within the theme
$path_theme_pages = $path_theme_root . '/pages/';

// Set the absolute folder path to the manifest file within the theme
$path_theme_manifest = $path_theme_root . '/pages/' . $file_manifest;

/***
 * MANIFEST GENERATOR -
 * This script will scan the $path_theme_pages directory and create a text file with the list of each file
 * comma separated (including sub-directory structures). Essentially this creates a sitemap of all URL's
 * that are a part of this theme to be checked against by the page loader. It will run anytime a localhost
 * file is loaded so that the manifest should always be updated on your local system.
 *
 * This file is then deployed with test/production and is used to check against with the page loader.
 *
 * NOTE:    This only runs on localhost so that if a person forgets to deploy a file, this script doesn't
 *          run and therefore treat the mistake as simply not a part of the theme by updating the file to
 *          include the mistake (missing file reference).
 *
 ***/

// Only run if we're on localhost
if(ENVIRONMENT == 'localhost') {

    // Set the valid extensions for URLs (should most always be 'html')
    $extensions = array('html');

    // Init array for page URLs
    $result = array();

    // Orignally from  Michiel Brandenburg - http://php.net/manual/en/class.recursiveiteratoriterator.php
    // Reworked by Brian Hamlett - 06/26/2015
    // This is where we scan through the folder to get all the theme URL (.html) files and add them to an array
    $file_objects = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($path_theme_pages, FilesystemIterator::SKIP_DOTS),
                    RecursiveIteratorIterator::CHILD_FIRST
                );
    try {
        foreach( $file_objects as $full_file_path => $file_object ) {
            // Let's make sure it's not just a directory and that it is a file with a valid extension
            if($file_object->isFile() && in_array($file_object->getExtension(), $extensions)) {
                $result[] = str_replace($path_theme_pages, '/', $full_file_path);
            }
        }
    }
    // This will log an error if your folder permissions keep the scanner from functioning
    catch (UnexpectedValueException $e) {
        error_log(printf("_site-settings-loader.php: Directory [%s] contained a directory we can not recurse into due to permissions.", $path_theme_pages));
    }

    // Turn the array of page URLs to a comma separated string to store
    $pages = ($result) ? implode(',', $result) : '';

    // Save the results to the manifest file (Dave McClure and Brian Bachtel mentioned not minding using a txt file)

    // Create the file if doesn't exist - have to use this because the below file_put_contents doesn't auto-create a new file
    if( !file_exists($path_theme_manifest) ) {
        $path_theme_manifest = fopen($path_theme_manifest, 'w') or die("can't open file");
        fclose($path_theme_manifest);
    }

	// Open, write, and close our manifest file
	file_put_contents($path_theme_manifest, $pages, LOCK_EX);

}

/***
 * PAGE LOADER -
 * This script will check the current URL against the manifest list to see if the current URL is a
 * part of the theme. If it is, then it will load it using the standard RV find() (and thus throw an
 * error if the file is missing). If the URL is not found on the manifest list, then it considers
 * that URL as not a part of the theme and will auto-redirect to index.html using our standard
 * RV web redirect method.
 *
 * Currently any "script" is by-passed as long as it has a php extension (for things like agent queue, serviceability, etc.)
 ***/
// We check if the file actually exists within 'data' so that we know if not, we need to throw it to a 404, geonator, WP, or something else
// We also check that it isn't a processing script file (any of our script tools like agent_queue, availability_post, etc.)
if(file_exists($path_current_url) && !in_array($extension_current_url, $extensions_scripts)) {

    // First let's check to see if there is a manifest file.
    // Use RV find() so that we can throw an error if it is not found.
    $manifest = RV_LandingPage::find($site_settings['path']['includes'] . '/pages/' . $file_manifest);

    // Get the current page URL relative path to the theme - follow our typical include structure ('includes/{theme}/pages/{page}.html')
    $file_theme = $site_settings['path']['includes'] . '/pages' . $_SERVER['SCRIPT_NAME'];

    // If the file exist, let's process it; else we'll just process as usual with no auto-redirect check
    if($manifest && $manifest != $file_blank) {

        $manifest_list = file_get_contents($manifest);

        // Let's turn the list of site URL's into an array for easier comparing
        $site_urls = explode(',', $manifest_list);

        // Let's check if the current URL NOT a part of the theme and if so, auto-redirect to index.html
        if(!in_array($_SERVER['SCRIPT_NAME'], $site_urls) && !$site_settings['wordpress']['enabled']) {
            include_once(RV_Web_Redirect::as_301('index.html'));
        // Let's check to see if the URLs are stored in the new theming structure (within 'pages') and is in the manifest file.
        } elseif( file_exists( $path_theme_pages ) && in_array($_SERVER['SCRIPT_NAME'], $site_urls) ) {
            // Yup, so let's load the theme file.
            include_once( RV_LandingPage::find( $file_theme ) );
            exit; // Stop our processing here since we found a theme file
        } elseif( $site_settings['wordpress']['enabled'] ) {
            require_once($site_settings['wordpress']['loader']); // Load WP
            //require_once($site_settings['wordpress']['index']); // Send to WP
        }
    }
}
// Continue processing to RV:find() as usual (the old method)

?>
