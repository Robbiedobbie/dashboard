<?php

namespace Dashboard\System {
    /**
     * The autoloader can be used for setting everything up and registering the default spl_autoload.
     *
     * @author Rob Bogie
     */
    class ClassAutoLoader {

        private $path;
        private $extensions;

        /**
         * The default constructor
         * 
         * @param string $path The path to use when searching for classes
         * @param mixed $extensions The extensions to register. Can either be a string or an array with strings
         * @param bool $register Whether the autoloader should be registered after constructing or not
         */
        public function __construct($path = null, $extensions = null, $register = false) {
            $this->extensions = array();

            if ($path == null) {
                $this->path = __DIR__;
            }

            if ($extensions == null) {
                $this->addExtension("php");
            } else {
                $this->addExtension($extensions);
            }

            if (is_string($path)) {
                $this->path = $path;
            }
            
            if($register) {
                $this->register();
            }
        }

        /**
         * Remove an registered extension.
         * 
         * @param string $extension the extension to remove
         */
        public function removeExtension($extension) {
            if (substr($extension, 0, 1) != '.') {
                $extension = '.' . $extension;
            }
            if (isset($this->extensions[$extension])) {
                unset($this->extensions[$extension]);
            }
        }

        /**
         * Used to add one or more extensions for autoloading.
         * 
         * @param mixed $extension Accepts both an array with strings or a single string
         */
        public function addExtension($extension) {
            if (is_string($extension)) {
                $this->addSingleExtension($extension);
            } else if (is_array($extension)) {
                $this->addMultipleExtensions($extension);
            }
        }

        private function addSingleExtension($extension) {
            //check if first character is a dot, otherwise add one
            if (substr($extension, 0, 1) != '.') {
                $extension = '.' . $extension;
            }
            $this->extensions[$extension] = $extension;
        }

        private function addMultipleExtensions($extensions) {
            foreach ($extensions as $extension) {
                $this->addSingleExtension($extension);
            }
        }

        /**
         * Returns the path
         * 
         * @return string path
         */
        public function getPath() {
            return $this->path;
        }

        /**
         * This will set the include path for the classes to the supplied value.
         * 
         * @param type $path The path which should be set
         * @throws UnexpectedValueException Happens when an incorrect path is given
         */
        public function setPath($path) {
            if(is_string($var)) {
                $this->path = $path;
            } else {
                throw new UnexpectedValueException("Can't register a path which is not a string!");
            }
        }

        /**
         * This function returns the extensions that it currently has registered.
         * 
         * @return array An array filled with all extensions as strings.
         */
        public function getExtensions() {
            return $this->extensions;
        }

        /**
         * This function will register the spl_autoload function with all given settings. All settings set afterwards will not be registered.
         */
        public function register() {
            //change the extensions into one commaseperated list
            $extensions = implode(',', $this->extensions);
            //register extensions
            spl_autoload_extensions($extensions);

            //set include path
            set_include_path($this->path);

            //register the default function
            spl_autoload_register();
        }
    }
}
?>
