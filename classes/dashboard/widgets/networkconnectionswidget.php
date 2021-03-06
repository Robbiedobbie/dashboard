<?php
namespace Dashboard\Widgets {
    /**
     * This is a dashboard which provides all kinds of information about the system
     * on which it is running.
     *
     * @author Rob Bogie
     */
    class NetworkConnectionsWidget implements \Dashboard\Ajax\AjaxWidget {
        private $networkConnectionsTemplate;
        private $tableRowTemplate;
        public function __construct() {
            $this->networkConnectionsTemplate = new \Dashboard\System\Template("NetworkConnectionsWidget.tpl");
            $this->tableRowTemplate = new \Dashboard\System\Template("NetworkConnectionsWidgetRow.tpl");
            $this->networkConnectionsTemplate->setValue("NetworkConnectionsTableRows", $this->tableRowTemplate);
            $this->tableRowTemplate->setValues(NetworkConnectionsWidget::getNetworkConnectionsInfo());
        }

        public function __toString() {
            return $this->networkConnectionsTemplate->getOutput();
        }

        public static function getNetworkConnectionsInfo() {
            $input = shell_exec('netstat -t'); // get from system
            $input_exp = explode("\n", $input); // turn into arrays

            $lineCounter = 0; // to check if it is the first line
            $output = array();
            foreach ($input_exp as $line) { // for each line

                if($lineCounter > 1) { // if it is not the first line
                    $parts = preg_split('/\s+/', $line); // split
                    if(count($parts) >= 5) {
                        $output[] = array("ConnectionsProtocol" => $parts[0], "ConnectionsRQueue" => $parts[1], "ConnectionsSQueue" => $parts[2], "ConnectionsLocalAddress" => $parts[3], "ConnectionsForeignAddress" => $parts[4], "ConnectionsState" => $parts[5]);
                    }
                }
                $lineCounter++;
            }
            return $output;
        }

        public function processAction($action) {
            echo $this;
        }

        public function registerFunctions($ajaxFactory) {
            $ajaxFactory->registerFunction("function NetworkConnectionsWidget() { $('#dashboard-network').load('Ajax.php?widget=NetworkConnectionsWidget');}");
            $ajaxFactory->registerInterval("NetworkConnectionsWidget", 30000);
        }
    }
}
?>
