<?php
namespace SIM\PAGEGALLERY;
use SIM;

add_action( 'rest_api_init', __NAMESPACE__.'\blockRestApi' );
function blockRestApi() {

	// show page gallery
	register_rest_route(
		RESTAPIPREFIX.'/pagegallery',
		'/show_page_gallery',
		array(
			'methods' 				=> 'POST',
			'callback' 				=> __NAMESPACE__.'\pageGalleryBlock',
			'permission_callback' 	=> '__return_true',
		)
	);
}

function pageGalleryBlock($wpRestRequest){
	$params			= $wpRestRequest->get_params();

	if(!is_array($params['categories'])){
		$categories		= json_decode($params['categories'], true);
	}

	if(empty($categories)){
		$categories	= $params['categories'];
	}

	if(!is_array($params['postTypes'])){
		$postTypes		= json_decode($params['postTypes']);
	}

	if(empty($postTypes)){
		$postTypes	= $params['postTypes'];
	}

	return pageGallery($params['title'], $postTypes, $params['amount'], $categories, $params['speed'], true, $params['color']);
}

// Allow non-logged in use
add_filter('sim_allowed_rest_api_urls', __NAMESPACE__.'\restApiUrls');
function restApiUrls($urls){
	$urls[]		= RESTAPIPREFIX.'/pagegallery/show_page_gallery';

	return $urls;
}