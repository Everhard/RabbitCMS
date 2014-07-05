<?php
class URLRouter {
	function __construct() {
		$this->uri = $_SERVER['REQUEST_URI'];
	}

	public function get_uri() {
		return $this->uri;
	}

	private $uri;
}
?>