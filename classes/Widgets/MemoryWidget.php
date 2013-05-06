<?php

/**
 * This is a dashboard which provides all kinds of information about the system
 * on which it is running.
 *
 * @author Rob Bogie
 */
class MemoryWidget implements AjaxWidget {
    private $memoryTemplate;
    private $tableRowTemplate;
    public function __construct() {
        $this->memoryTemplate = new Template("MemoryWidget.tpl");
        $this->tableRowTemplate = new Template("MemoryWidgetRow.tpl");
        $this->memoryTemplate->setValue("MemoryTableRows", $this->tableRowTemplate);
        $this->tableRowTemplate->setValues(MemoryWidget::getMemoryInfo());
    }
    
    public function __toString() {
        return $this->memoryTemplate->getOutput();
    }
    
    public static function getMemoryInfo() {
        $input = shell_exec('free -ohm'); // get from system
        $input_exp = explode("\n", $input); // turn into arrays

        $firstLine = true; // to check if it is the first line
        $output = array();
        foreach ($input_exp as $line) { // for each line
            
            if(!$firstLine) { // if it is not the first line
                $parts = preg_split('/\s+/', $line); // split
                if($parts[0] != "") {
                    $output[] = array("MemoryRowName" => $parts[0], "MemoryRowTotal" => $parts[1], "MemoryRowUsed" => $parts[2], "MemoryRowFree" => $parts[3]);
                }
            }
            $firstLine = false;
        }
        return $output;
    }
    
    public function getAjaxInterval() {
        return 30000;
    }

    public function getAjaxScript() {
        return "function MemoryWidget() { $('#dashboard-memory').load('Ajax.php?widget=MemoryWidget');}";
    }

    public function processAction($action) {
        echo $this;
    }
    
}

?>
