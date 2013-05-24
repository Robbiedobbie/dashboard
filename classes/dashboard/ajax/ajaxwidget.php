<?php

namespace Dashboard\Ajax {
    /**
     * This interface is used for widgets to have a uniform function which will
     * provide a way to get the javascript function which updates the widget.
     *
     * @author Rob Bogie
     */
    interface AjaxWidget {
        public function registerFunctions($ajaxFactory);
        public function processAction($action);
    }
}
?>
