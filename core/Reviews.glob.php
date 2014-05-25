<?php


namespace Lumi\Glob;

/**
 * Class Reviews
 * Classes are divided by their "area of interest", so if we have CPT "Reviews" on site,
 * it will have it's own Class files. Those can be than divided to global, admin, frontend and template files.
 * In global, we can do things like registering CPT, which is needed for admin and frontend
 * @package Lumi\Glob
 */
class Reviews {

	public function __construct() {

		add_action( 'init', array( $this, 'register_cpt' ) );

	}

	public function register_cpt() {
		register_post_type( 'reviews' );
	}

} 