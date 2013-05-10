<?php

include("AuthenticationProvider.php");

require_once 'classes/Widgets/AjaxWidget.php';
require_once 'ClassLoader.php';
import();

if(isset($_GET['widget'])) {
    $widget = $_GET['widget'];
    if(class_exists($widget)) {
        $widgetInstance = new $widget;
        if(is_a($widgetInstance, "AjaxWidget")) {
            if(isset($_GET['action'])) {
                $action = $_GET['action'];
            } else {
                $action = "";
            }
            $widgetInstance->processAction($action);
        }
    }
}
?>
