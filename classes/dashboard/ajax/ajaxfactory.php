<?php

namespace Dashboard\Ajax {
    /**
     * Description of AjaxFactory
     *
     * @author Rob
     */
    class AjaxFactory {

        private $registeredIntervals;
        private $registeredFunctions;

        public function __construct() {
            $this->registeredIntervals = array();
            $this->registeredFunctions = array();
        }

        public function registerWidget($widget) {
            if($widget instanceof AjaxWidget) {
                $widget->registerFunctions($this);
            } else {
                throw new UnexpectedValueException("Tried to register object which is not an AjaxWidget!");
            }
        }

        public function getAjaxIntervalFunction() {
            $output = "$(document).ready(function(){";

            foreach($this->registeredIntervals as $interval) {
                $output .= "setInterval('".$interval[0]."()', ".$interval[1].");";
            }
            $output .= "});";
            return $output;
        }

        public function getAjaxFunctions() {
            $output = "";
            foreach($this->registeredFunctions as $function) {
                $output .= $function;
            }
            return $output;
        }

        public function registerInterval($functionName, $interval) {
            if(is_string($functionName) && is_integer($interval)) {
                $this->registeredIntervals[] = Array($functionName, $interval);
            } else {
                throw new UnexpectedValueException("Invalid argument(s) given!");
            }
        }

        public function registerFunction($function) {
            if(is_string($function)) {
                $this->registeredFunctions[] = $function;
            } else {
                throw new UnexpectedValueException("Invalid argument given!");
            }
        }

        public function __toString() {
            return $this->getAjaxIntervalFunction().$this->getAjaxFunctions();
        }
    }
}
?>
