<?php 
namespace Dashboard\Common {
	/**
	 * This class will 
	 * @author Rob Bogie
	 *
	 */
	class PageRenderer {
		public function __construct() {
			
		}
		
		public function renderPage($page) {
			$page = '\\Dashboard\\Common\\Pages\\'.$page;
			if(class_exists($page, true)) {
				$pageInstance = new $page;
				if(is_a($pageInstance, "\\Dashboard\\Common\\RenderablePage")) {
					$pageInstance->displayPage();
				}
			}
		}
	}
}
?>