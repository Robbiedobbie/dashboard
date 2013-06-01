<?php 
namespace Dashboard\Common {
	/**
	 * This class will
	 * @author Rob Bogie
	 *
	 */
	class PageRenderer {
		private $errorPage;

		public function __construct() {
			$this->errorPage = new \Dashboard\Common\Pages\ErrorPage();
		}

		public function renderPage($page) {
			$page = '\\Dashboard\\Common\\Pages\\'.$page;
			try {
				/*Just catch the LogicException that occurs when the autoloader can't find the class.
				 *Php should solve the exception throwing in the class_exists function...*/
				if(class_exists($page)) {
					$pageInstance = new $page;
					
					if(is_a($pageInstance, "\\Dashboard\\Common\\RenderablePage")) {
						$pageInstance->displayPage();
					}
					else {
						$this->errorPage->displayError404();
					}
				}
			} catch(\LogicException $e) {
				$this->errorPage->displayError404();
			}
			
			
		}
	}
}
?>