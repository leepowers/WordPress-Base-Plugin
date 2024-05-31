<?php

/**
 * Example CPT class
 */
class scaffold_cpt {

	/**
	 * Bind to WordPress
	 * - Register post type
	 */
	public function bind() {
  	add_action("init", [&$this, "post_type"]);
		add_filter("pre_get_posts", [&$this, "posts_per_page"]);
    $this->image_sizes();
  }

	/**
	 * Register CPT
	 */
	public function post_type() {
		$labels = [
			"name"               => _x( "CPTs", "post type general name", "scaffold" ),
			"singular_name"      => _x( "CPT", "post type singular name", "scaffold" ),
			"menu_name"          => _x( "CPTs", "admin menu", "scaffold" ),
			"name_admin_bar"     => _x( "CPTs", "add new on admin bar", "scaffold" ),
			"add_new"            => _x( "Add New", "cpt", "scaffold" ),
			"add_new_item"       => __( "Add New CPT", "scaffold" ),
			"new_item"           => __( "New CPT", "scaffold" ),
			"edit_item"          => __( "Edit CPT", "scaffold" ),
			"view_item"          => __( "View CPT", "scaffold" ),
			"all_items"          => __( "All CPTs", "scaffold" ),
			"search_items"       => __( "Search CPTs", "scaffold" ),
			"parent_item_colon"  => __( "Parent CPT:", "scaffold" ),
			"not_found"          => __( "No cpts found.", "scaffold" ),
			"not_found_in_trash" => __( "No cpts found in Trash.", "scaffold" )
		];
		$args = [
			"labels"             => $labels,
		  "description"        => __( "CPT custom post type.", "scaffold" ),
		  "menu_icon"			 => "dashicons-schedule",
			"public"             => true,
			"show_ui"            => true,
			"show_in_menu"       => true,
			"query_var"          => false,
			"rewrite"            => ["slug" => "cpt"],
			"capability_type"    => "post",
			"has_archive"        => false,
			"hierarchical"       => false,
			"menu_position"      => null,
			"supports"           => [ "title", "page-attributes", "editor", "thumbnail", ],
		];
    register_post_type("cpt", $args);
	  register_taxonomy("taxnomoy", "cpt", [
	    "hierarchical" => true,
			"label" => __("Taxonomy", "cpt"),
			"rewrite" => false,
			"public" => false,
			"show_ui" => true,
	  ]);
  }

	/**
	 * Load all posts when querying the post type
	 */
	public function posts_per_page($query) {
		if (!is_admin() && $query->is_main_query() && (is_post_type_archive("cpt") || is_tax("taxonomy"))) {
			$query->set("posts_per_page", -1);
		}
	}
    
	/**
	 * Define image sizes for the post type
	 */
	public function image_sizes() {
		//add_image_size("cpt-square", 250, 250, true);
		//add_image_size("cpt-square-2x", 500, 500, true);
	}

}