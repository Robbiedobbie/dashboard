<?php

include_once 'classes/dashboard/system/classautoloader.php';
$classAutoLoader = new \Dashboard\System\ClassAutoLoader(__DIR__."/classes", array("php", "class.php"), true);

\Dashboard\System\AuthenticationProvider::authenticate();

if(isset($_GET['widget'])) {
    $widget = '\\Dashboard\\Widgets\\'.$_GET['widget'];
    if(class_exists($widget)) {
        $widgetInstance = new $widget;
        if(is_a($widgetInstance, "\\Dashboard\\Ajax\\AjaxWidget")) {
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
