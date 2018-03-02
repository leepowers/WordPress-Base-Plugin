<?php

/**
 * Class for template loading / rendering.
 * Used primarily for shortcodes.
 */

class scaffold_templates {

	/**
	 * Load a template file, render, and return as a string
	 * @param string $filename
	 * @param array $data
	 * @return string
	 */
	public function render($filename, array $data = null) {
		ob_start();
		$this->load($filename, $data);
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}

	/**
	 * Locate a template file.
	 * Search first in template, then in plugin template directory at SCAFFOLD_TEMPLATE_DIR
	 * @param string $filename
	 * @return string
	 */
	public function locate($filename) {
		$path = locate_template($filename);
		if ($path) {
			return $path;
		} else {
			$path = SCAFFOLD_TEMPLATE_DIR . "/$filename";
			if (is_readable($path) && is_file($path)) {
				return $path;
			}
		}
		return "";
	}

	/**
	 * Load a template file and output 
	 * @param string $filename
	 * @param array $data
	 */
	public function load($_template_filename, array $data = null) {
		$_template_path = $this->locate($_template_filename);
		if ($_template_path) {
			if ($data) {
				// Export data into the current scope
				foreach ($data as $vname => $vval) {
					$v2 = $this->variableize($vname);
					$$v2 = $vval;
				}
			}
			include($_template_path);
		} else {
			echo("Unable to locate template with filename '$_template_filename'");
		}
	}

	/**
	 * Transform a string into a safe variable name.
	 * @param string $s
	 * @return string
	 */
	public function variableize($s) {
		return preg_replace('/[^a-zA-Z0-9_]+/', '_', $s);
	}

}