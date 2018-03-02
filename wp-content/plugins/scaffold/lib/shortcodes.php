<?php

/**
 * Shortcode management
 */
class scaffold_shortcodes {

	public function bind() {
		add_shortcode("scaffold-test", array(&$this, "test"));
	}

	public function test($args, $content = "", $tag = "") {
		$core = scaffold_core::instance();
		$defaults = array(
			"test-var-1" => "Test Variable #1",
			"test2" => "Test Variable #2",
		);
		$data = shortcode_atts($defaults, $args);
		return $core->templates->render("shortcodes/test.php", $data);
	}

}