<?php
namespace TSJIPPY\PAGEGALLERY;
use TSJIPPY;

add_action( 'rest_api_init', __NAMESPACE__.'\blockRestApi' );
function blockRestApi() {

	// show page gallery
	register_rest_route(
		RESTAPIPREFIX.'/pagegallery',
		'/show_page_gallery',
		array(
			'methods' 				=> 'POST',
			'callback' 				=> __NAMESPACE__.'\pageGalleryBlock',
			'permission_callback' 	=> '__return_true', // Allow non-logged in users to access this endpoint
		)
	);
}

/**
 * Displays the page gallery based on the provided request parameters.
 *
 * @param \WP_REST_Request $wpRestRequest The REST request object.
 * @return array The page gallery data.
 */
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
add_filter('tsjippy_allowed_rest_api_urls', __NAMESPACE__.'\restApiUrls');
/**
 * Adds the page gallery URLs to the list of allowed REST API URLs.
 *
 * @param array $urls The list of allowed REST API URLs.
 * @return array The updated list of allowed REST API URLs.
 */
function restApiUrls($urls){
	$urls[]		= RESTAPIPREFIX.'/pagegallery/show_page_gallery';

	return $urls;
}