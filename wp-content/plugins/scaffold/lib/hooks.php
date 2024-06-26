<?php

/**
 * General hooks for plugin.
 * For setting up WordPress actions, filters that are plugin related.
 */
class scaffold_hooks {

	/**
	 * Bind to actions and filters
	 */
	public function bind() {
		// Enqueue the very first CSS and JavaScript (such as a CSS reset)
		add_action("wp_enqueue_scripts", [&$this, "ui_resources_first"], 1);
		// Enqueue the very last CSS and JavaScript (such as any CSS to override)
		add_action("wp_enqueue_scripts", [&$this, "ui_resources_last"], PHP_INT_MAX - SCAFFOLD_UI_PRECEDENCE);
		// Enqueue admin dashboard scripts and styles last
		add_action("admin_enqueue_scripts", [&$this, "ui_admin_last"], PHP_INT_MAX - SCAFFOLD_UI_PRECEDENCE);
		// Register custom admin nav menus
		# add_action("init", [&$this, "setup_menus"]);
    // Setup image sizes
		//$this->image_sizes();
		// ACF options pages
		$this->acf_option_pages();
	}

	/**
	 * Setup first UI resources (CSS, JavaScript)
	 * - Enqueue jQuery
	 */
	public function ui_resources_first() {
		wp_enqueue_script("jquery");
	}

	/**
	 * Setup final UI resources (CSS, JavaScript)
	 * - Enqueue CSS overrides last (main plugin styles)
	 */
	public function ui_resources_last() {
		// Plugin scripts and styles
		wp_enqueue_style("scaffold", SCAFFOLD_URL_CSS . "/plugin.css", [], SCAFFOLD_VERSION);
		wp_enqueue_script("scaffold", SCAFFOLD_URL_JS . "/plugin.js", ["jquery"], SCAFFOLD_VERSION, true);
		wp_localize_script("scaffold", "ajaxurl", admin_url("admin-ajax.php"));
	}

	/**
	 * Setup final UI resources for admin dashboard. 
	 */
	public function ui_admin_last($hook = "") {
		wp_enqueue_style("scaffold", SCAFFOLD_URL_CSS . "/plugin.admin.css", [], SCAFFOLD_VERSION);
		wp_enqueue_script("scaffold", SCAFFOLD_URL_JS . "/plugin.admin.js", ["jquery"], SCAFFOLD_VERSION, true);
	}

	/**
	 * Setup custom menus
	 */
	public function setup_menus() {
		register_nav_menus([
			"primary" => __("Primary Menu", "scaffold"),
		]);
	}

	/**
	 * Setup custom image sizes
	 */
	public function image_sizes() {
		add_image_size("custom-size", 160, 160, true);
		set_post_thumbnail_size(160, 160, true);  // Default thumbnail size
	}

	/**
	 * Setup plugin ACF option pages
	 */
	public function acf_option_pages() {
		if (function_exists("acf_add_options_page")) {
			$parent = acf_add_options_page([
				"menu_slug" => "scaffold-settings",
				"page_title" => __("Scaffold Settings", "scaffold"),
				"menu_title" => __("Scaffold", "scaffold"),
			]);
			acf_add_options_sub_page([
				"menu_slug" => "scaffold-settings-general",
				"page_title" => __("SBC ME General Settings", "scaffold"),
				"menu_title" => __("General", "scaffold"),
				"parent_slug" => $parent['menu_slug'],
			]);
		}
	}

}