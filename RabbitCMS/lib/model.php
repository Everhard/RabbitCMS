<?php
class Database {
	public static function connect() {
		self::$DBH = new SQLite3("rabbitcms.sqlite");
	}
	
	// Get pages:
	public static function get_pages() {
		$pages_result = self::$DBH->query("SELECT * FROM pages");
		while ($page_array = $pages_result->fetchArray()) {
			$pages[] = new Page($page_array);
		}
		return $pages;
	}
	
	private static $DBH;
}

class Page {
	function __construct($database_array) {
		$this->id = $database_array['id'];
		$this->url = $database_array['url'];
		$this->title = $database_array['title'];
		$this->text = $database_array['text'];
	}
	
	public function get_id() {
		return $this->id;
	}
	
	public function get_url() {
		return $this->url;
	}
	
	public function get_title() {
		return $this->title;
	}
	
	public function get_text() {
		return $this->text;
	}
	
	private $id;
	private $url;
	private $title;
	private $text;
}

class URLRouter {
	function __construct() {
		// Removing first character "/":
		$this->uri_string = substr($_SERVER['REQUEST_URI'], 1);
		$this->uri_array = explode("/", $this->uri_string);
		$this->parts_count = count($this->uri_array);
	}

	public function get_uri() {
		return $this->uri;
	}
	
	public function get_parts_count() {
		return $this->parts_count;
	}
	
	public function get_uri_array() {
		return $this->uri_array;
	}

	private $uri_string;
	private $uri_array;
	private $parts_count;
}
?>