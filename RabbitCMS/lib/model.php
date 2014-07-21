<?php
defined('_RabbitCMS') or die('Restricted access');

class Database {
	public static function connect() {
                if (!file_exists("rabbitcms.sqlite")) {
                    exit("Please install RabbitCMS first!");
                }
		self::$DBH = new SQLite3("rabbitcms.sqlite");
	}
        
        // Get user template file:
        public static function get_page_by_url($url) {
            if ($url != "_frontpage_") {
                if (!$url) $url = "_frontpage_";
                $page_result = self::$DBH->query("SELECT * FROM pages WHERE url='$url'");
                if ($page_array = $page_result->fetchArray()) {
                    return new Page($page_array);
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
                $stmt = self::$DBH->prepare("UPDATE pages SET url=:url, title=:title, text=:text, template=:template WHERE id=:id");
                $stmt->bindValue(':id', $page->get_id());
                $stmt->bindValue(':url', $page->get_url());
                $stmt->bindValue(':title', $page->get_title());
                $stmt->bindValue(':text', $page->get_text());
                $stmt->bindValue(':template', $page->get_template());
                $page_result = $stmt->execute();
		if ($page_result) return true;
		return false;
	}

	public static function add_page($page) {
		$stmt = self::$DBH->prepare("INSERT INTO pages (url, title, text, template) VALUES (:url,:title,:text,:template)");
                $stmt->bindValue(':url', $page->get_url());
                $stmt->bindValue(':title', $page->get_title());
                $stmt->bindValue(':text', $page->get_text());
                $stmt->bindValue(':template', $page->get_template());
                $page_result = $stmt->execute();
		if ($page_result) return true;
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
        
	// Get menu:
	public static function get_menu_by_tag($tag) {
            $menu_result = self::$DBH->query("SELECT * FROM menus WHERE tag='$tag'");
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
        
        // Get admin password hash:
        public static function get_admin_password_hash() {
            $password_result = self::$DBH->query("SELECT field_value FROM settings WHERE field_name='password_hash'");
            if ($password_array = $password_result->fetchArray()) {
                return $password_array['field_value'];
            }
            return false;
        }
        
        public static function put_journal_message($message, $ip, $browser) {
            $stmt = self::$DBH->prepare("INSERT INTO journal (message, ip, browser, time) VALUES (:message,:ip,:browser,:time)");
            $stmt->bindValue(':message', $message);
            $stmt->bindValue(':ip', $ip);
            $stmt->bindValue(':browser', $browser);
            $stmt->bindValue(':time', time());
            $insert_result = $stmt->execute();
            if ($insert_result) return true;
            return false;
        }
        
        public static function get_journal_records() {
            $stmt = self::$DBH->prepare("SELECT * FROM journal ORDER BY time DESC");
            $records_result = $stmt->execute();
            $records = array();
            while ($record_array = $records_result->fetchArray(SQLITE3_ASSOC)){ 
                $records[] = new JournalRecord($record_array);
            }
            return $records;
        }
        
        public static function clear_journal() {
            $stmt = self::$DBH->prepare("DELETE FROM journal");
            return $stmt->execute();
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
        
	public function get_template() {
		return $this->template;
	}
        
        private function array_to_page_fields($database_array) {
            $this->id = $database_array['id'];
            $this->url = $database_array['url'];
            $this->title = $database_array['title'];
            $this->text = stripslashes($database_array['text']);
            $this->template = $database_array['template'];
	}
	
	private $id;
	private $url;
	private $title;
	private $text;
        private $template;
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
    
    public function load_by_tag($tag) {
        if ($menu_array = Database::get_menu_by_tag($tag)) {
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

class HTMLMenu {
    public static function show($tag) {
        
        // Get menu:
        $menu = new Menu;
        $menu->load_by_tag($tag);
        $items = $menu->get_items();
        
        // Form HTML:
        foreach ($items as $item) {
            echo "<li><a href='".$item->get_url()."'>".$item->get_name()."</a></li>\n";
        }
        
    }
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

class Authorization {
    function __construct() {
        // Check in session:
        if (!empty($_SESSION['passhash'])) {
            $this->passhash = trim($_SESSION['passhash']);
            if ($this->check()) {
                $this->is_admin = true;
            }
        }
        // Check in POST data:
        if (!empty($_POST['password'])) {
            $this->passhash = md5(trim($_POST['password']));
            if ($this->check()) {
                $this->is_admin = true;
                $this->save_session();
                // Redirect:
                header("Location: /rabbit-control");
                exit("Redirecting to main admin page...");
            }
        }
        return false;
    }
    
    public function is_admin() {
        return $this->is_admin;
    }
    
    private function check() {
        if ($this->passhash == Database::get_admin_password_hash()) {
            return true;
        }
        return false;
    }
    
    private function save_session() {
        $_SESSION['passhash'] = $this->passhash;
    }
    
    private $passhash;
    private $is_admin = false;
}

class Journal {
    public static function log_404() {
        $message = "Page not found: $_SERVER[REQUEST_URI]";
        $ip = $_SERVER['REMOTE_ADDR'];
        $browser = $_SERVER['HTTP_USER_AGENT'];
        Database::put_journal_message($message, $ip, $browser);
    }
    
    public static function get_records() {
        return Database::get_journal_records();
    }
}

class JournalRecord {
    
    function __construct($data) {
        if (is_array($data)) {
            $this->array_to_object_fields($data);
        }
    }
    
    private function array_to_object_fields($data_array) {
        $this->id = $data_array['id'];
        $this->message = $data_array['message'];
        $this->ip = $data_array['ip'];
        $this->browser = $data_array['browser'];
        $this->time = $data_array['time'];
    }
    
    public function get_id() {
        return $this->id;
    }
    
    public function get_message() {
        return $this->message;
    }
    
    public function get_ip() {
        return $this->ip;
    }
    
    public function get_browser() {
        return $this->browser;
    }
    
    public function get_time() {
        return $this->time;
    }

    private $id;
    private $message;
    private $ip;
    private $browser;
    private $time;
}
?>