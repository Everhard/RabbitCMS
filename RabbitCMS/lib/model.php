<?php
class Database {
	public static function connect() {
		self::$DBH = new SQLite3("rabbitcms.sqlite");
	}
        
        // Get user template file:
        public static function get_user_template_file($url) {
            if ($url != "_frontpage_") {
                if (!$url) $url = "_frontpage_";
                $page_result = self::$DBH->query("SELECT template FROM pages WHERE url='$url'");
                if ($page_array = $page_result->fetchArray()) {
                    return $page_array['template'];
                }
            }
            return false;
        }

	// Get pages:
	public static function get_pages() {
            $pages_result = self::$DBH->query("SELECT * FROM pages");
            if ($pages_result) {
                $pages = array();
                while ($page_array = $pages_result->fetchArray()) {
                    $pages[] = new Page($page_array);
                }
                return $pages;
            }
            return false;
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
        
	public static function delete_page($id) {
		$operation_result = self::$DBH->query("DELETE FROM pages WHERE id='$id'");
		if ($operation_result) return true;
		return false;
	}
        
        // Get menus:
	public static function get_menus() {
            $menus_result = self::$DBH->query("SELECT * FROM menus");
            if ($menus_result) {
                $menus = array();
                while ($menu_array = $menus_result->fetchArray()) {
                    $menus[] = new Menu($menu_array);
                }
                return $menus;
            }
            return false;
	}
        
	// Get menu:
	public static function get_menu($id) {
            $menu_result = self::$DBH->query("SELECT * FROM menus WHERE id='$id'");
            if ($menu_array = $menu_result->fetchArray()) {
                return $menu_array;
            }
            return false;
	}
        
        // Add menu:
	public static function add_menu($menu) {
		$menu_result = self::$DBH->query("INSERT INTO menus (tag, name) VALUES (
                         '".$menu->get_tag()."',
                         '".$menu->get_name()."'
                )");
		if ($menu_result) return true;
		return false;
	}
        
        // Delete menu:
	public static function delete_menu($id) {
		$operation_result1 = self::$DBH->query("DELETE FROM menus WHERE id='$id'");
                $operation_result2 = self::$DBH->query("DELETE FROM menuitems WHERE menu_id='$id'");
		if ($operation_result1 && $operation_result2) return true;
		return false;
	}
        
	// Get menu items:
	public static function get_menu_items($menu_id) {
            $items_result = self::$DBH->query("SELECT * FROM menuitems WHERE menu_id='$menu_id'");
            if ($items_result) {
                $items = array();
                while ($item_array = $items_result->fetchArray()) {
                    $items[] = new MenuItem($item_array);
                }
                return $items;
            }
            return false;
	}
        
        // Add menu item:
        public static function add_menu_item($menu_item) {
            $item_result = self::$DBH->query("INSERT INTO menuitems (menu_id, name, url) VALUES (
                         '".$menu_item->get_menu_id()."',
                         '".$menu_item->get_name()."',
                         '".$menu_item->get_url()."'
                )");
            if ($item_result) return true;
            return false;
        }
        
        // Delete menu item:
	public static function delete_menu_item($id) {
		$operation_result = self::$DBH->query("DELETE FROM menuitems WHERE id='$id'");
		if ($operation_result) return true;
		return false;
	}
	
	private static $DBH;
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

class Menu {
    
    function __construct($database_array = false) {
        if ($database_array) {
            $this->array_to_menu_fields($database_array);
        }
    }
    
    public function load_by_id($id) {
        if ($menu_array = Database::get_menu($id)) {
            $this->array_to_menu_fields($menu_array);
            return true;    
        }
        return false;
    }
    
    public function get_items() {
        return Database::get_menu_items($this->id);
    }
    
    public function get_id() {
        return $this->id;
    }
    
    public function get_tag() {
        return $this->tag;
    }
    
    public function get_name() {
        return $this->name;
    }
    
    private function array_to_menu_fields($database_array) {
        $this->id = $database_array['id'];
        $this->tag = $database_array['tag'];
        $this->name = $database_array['name'];
    }
    
    private $id;
    private $tag;
    private $name;
}

class MenuItem {
    function __construct($database_array) {
        $this->id = $database_array['id'];
        $this->menu_id = $database_array['menu_id'];
        $this->name = $database_array['name'];
        $this->url = $database_array['url'];
    }
    
    public function get_id() {
        return $this->id;
    }
    
    public function get_menu_id() {
        return $this->menu_id;
    }
    
    public function get_name() {
        return $this->name;
    }
    
    public function get_url() {
        return $this->url;
    }
    
    private $id;
    private $menu_id;
    private $name;
    private $url;
}

class URLRouter {
	function __construct() {
		// Removing first character "/":
		$this->uri_string = substr($_SERVER['REQUEST_URI'], 1);
		$this->uri_array = explode("/", $this->uri_string);
		$this->parts_count = count($this->uri_array);
	}

	public function get_uri_string() {
		return $this->uri_string;
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