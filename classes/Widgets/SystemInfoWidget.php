<?php

require_once 'classes/Widgets/AjaxWidget.php';

/**
 * This is a dashboard which provides all kinds of information about the system
 * on which it is running.
 *
 * @author Rob Bogie
 */
class SystemInfoWidget implements AjaxWidget{
    private $systemInfoTemplate;
    
    public function __construct() {
        $this->systemInfoTemplate = new Template("SystemInfoWidget.tpl");
        $this->systemInfoTemplate->setValue("SystemKernel", SystemInfoWidget::getKernelVersion());
        $this->systemInfoTemplate->setValue("SystemUptime", SystemInfoWidget::getUptime());
        $this->systemInfoTemplate->setValue("SystemHostname", SystemInfoWidget::getHostname());
        $this->systemInfoTemplate->setValue("SystemArchitecture", SystemInfoWidget::getArchitecture());
        $this->systemInfoTemplate->setValue("SystemOS", SystemInfoWidget::getOS());
        $this->systemInfoTemplate->setValue("SystemLoad", SystemInfoWidget::getLoad());
        $this->systemInfoTemplate->setValue("SystemTemperature", SystemInfoWidget::getTemperature());
    }
    
    public function __toString() {
        return $this->systemInfoTemplate->getOutput();
    }
    
    public static function getKernelVersion() {
        return exec('uname -r');
    }
    
    public static function getUptime() {
        $ss = exec('cat /proc/uptime'); // get uptime
        $s = $ss%60; // get seconds
        $m = floor(($ss%3600)/60); // get minutes
        $h = floor(($ss%86400)/3600); // get hours
        $d = floor(($ss%2592000)/86400); // get days
        $M = floor($ss/2592000);  // get months

        if(strlen($s) == 1) { $s = "0".$s; } // add preceding zero if necessary
        if(strlen($m) == 1) { $m = "0".$m; }
        if(strlen($h) == 1) { $h = "0".$h; }
        if(strlen($d) == 1) { $d = "0".$d; }
        if(strlen($M) == 1) { $M = "0".$M; }

        return $M."M, ".$d."d, ".$h."h, ".$m."m, ".$s."s";
    }
    
    public static function getHostname() {
        return exec('uname -n');
    }
    
    public static function getArchitecture() {
        return exec('uname -m');
    }
    
    public static function getOS() {
        return exec('uname -o');
    }
    
    public static function getLoad() {
        $input = exec('uptime'); // get data
        $output = explode("load average: ", $input); // break into pieces
        return $output[1]; // return load
    }
    
    public static function getTemperature() {
        return (exec('cat /sys/class/thermal/thermal_zone0/temp') / 1000)." &deg;C";
    }

    public function getAjaxInterval() {
        return 10000;
    }

    public function getAjaxScript() {
        return "function SystemInfoWidget() { $('#dashboard-load').load('Ajax.php?widget=SystemInfoWidget&action=updateLoad'); $('#dashboard-temperature').load('Ajax.php?widget=SystemInfoWidget&action=updateTemp');}";
    }

    public function processAction($action) {
        switch($action) {
            case "updateLoad":
                echo SystemInfoWidget::getLoad();
                break;
            case "updateTemp":
                echo SystemInfoWidget::getTemperature();
                break;
            default:
                echo "No data available!";
                break;
        }
    }
}

?>
