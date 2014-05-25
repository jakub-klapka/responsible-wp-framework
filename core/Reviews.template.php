<?php


namespace Lumi\Template;

/**
 * Class Reviews
 * This part of Reviews classes will contain functions, that are needed only on some specific pages.
 * Those will be accesed by calling lumi_template('Reviews'). There is no need to load those on every pageload.
 * @package Lumi\Frontend
 */
class Reviews {

	public function enqueue_review_style() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_review_style_callback' ) );
	}

	public function enqueue_review_style_callback() {
		wp_enqueue_style( 'reviews' );
	}

	public function generate_reviews() {
		/**
		 * Code to generate output or any other functions, we might need to run in template file
		 */

		$gallery = get_field( 'gallery' );

		if ( empty( $gallery ) ) {
			return '';
		}

		$ids = array_map( function ( $item ) {
			return $item['id'];
		}, $gallery );

		return do_shortcode( '[gallery columns="5" link="file" ids="' . implode( ', ', $ids ) . '"]' );
	}

} 