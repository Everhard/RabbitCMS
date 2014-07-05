<?php
class View {
	function __construct() {
		$this->site_path = getcwd();
		$this->template_path = "/admin";
	}

	public function show() {
		// Include template:
		require_once($this->site_path.'/'.$this->template_file_path);
	}
	
	public function set_template_file($template_file_path) {
		$this->template_file_path = $template_file_path;
	}
	
	private $template_file_path;
	private $site_path;
	private $template_path;
}
?>