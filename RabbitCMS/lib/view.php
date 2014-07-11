<?php
defined('_RabbitCMS') or die('Restricted access');

class View {
	function __construct() {
		$this->site_path = getcwd();
	}

        // Show template:
	public function show() {
            
            if ($this->not_found) {
                header("HTTP/1.1 404 Not Found");
                $this->set_template_includes(false);
                $this->set_template_folder("admin");
                $this->set_template_file("not-found.php");
            }
            
            // Include header:
            if ($this->template_includes) {
                require_once($this->site_path.'/'.$this->template_folder.'/includes/header.php');
            }
            
            // Include template:
            require_once($this->site_path.'/'.$this->template_folder.'/'.$this->template_file);
            
            // Include footer:
            if ($this->template_includes) {
                require_once($this->site_path.'/'.$this->template_folder.'/includes/footer.php');
            }
	}
        
        // Get template folder:
        public function get_template_folder() {
            return $this->template_folder;
        }
	
        // Get template file:
	public function get_template_file() {
		return $this->template_file;
	}
        
        // Get output content:
        public function get_content() {
            return $this->content;
        }
        
        // Set output content:
        public function set_content($content) {
            $this->content = $content;
        }
        
        // Set template folder:
        public function set_template_folder($template_folder) {
            $this->template_folder = $template_folder;
        }
	
        // Set template file:
	public function set_template_file($template_file) {
                $this->not_found = false;
		$this->template_file = $template_file;
	}
        
        public function set_template_includes($value) {
            $this->template_includes = $value;
        }
        
        public function set_not_found_template() {
            $this->not_found = true;
        }

        // Not found flag:
        private $not_found = false;
        
        // Path, where located root index.php:
	private $site_path;
        
        // Template file:
	private $template_file;

        // Template folder:
	private $template_folder;
        
        // Header and footer includes flag:
        private $template_includes = true;
        
        // Output content:
        private $content;
}
?>