<?php
namespace Dashboard\Widgets {
    /**
     * This is a dashboard which provides all kinds of information about the system
     * on which it is running.
     *
     * @author Rob Bogie
     */
    class StorageWidget implements \Dashboard\Ajax\AjaxWidget{
        private $storageTemplate;
        private $tableRowTemplate;
        public function __construct() {
            include("config/settings.php");
            $this->storageTemplate = new \Dashboard\System\Template("StorageWidget.tpl");
            $this->tableRowTemplate = new \Dashboard\System\Template("StorageWidgetRow.tpl");
            $this->storageTemplate->setValue("StorageTableRows", $this->tableRowTemplate);
            $this->tableRowTemplate->setValues(StorageWidget::getStorageInfo());
            $this->storageTemplate->setValue("StorageUnmountColumn", "");
            if($unmountEnabled) {
                $this->storageTemplate->setValue("StorageUnmountColumn", "<th><span class='color'>Unmount</span></th>");
            }
        }

        public function __toString() {
            return $this->storageTemplate->getOutput();
        }

        public static function getStorageInfo() {
            include("config/settings.php");
            $input = shell_exec('df -h'); // get from system
            $input_exp = explode("\n", $input); // turn into arrays

            $output = array();

            $ignoredDevices = array();
            if($unmountEnabled) {
                $ignoredDevices = explode(";", $ignoredStorageDevices);
            }

            foreach ($input_exp as $line) { // for each line
                if($line != '' && $line[0] == '/' && $line[1] == 'd' && $line[2] == 'e' && $line[3] == 'v'){ // check if it starts with /dev
                    $parts = preg_split('/\s+/', $line); // split
                    //add part for the unmount button
                    $parts[6] = "";

                    if($unmountEnabled) {
                        if(!in_array($parts[0], $ignoredDevices)) {
                            $parts[6] = "<td><a href=\"javascript:unmountStorageDevice('".$parts[0]."');\">X</a></td>";
                        } else {
                            $parts[6] = "<td></td>";
                        }
                    }

                    $output[] = array(  "StorageDevice" => $parts[0],
                                        "StorageSize" => $parts[1],
                                        "StorageUsed" => $parts[2],
                                        "StorageAvailable" => $parts[3],
                                        "StorageUsage" => $parts[4],
                                        "StorageMountpoint" => $parts[5],
                                        "StorageUnmountCell" => $parts[6]);
                }
            }
            return $output;
        }

        public function processAction($action) {
            if($action == "unmount") {
                include("config/settings.php");
                if($unmountEnabled && isset($_GET['device'])) {
                    $ignoredDevices = explode(";", $ignoredStorageDevices);
                    $device = $_GET['device'];
                    $storageInfo = $this->getStorageInfo();
                    $containsDevice = false;
                    $deviceInfo = array();
                    foreach($storageInfo as $row) {
                        if($device == $row['StorageDevice']) {
                            $containsDevice = true;
                            $deviceInfo = $row;
                            break;
                        }
                    }

                    if(!$containsDevice || in_array($device, $ignoredDevices)) {
                        echo "Invalid Device";
                        return;
                    }

                    $returnStatus = 0;
                    $command = "sudo umount ".$row['StorageMountpoint']." 2>&1";
                    echo exec($command, $unmountResult, $returnStatus);
                }
            } else {
                echo $this;
            }
        }

        public function registerFunctions($ajaxFactory) {
            $ajaxFactory->registerFunction("function StorageWidget() { $('#dashboard-storage').load('Ajax.php?widget=StorageWidget');}");
            $ajaxFactory->registerInterval("StorageWidget", 30000);
            //register unmount function
            $ajaxFactory->registerFunction("function unmountStorageDevice(device) {
                    $.get(\"Ajax.php?widget=StorageWidget&action=unmount&device=\"+device, function(data,status) {
                        if(data==\"\") {
                            StorageWidget();
                        } else {
                            alert(data);
                        }
                    });
                }");
        }
    }
}
?>
