<?php
error_reporting(E_ALL);

function exception_error_handler($errno, $errstr, $errfile, $errline ) {
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
}
set_error_handler("exception_error_handler");

require_once('ClassLoader.php');
//Imports given classes (All if no argument is supplied)import();
import();

class DashBoard {
    private $pageTemplate;
    
    public function __construct() {
        $this->pageTemplate = new Template("MainLayout.tpl");
    }
    
    public function displayPage() {
        include("config/details.php");
        $ajaxFactory = new AjaxFactory();
        
        $systemInfoWidget = new SystemInfoWidget();
        $memoryWidget = new MemoryWidget();
        $storageWidget = new StorageWidget();
        $networkTrafficWidget = new NetworkTrafficWidget();
        $networkConnectionsWidget = new NetworkConnectionsWidget();
        
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
