<?php

/**
 * This is a dashboard which provides all kinds of information about the system
 * on which it is running.
 *
 * @author Rob Bogie
 */
class NetworkTrafficWidget implements AjaxWidget {
    private $networkTrafficTemplate;
    private $tableRowTemplate;
    public function __construct() {
        $this->networkTrafficTemplate = new Template("NetworkTrafficWidget.tpl");
        $this->tableRowTemplate = new Template("NetworkTrafficWidgetRow.tpl");
        $this->networkTrafficTemplate->setValue("NetworkTrafficTableRows", $this->tableRowTemplate);
        $this->tableRowTemplate->setValues(NetworkTrafficWidget::getNetworkTrafficInfo());
    }
    
    public function __toString() {
        return $this->networkTrafficTemplate->getOutput();
    }
    
    public static function getNetworkTrafficInfo() {
        $input = shell_exec('vnstat -s'); // get from system
        $input_exp = explode("\n", $input); // turn into arrays

        $lineCounter = 0; // to check if it is the first line
        $output = array();
        foreach ($input_exp as $line) { // for each line
            
            if($lineCounter > 1) { // if it is not the first line
                $parts = explode("/", $line);
                $firstpiece = substr($parts[0], 0, 14);
                $parts[0] = substr($parts[0], 14);
                
                if(count($parts) >= 4) {
                    $output[] = array("TrafficInterfaceDate" => trim($firstpiece), "TrafficRX" => $parts[0], "TrafficTX" => $parts[1], "TrafficTotal" => $parts[2], "TrafficEstimated" => $parts[3]);
                } else if(count($parts) == 3) {
                    $output[] = array("TrafficInterfaceDate" => trim($firstpiece), "TrafficRX" => $parts[0], "TrafficTX" => $parts[1], "TrafficTotal" => $parts[2], "TrafficEstimated" => "");
                } else {
                    $output[] = array("TrafficInterfaceDate" => trim($firstpiece), "TrafficRX" => "", "TrafficTX" => "", "TrafficTotal" => "", "TrafficEstimated" => "");
                }
            }
            $lineCounter++;
        }
        if(count($output) == 0) {
            $output[] = array("TrafficInterfaceDate" => "No data available!", "TrafficRX" => "", "TrafficTX" => "", "TrafficTotal" => "", "TrafficEstimated" => "");
        }
        return $output;
    }
    
    public function getAjaxInterval() {
        return 30000;
    }

    public function getAjaxScript() {
        return "function NetworkTrafficWidget() { $('#dashboard-traffic').load('Ajax.php?widget=NetworkTrafficWidget');}";
    }

    public function processAction($action) {
        echo $this;
    }
}

?>
