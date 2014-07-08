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
        
	// Get page:
	public static function get_page($id) {
            $page_result = self::$DBH->query("SELECT * FROM pages WHERE id='$id'");
            if ($page_array = $page_result->fetchArray()) {
                return $page_array;
            }
            return false;
	}
        
	// Update page:
	public static function update_page($page) {
            $page_result = self::$DBH->query("UPDATE pages SET
                url='".$page->get_url()."',
                title='".$page->get_title()."',
                text='".$page->get_text()."'
                WHERE id='".$page->get_id()."'
            ");
            
            if ($page_result) return true;
            return false;
	}

	public static function add_page($page) {
		$pages_result = self::$DBH->query("INSERT INTO pages (url, title, text) VALUES (
                         '".$page->get_url()."',
                         '".$page->get_title()."',
                         '".$page->get_text()."'
                )");
		if ($pages_result) return true;
		return false;
	}
	
	public static $DBH;
}

class Page {
	function __construct($database_array = false) {
            
		if ($database_array) {
                    $this->array_to_page_fields($database_array);
                }
	}
        
        public function load_by_id($id) {
            if ($page_array = Database::get_page($id)) {
                $this->array_to_page_fields($page_array);
                return true;    
            }
            return false;
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
        
        private function array_to_page_fields($database_array) {
            $this->id = $database_array['id'];
            $this->url = $database_array['url'];
            $this->title = $database_array['title'];
            $this->text = $database_array['text'];
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

class Message {
    public static function put($type, $text) {
        self::$text = $text;
        self::$type = $type;
    }
    
    private static $text;
    private static $type;
}
?>
