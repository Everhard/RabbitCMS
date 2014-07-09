<?php
class View {
	function __construct() {
		$this->site_path = getcwd();
	}

        // Show template:
	public function show() {
            
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

        // Get parameter:
        public function get_parameter() {
            return $this->parameter;
        }
        
        // Set template folder:
        public function set_template_folder($template_folder) {
            $this->template_folder = $template_folder;
        }
	
        // Set template file:
	public function set_template_file($template_file) {
		$this->template_file = $template_file;
	}
        
        // Set parameter:
        public function set_parameter($parameter) {
            $this->parameter = $parameter;
        }
        
        public function set_template_includes($value) {
            $this->template_includes = $value;
        }
        

        // Path, where located root index.php:
	private $site_path;
        
        // Template file:
	private $template_file;

        // Template folder:
	private $template_folder;
        
        // Parameter from URL:
        private $parameter;
        
        // Header and footer includes flag:
        private $template_includes = true;
}
?>