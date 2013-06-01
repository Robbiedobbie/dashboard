<?php
error_reporting(E_ALL);

function exception_error_handler($errno, $errstr, $errfile, $errline ) {
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
}
set_error_handler("exception_error_handler");

include_once 'classes/dashboard/system/classautoloader.php';

$classAutoLoader = new \Dashboard\System\ClassAutoLoader(__DIR__."/classes", array("php", "class.php"), true);

$page = "WidgetPage";

if(isset($_GET['page'])) {
	$page = $_GET['page'];
}

$pageRenderer = new \Dashboard\Common\PageRenderer();
$pageRenderer->renderPage($page);

?>
