<?php

define( 'LUMI_CORE_PATH', get_template_directory() . '/core/' );
define( 'LUMI_CSS_JS_VER', 1 );
define( 'LUMI_TEXTDOMAIN', 'textdomain' );


/**
 * Var containing references to all theme objects
 * @var array $lumi array with all classes used in template, by namespace
 *      $lumi['Glob'|'Admin'|'Frontend'][class_name]
 */
$lumi = array();
global $lumi;


/**
 * Classes autoloading
 * Will load files in core directory absed on their suffix
 *      .glob.php will be loaded everytime
 *      .admin.php will be loaded in admin (is_admin())
 *      .frontend.php will be loaded when not in admin (even logged in)
 */
$core['Glob'] = glob( LUMI_CORE_PATH . '*.glob.php' );
if( is_admin() ) {
	$core['Admin'] = glob( LUMI_CORE_PATH . '*.admin.php' );
} else {
	$core['Frontend'] = glob( LUMI_CORE_PATH . '*.frontend.php' );
}
foreach( $core as $scope => $files ) {
	if( $files !== false ) {
		foreach( $files as $file ) {
			include_once $file;
			$class_name = basename( $file, '.' . strtolower($scope) . '.php' );
			$class_path = '\\Lumi\\' . $scope . '\\' . $class_name;
			$lumi[$scope][strtolower($class_name)] = new $class_path;
		}
	}
}

/**
 * Template classes loading
 * Those contain functions used in templates - which are loaded on demand to save mem
 * Will return reference to class, which can contain your functions. It will load the class, if it's not loaded yet.
 * @var string $name
 * @return \Lumi\Template\Reviews
 */
function lumi_template($name) {
	if( empty( $name ) ) {
		return false;
	}

	if( isset( $lumi['Template'][$name] ) ) {
		return $lumi['Template'][$name]; //If template functions are already loaded
	}

	include_once LUMI_CORE_PATH . $name . '.template.php';
	$class_name = '\\Lumi\\Template\\' . $name;
	$lumi['Template'][$name] = new $class_name;
	return $lumi['Template'][$name];
}

