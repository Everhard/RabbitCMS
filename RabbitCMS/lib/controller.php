<?php
class Controller {
	public static function run() {
		self::$url_router = new URLRouter();
		self::$view = new View();
                
                Database::connect();
                
                // Make all actions:
                Action::make();
		
		// Not found page:
		self::$view->set_template_file("admin/not-found.php");
		
		if ($template_file = self::get_template_file()) {
			self::$view->set_template_file($template_file);
		}
		
		// Show front side:
		self::$view->show();
	}
	
	private static function get_template_file() {
	
		$uri_array = self::$url_router->get_uri_array();
                
                $template_file = false;
		
		switch (self::$url_router->get_parts_count())  {
			case 1:
				// Administrator panel:
				if ($uri_array[0] == "rabbit-control") {
					$template_file = "admin/index.php";
				}
				break;
			case 2:
				// Administrator panel:
				if ($uri_array[0] == "rabbit-control") {
					if ($uri_array[1] == "pages") $template_file = "admin/pages.php";
                                        if ($uri_array[1] == "add-page") $template_file = "admin/add-page.php";
				}
				break;
                        case 3:
                                // Administrator panel:
				if ($uri_array[0] == "rabbit-control") {
                                        if ($uri_array[1] == "edit-page") {
                                            if (is_numeric($uri_array[2])) {
                                                $template_file = "admin/edit-page.php";
                                                self::$view->set_parameter($uri_array[2]);
                                            }
                                        }
				}
                                break;
		}
		
		return $template_file;
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
        if (!empty($_POST['title']) && !empty($_POST['url']) && !empty($_POST['text'])) {
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
}
?>