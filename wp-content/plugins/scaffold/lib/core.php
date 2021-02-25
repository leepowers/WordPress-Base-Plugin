<?php

require_once SCAFFOLD_LIB . "/hooks.php";
require_once SCAFFOLD_LIB . "/shortcodes.php";
require_once SCAFFOLD_LIB . "/templates.php";
require_once SCAFFOLD_LIB . "/cpt.php";

/**
 * Core plugin functionality
 */
class scaffold_core {

	/**
	 * Single/global instance of scaffold_core
	 */
	static public $instance = null;

	/**
	 * Retrieve the singleton instance
	 */
	static public function &instance() {
		if (is_null(self::$instance)) {
			self::$instance = new scaffold_core;
		}
		return self::$instance;
	}

	/**
	 * Plugin hooks accessor
	 * @var scaffold_hooks
	 */
	public $hooks = null;

	/**
	 * Template mangement accessor
	 * @var scaffold_templates
	 */
	public $templates = null;

	/**
	 * Shortcodes mangement accessor
	 * @var scaffold_templates
	 */
	public $shortcodes = null;

	/**
	 * Custom post type
	 * @var scaffold_cpt
	 */
	public $cpt = null;

	/**
	 * Constructor.
	 * Initialize other 
	 */
	function __construct() {
		$this->hooks = new scaffold_hooks;
		$this->templates = new scaffold_templates;
		$this->shortcodes = new scaffold_shortcodes;
		$this->cpt = new scaffold_cpt;
	}
	
	/**
	 * Bootstrap / startup the theme
	 */
	public function bootstrap() {
		// Bind actions and filters
		$this->hooks->bind();
		$this->shortcodes->bind();
		$this->cpt->bind();
	}

	/**
	 * Check if current user is a site admin
	 */
	public function is_admin() {
		return current_user_can('administrator');
	}

	/**
	 * Check if current user is an editor
	 */
	public function is_editor() {
		return current_user_can('editor') || current_user_can('administrator');
	}

}
