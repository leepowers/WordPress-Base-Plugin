<?php

/**
 * Plugin constants.
 * Pluggable
 */

if (!defined("SCAFFOLD_VERSION")) {
	/**
	 * Current plugin version
	 * @var string
	 */
	define("SCAFFOLD_VERSION", "0.1.0");
}

if (!defined("SCAFFOLD_SLUG")) {
	/**
	 * Plugin slug
	 * @var string
	 */
	define("SCAFFOLD_SLUG", "scaffold");
}

if (!defined("SCAFFOLD_UI_PRECEDENCE")) {
	/**
	 * Set importance, precedence of this plugin's UI resources (JavaScript, CSS), 
	 * relative to others. Lower numbers are loaded first.
	 * Used during script/style enqueue - this number is subtracted fro PHP_INT_MAX
	 * Use to ensure plugin styles are loaded after everything else, so they can cascade (override) any other 
	 * parent plugin or plugin styles
	 * @var string
	 */
	define("SCAFFOLD_UI_PRECEDENCE", 99999);
}

if (!defined("SCAFFOLD_DIR")) {
	/**
	 * Absolute path to plugin directory
	 * @var string
	 */
	define("SCAFFOLD_DIR", untrailingslashit(__DIR__));
}

if (!defined("SCAFFOLD_LIB")) {
	/**
	 * Absolute path to plugin library directory
	 * @var string
	 */
	define("SCAFFOLD_LIB", SCAFFOLD_DIR . "/lib");
}

if (!defined("SCAFFOLD_TEMPLATE_DIR")) {
	/**
	 * Absolute path to additional templates
	 * @var string
	 */
	define("SCAFFOLD_TEMPLATE_DIR", SCAFFOLD_DIR . "/templates");
}

if (!defined("SCAFFOLD_URL")) {
	/**
	 * Absolute URL to plugin directory
	 * @var string
	 */
	define("SCAFFOLD_URL", plugins_url("", __FILE__));
}

if (!defined("SCAFFOLD_URL_CSS")) {
	/**
	 * Absolute URL to plugin CSS directory
	 * @var string
	 */
	define("SCAFFOLD_URL_CSS", SCAFFOLD_URL . "/ui/css");
}

if (!defined("SCAFFOLD_URL_JS")) {
	/**
	 * Absolute URL to plugin Javascript directory
	 * @var string
	 */
	define("SCAFFOLD_URL_JS", SCAFFOLD_URL . "/ui/js");
}

if (!defined("SCAFFOLD_URL_IMG")) {
	/**
	 * Absolute URL to plugin images directory
	 * @var string
	 */
	define("SCAFFOLD_URL_IMG", SCAFFOLD_URL . "/ui/img");
}

