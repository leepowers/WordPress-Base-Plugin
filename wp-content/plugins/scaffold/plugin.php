<?php
/**
 * Plugin Name: Scaffold
 * Plugin URI: http://leepowers.co/
 * Description: Custom plugin description
 * Version: 0.1.0
 * Author: Lee Powers
 * Author URI: http://leepowers.co/
 * Text Domain: scaffold
 */


/**
 * Write to PHP error log
 */
function scaffold_log() {
	$args = func_get_args();
	foreach ($args as $arg) {
		$msg = print_r($arg, true);
		error_log($msg);
	}
}

/**
 * Dump debug messages to front-end
 */
function scaffold_dump() {
	$args = func_get_args();
	foreach ($args as $arg) {
		printf("<pre>\n%s\n</pre>\n", print_r($arg, true));
	}
}

/**
 * Main code control for plugin
 */
require_once "constants.php";
require_once SCAFFOLD_LIB . "/core.php";

register_activation_hook(__FILE__, [scaffold_core::instance(), "activation_hook"]);

scaffold_core::instance()->bootstrap();

