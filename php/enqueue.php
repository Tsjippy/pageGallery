<?php
namespace SIM\PAGEGALLERY;
use SIM;

add_action( 'wp_enqueue_scripts', function(){
	wp_register_script('sim_page_gallery_script', SIM\pathToUrl(MODULE_PATH.'js/page_gallery.min.js'), array('sim_formsubmit_script'), MODULE_VERSION, true);
});