<?php


namespace Lumi\Glob;


class Layout {

	public function __construct() {

		/**
		 * This file can contain functions, which are needed to be loaded on every pageload
		 * and are used to define layout things, like image sizes.
		 */

		register_nav_menu( 'main_menu', __( 'Main Menu', LUMI_TEXTDOMAIN ) );

		add_image_size( 'home_slider', 940, 395, true );

	}

} 