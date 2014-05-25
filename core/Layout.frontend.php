<?php


namespace Lumi\Frontend;

use Lumi\Classes\Portfolio;

/**
 * Class Layout
 * This will be loaded on every frontend pageload
 * Can be used to register scripts and styles or other things, that are needed on whole site
 * @package Lumi\Frontend
 */
class Layout {

	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'register_enqueue_layout_scripts' ) );

		add_action( 'wp', array( $this, 'fancybox_autoload' ) );

	}

	public function register_enqueue_layout_scripts() {
		//global styles
		wp_register_style( 'pt_sans', '//fonts.googleapis.com/css?family=PT+Sans&subset=latin,latin-ext', array(), LUMI_CSS_JS_VER );
		wp_register_style( 'layout', get_template_directory_uri() . '/css/layout.css', array( 'pt_sans' ), LUMI_CSS_JS_VER );

		//global scripts
		wp_register_script( 'layout', get_template_directory_uri() . '/js/layout.js', array( 'jquery' ), LUMI_CSS_JS_VER, true );
		wp_register_script( 'fancybox', get_template_directory_uri() . '/js/fancybox.js', array( 'jquery' ), LUMI_CSS_JS_VER, true );

		//Enqueue on layout
		wp_enqueue_style( 'layout' );
		wp_enqueue_script( 'layout' );
	}

	public function fancybox_autoload() {
		global $post;
		if ( strpos( $post->post_cotent, '[gallery' ) !== false || strpos( $post->post_content, 'wp-image' ) !== false ) {
			add_action( 'wp_enqueue_scripts', function () {
				wp_enqueue_style( 'fancybox' );
				wp_enqueue_script( 'fancybox' );
			} );
		}
	}

	public function generate_recent_portfolio_list() {
		foreach ( get_field( 'portfolio', 'option' ) as $portfolio_id ) {
			$portfolio = new Portfolio( $portfolio_id );
			echo '<li>' . $portfolio->get_name() . '</li>';
		}
	}

}