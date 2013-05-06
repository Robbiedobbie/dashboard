<?php

/**
 * This interface is used for widgets to have a uniform function which will
 * provide a way to get the javascript function which updates the widget.
 *
 * @author Rob Bogie
 */
interface AjaxWidget {
    //Note that atleast one of the functions should have the same name as the class.
    public function getAjaxScript();
    public function getAjaxInterval();
    public function processAction($action);
}

?>
