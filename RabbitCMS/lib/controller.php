<?php
class Controller {
	public static function run() {
		self::$url_router = new URLRouter();
		self::$view = new View();
		Database::connect();
		Database::get_pages();
		
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
				}
				break;
			default:
				$template_file = false;
				break;
		}
		
		return $template_file;
	}
	
	private static $url_router;
	private static $view;
}	
?>