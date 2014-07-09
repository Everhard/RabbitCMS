<?php
class Controller {
	public static function run() {
		self::$url_router = new URLRouter();
		self::$view = new View();
                
                Database::connect();
                
                // Make all actions:
                Action::make();
		
		// Default template:
                self::$view->set_template_folder("template");
                self::$view->set_template_file("not-found.php");
		
                // Get template by analyzing URL:
		self::get_template();
		
		// Show front side:
		self::$view->show();
	}
	
	private static function get_template() {
	
		$uri_array = self::$url_router->get_uri_array();
                
                // Checking if URL points to user page:
                if ($user_template_file = Database::get_user_template_file(self::$url_router->get_uri_string())) {
                     self::$view->set_template_file($user_template_file);
                }
                
		
                // Checking if URL points to admin page:
		switch (self::$url_router->get_parts_count())  {
			case 1:
				if ($uri_array[0] == "rabbit-control") {
                                        self::$view->set_template_folder("admin");
                                        self::$view->set_template_file("index.php");
				}
				break;
			case 2:
				if ($uri_array[0] == "rabbit-control") {
                                        if ($uri_array[1] == "pages") {
                                            self::$view->set_template_folder("admin");
                                            self::$view->set_template_file("pages.php");
                                        }
                                        if ($uri_array[1] == "add-page") {
                                            self::$view->set_template_folder("admin");
                                            self::$view->set_template_file("add-page.php");
                                        }
                                        if ($uri_array[1] == "menus") {
                                            self::$view->set_template_folder("admin");
                                            self::$view->set_template_file("menus.php");
                                        }
				}
				break;
                        case 3:
				if ($uri_array[0] == "rabbit-control") {
                                        if ($uri_array[1] == "edit-page") {
                                            if (is_numeric($uri_array[2])) {
                                                self::$view->set_template_folder("admin");
                                                self::$view->set_template_file("edit-page.php");
                                                self::$view->set_parameter($uri_array[2]);
                                            }
                                        }
                                       if ($uri_array[1] == "menu-items") {
                                            if (is_numeric($uri_array[2])) {
                                                self::$view->set_template_folder("admin");
                                                self::$view->set_template_file("menu-items.php");
                                                self::$view->set_parameter($uri_array[2]);
                                            }
                                        }
				}
                                break;
		}
	}
        
	private static $url_router;
	private static $view;
}

class Action {
    public static function make() {
        if (!empty($_POST['action-module']) && !empty($_POST['action-method'])) {
            $module = addslashes(trim($_POST['action-module']));
            $method = addslashes(trim($_POST['action-method']));
            
            $method = str_replace("-", "_", $method);
            
            if (method_exists("Action$module", $method)) {
                call_user_func(array("Action$module", $method));
            }
            
        }
    }
}

class ActionPage {
    public static function add_page() {
        if (!empty($_POST['title']) && isset($_POST['url']) && !empty($_POST['text'])) {
            $title = addslashes(trim($_POST['title']));
            $url = addslashes(trim($_POST['url']));
            $text = addslashes(trim($_POST['text']));
            
            Message::put("danger", "Ошибка добавления страницы!");
            
            if (Database::add_page(new Page(array(
                "id" => '',
                "title" => $title,
                "url" => $url,
                "text" => $text
            )))) Message::put("success", "Страница была успешно добавлена!");
        }
    }
    
    public static function update_page() {
        if (!empty($_POST['id']) && !empty($_POST['title']) && !empty($_POST['url']) && !empty($_POST['text'])) {
            $id = addslashes(trim($_POST['id']));
            $title = addslashes(trim($_POST['title']));
            $url = addslashes(trim($_POST['url']));
            $text = addslashes(trim($_POST['text']));
            
            Message::put("danger", "Ошибка изменения страницы!");
            
            if (Database::update_page(new Page(array(
                "id" => $id,
                "title" => $title,
                "url" => $url,
                "text" => $text
            )))) Message::put("success", "Страница была успешно обновлена!");
        }
    }
    
    public static function delete_page() {
        if (!empty($_POST['id'])) {
            $id = addslashes(trim($_POST['id']));
            
            Message::put("danger", "Ошибка удаления страницы!");
            
            if (Database::delete_page($id)) {
                Message::put("success", "Страница была успешно удалена!");
            }
        }
    }
}

class ActionMenu {
    public static function add_menu() {
        if (!empty($_POST['name']) && !empty($_POST['tag'])) {
            $name = addslashes(trim($_POST['name']));
            $tag = addslashes(trim($_POST['tag']));
            
             Message::put("danger", "Ошибка добавления меню!");
            
            if (Database::add_menu(new Menu(array(
                "id" => '',
                "tag" => $tag,
                "name" => $name
            )))) Message::put("success", "Меню было успешно добавлено!");
        }
    }
    
    public static function delete_menu() {
        if (!empty($_POST['id'])) {
            $id = addslashes(trim($_POST['id']));
            
            Message::put("danger", "Ошибка удаления меню!");
            
            if (Database::delete_menu($id)) {
                Message::put("success", "Меню было успешно удалено!");
            }
        }
    }
}

class ActionMenuItem {
    public static function add_item() {
        if (!empty($_POST['menu_id']) && !empty($_POST['name']) && !empty($_POST['url'])) {
            $menu_id = addslashes(trim($_POST['menu_id']));
            $name = addslashes(trim($_POST['name']));
            $url = addslashes(trim($_POST['url']));
            
             Message::put("danger", "Ошибка добавления пункта меню!");
            
            if (Database::add_menu_item(new MenuItem(array(
                "id" => '',
                "menu_id" => $menu_id,
                "name" => $name,
                "url" => $url
            )))) Message::put("success", "Пункт меню был успешно добавлен!");
        }
    }
    
    public static function delete_item() {
        if (!empty($_POST['id'])) {
            $id = addslashes(trim($_POST['id']));
            
            Message::put("danger", "Ошибка удаления пункта меню!");
            
            if (Database::delete_menu_item($id)) {
                Message::put("success", "Пункт меню был успешно удаленён!");
            }
        }
    }
}
?>