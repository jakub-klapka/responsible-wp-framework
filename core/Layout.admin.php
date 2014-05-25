<?php


namespace Lumi\Admin;

/**
 * Class Layout
 * This class will be loaded only on admin screen and can contain functions to modify layout of admin
 * @package Lumi\Admin
 */
class Layout {

	public function __construct() {

		add_filter( 'acf/options_page/settings', array( $this, 'set_options_pages' ) );

	}

	public function set_options_pages( $acf_pages ) {
		$options_page         = array(
			'title' => 'Obecná nastavení'
		);
		$acf_pages['menu']    = 'Nastavení stránek';
		$acf_pages['title']   = 'Nastavení stránek';
		$acf_pages['pages'][] = $options_page;

		return $acf_pages;
	}

} 