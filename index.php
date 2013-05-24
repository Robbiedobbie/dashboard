<?php
error_reporting(E_ALL);

function exception_error_handler($errno, $errstr, $errfile, $errline ) {
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
}
set_error_handler("exception_error_handler");

include("AuthenticationProvider.php");

include_once 'classes/dashboard/system/classautoloader.php';

$classAutoLoader = new \Dashboard\System\ClassAutoLoader(__DIR__."/classes", array("php", "class.php"), true);

class DashBoard {
    private $pageTemplate;
    
    public function __construct() {
        $this->pageTemplate = new \Dashboard\System\Template("MainLayout.tpl");
    }
    
    public function displayPage() {
        include("config/settings.php");
        $ajaxFactory = new \Dashboard\Ajax\AjaxFactory();
        
        $systemInfoWidget = new \Dashboard\Widgets\SystemInfoWidget();
        $memoryWidget = new \Dashboard\Widgets\MemoryWidget();
        $storageWidget = new \Dashboard\Widgets\StorageWidget();
        $networkTrafficWidget = new \Dashboard\Widgets\NetworkTrafficWidget();
        $networkConnectionsWidget = new \Dashboard\Widgets\NetworkConnectionsWidget();
        
        $ajaxFactory->registerWidget($systemInfoWidget);
        $ajaxFactory->registerWidget($memoryWidget);
        $ajaxFactory->registerWidget($storageWidget);
        $ajaxFactory->registerWidget($networkTrafficWidget);
        $ajaxFactory->registerWidget($networkConnectionsWidget);
        
        $this->pageTemplate->setValue("DeviceName", $device_name);
        $this->pageTemplate->setValue("SystemInfoWidget", $systemInfoWidget);
        $this->pageTemplate->setValue("MemoryWidget", $memoryWidget);
        $this->pageTemplate->setValue("StorageWidget", $storageWidget);
        $this->pageTemplate->setValue("NetworkTrafficWidget", $networkTrafficWidget);
        $this->pageTemplate->setValue("NetworkConnectionsWidget", $networkConnectionsWidget);
        $this->pageTemplate->setValue("AjaxScripts", $ajaxFactory);
        echo $this->pageTemplate->getOutput();
    }
} 
$board = new DashBoard();
$board->displayPage();
?>
