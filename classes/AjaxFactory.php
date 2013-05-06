<?php

/**
 * Description of AjaxFactory
 *
 * @author Rob
 */
class AjaxFactory {
    
    private $registeredWidgets;
    
    public function __construct() {
        $this->registeredWidgets = array();
    }
    
    public function registerWidget($widget) {
        if($widget instanceof AjaxWidget) {
            $this->registeredWidgets[] = $widget;
        } else {
            throw new UnexpectedValueException("Tried to register class which is not an AjaxWidget!");
        }
    }
    
    public function getAjaxIntervalFunction() {
        $output = "$(document).ready(function(){";

        foreach($this->registeredWidgets as $widget) {
            $output .= "setInterval('".  get_class($widget)."()', ".$widget->getAjaxInterval().");";
        }
        $output .= "});";
        return $output;
    }
    
    public function getAjaxFunctions() {
        $output = "";
        foreach($this->registeredWidgets as $widget) {
            $output .= $widget->getAjaxScript();
        }
        return $output;
    }
    
    public function __toString() {
        return $this->getAjaxIntervalFunction().$this->getAjaxFunctions();
    }
}

?>
