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
        $this->pageTemplate->setValue("DeviceName", $device_name);
        $this->pageTemplate->setValue("SystemInfoWidget", new SystemInfoWidget());
        $this->pageTemplate->setValue("MemoryWidget", new MemoryWidget());
        $this->pageTemplate->setValue("StorageWidget", new StorageWidget());
        $this->pageTemplate->setValue("NetworkTrafficWidget", new NetworkTrafficWidget());
        $this->pageTemplate->setValue("NetworkConnectionsWidget", new NetworkConnectionWidget());
        echo $this->pageTemplate->getOutput();
    }
} 
$board = new DashBoard();
$board->displayPage();
?>
