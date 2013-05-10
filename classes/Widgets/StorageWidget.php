<?php

/**
 * This is a dashboard which provides all kinds of information about the system
 * on which it is running.
 *
 * @author Rob Bogie
 */
class StorageWidget implements AjaxWidget{
    private $storageTemplate;
    private $tableRowTemplate;
    public function __construct() {
        $this->storageTemplate = new Template("StorageWidget.tpl");
        $this->tableRowTemplate = new Template("StorageWidgetRow.tpl");
        $this->storageTemplate->setValue("StorageTableRows", $this->tableRowTemplate);
        $this->tableRowTemplate->setValues(StorageWidget::getStorageInfo());
    }
    
    public function __toString() {
        return $this->storageTemplate->getOutput();
    }
    
    public static function getStorageInfo() {
        $input = shell_exec('df -h'); // get from system
        $input_exp = explode("\n", $input); // turn into arrays
        
        $output = array();
        
        foreach ($input_exp as $line) { // for each line
            if($line != '' && $line[0] == '/' && $line[1] == 'd' && $line[2] == 'e' && $line[3] == 'v'){ // check if it starts with /dev
                $parts = preg_split('/\s+/', $line); // split
                $output[] = array(  "StorageDevice" => $parts[0],
                                    "StorageSize" => $parts[1],
                                    "StorageUsed" => $parts[2],
                                    "StorageAvailable" => $parts[3],
                                    "StorageUsage" => $parts[4],
                                    "StorageMountpoint" => $parts[5]);
            }
        }
        return $output;
    }

    public function processAction($action) {
        echo $this;
    }

    public function registerFunctions($ajaxFactory) {
        $ajaxFactory->registerFunction("function StorageWidget() { $('#dashboard-storage').load('Ajax.php?widget=StorageWidget');}");
        $ajaxFactory->registerInterval("StorageWidget", 30000);
    }
}

?>
