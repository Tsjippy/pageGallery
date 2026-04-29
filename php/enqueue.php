<?php
namespace TSJIPPY\PAGEGALLERY;
use TSJIPPY;

add_action( 'wp_enqueue_scripts', __NAMESPACE__.'\loadAssets');
function loadAssets(){
	wp_register_script('tsjippy_page_gallery_script', TSJIPPY\pathToUrl(PLUGINPATH.'js/page_gallery.min.js'), array('tsjippy_formsubmit_script'), PLUGINVERSION, true);

	wp_register_style( 'tsjippy_page_gallery_style', TSJIPPY\pathToUrl(PLUGINPATH.'css/page_gallery.min.css'), array(), PLUGINVERSION);
}