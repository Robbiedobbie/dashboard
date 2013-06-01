<?php
namespace Dashboard\Common\Pages {
	class ErrorPage{
		
		public function displayError404() {
			header('HTTP/1.0 404 Not Found');
			$template = new \Dashboard\System\Template("Error404.tpl");
			include 'config/settings.php';
			$template->setValue("DeviceName", $device_name);
			echo $template->getOutput();
		}
	}
} 
?>