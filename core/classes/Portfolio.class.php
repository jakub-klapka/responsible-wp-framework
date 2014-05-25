<?php


namespace Lumi\Classes;

/**
 * Class Portfolio
 * Classes are used in the very usual PHP way.
 * @package Lumi\Classes
 */
class Portfolio {

	private $id;
	private $name;

	public function __construct( $id ) {
		$this->id   = $id;
		$this->name = get_field( 'name', $id );
	}

	public function get_name() {
		return $this->name;
	}

} 