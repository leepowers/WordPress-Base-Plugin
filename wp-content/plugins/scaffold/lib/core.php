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
		// Enable CORS for all OPTIONS requests
		add_action("init", array(&$this, "cors_preflight"));
		// Bind actions and filters
		$this->hooks->bind();
		$this->shortcodes->bind();
		$this->cpt->bind();
	}

	/**
	 * Run plugin activation tasks, like dbDelta()
	 */
	public function activation_hook() {
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

	/**
	 * Output correct preflight for all OPTIONS calls. 
	 */
	public function cors_preflight() {
		if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
			status_header(200);
			$this->cors_headers();
			die;
		}
	}

	/**
	 * Output CORS headers
	 */
	public function cors_headers() {
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		header("X-Frame-Options", "SAMEORIGIN");
	}

	/**
	 * Send a simple error message JSON response
	 */
	public function json_send_error($message) {
		$response = [
			"data" => [],
			"message" => $message,
			"status" => "error",
		];
		$this->json_send_response($response);
	}

	/**
	 * Send response with correct HTTP header
	 */
	public function json_send_response($response) {
		$this->cors_headers();
		if ($response["status"] === "error") {
			status_header(200);
		} else {
			status_header(200);
		}
		wp_send_json($response);
	}

}
