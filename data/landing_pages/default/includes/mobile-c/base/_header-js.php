<?
	/*
	 * this include is intended only for JS files that HAVE to be loaded in the header. most JS files should be called through
	 * includes/{theme}/base/_footer-js.php OR includes/{theme}/base/_footer-assets-additional.php as to not block the rendering of the page.
	 *
	 * -- jQuery has to be called in the header because hailoJS requires it.
	 * -- the reason we recommend placing Modernizr in the head is two-fold: the HTML5 Shiv (that enables HTML5 elements in IE)
	 *	must executebefore the <body>, and if you?re using any of the CSS classes that Modernizr adds, you?ll want to prevent
	 *	  a FOUC. (referenced from modernizr.com)
	 *
	 * ------------------------------------------------------------------------------------------------------------------
	 *
	 * these are default project JS files. do not split this file to add experience specific JS files.
	 *
	 * if you need to add a new JS file for a specific experience, you should split includes/{theme}/base/_header-assets-additional.php
	 * and add your files there. this file is intended for default files, not experiences files.
	 */
?>
<script src="/global_js/jQuery/jquery-2.1.3.min.js"></script>
<script src="/global_js/modernizr/modernizr-3.3.1.min.js"></script>
