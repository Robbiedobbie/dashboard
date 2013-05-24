<?php

namespace Dashboard\System {
    /**
     * TemplateLoader will load templates and will output a filled in template.
     *
     * @author Rob Bogie
     */
    class Template {
        private $fileContent;
        private $values;

        private $isMultipleOutputTemplate;

        public function __construct($file = NULL) {
            if($file != NULL) {
                $this->openFile("templates/".$file);
            }
            $this->values = array();
            $this->isMultipleOutputTemplate = false;
        }

        public function openFile($file) {
            $this->fileContent = file_get_contents($file);
            if($this->fileContent == false) {
                throw new IOException();
            }
        }

        public function setValue($key, $value) {
            if($this->isMultipleOutputTemplate) {
                $this->values = array();
            }
            $this->values[$key] = $value;
        }

        public function setValues($values) {
            if(is_array($values)) {
                $this->values = $values;

                //set boolean for which type of template this is
                $this->isMultipleOutputTemplate = (count($values) != count($values, 1));
            } else {
                throw new InvalidArgumentException("Expected array with values");
            }
        }

        public function getOutput() {
            $output = "";
            if(!$this->isMultipleOutputTemplate) {
                $output = $this->fileContent;
            }
            foreach($this->values as $key => $value) {
                if(is_array($value)) {
                    //value is another array, so we will output template multiple times
                    $partialOutput = $this->fileContent;
                    foreach($value as $tagKey => $tagValue) {
                        $tag = "{{@".$tagKey."}}";
                        $partialOutput = str_replace($tag, $tagValue, $partialOutput);
                    }
                    //Add the iteration to the output
                    $output .= $partialOutput;
                } else {
                    $tag = "{{@".$key."}}";
                    $output = str_replace($tag, $value, $output);
                }
            }
            return $output;
        }

        public function __toString() {
            return $this->getOutput();
        }
    }
}
?>
