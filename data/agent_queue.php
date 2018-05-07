<?php

define("DEFINE_ONLY",true);
define("SESSION_NO_WAIT",true);
define("SESSION_NO_WRITE",true);

//require_once( $_SERVER['DOCUMENT_ROOT'] . "define.php" );

// This script will fetch the number of agents available on the Frontier_Sales call queue and echo a json object with
// the result in order to display it in the agents available banner.

$agentsAvailable = 0;
try {

    $agentStatus = RV_SalesOps_CallQueueData::fetch_by_callqueue("ATT_Sales");
    if (!empty($agentStatus->AgentsAvailable)) {
        $agentsAvailable = $agentStatus->AgentsAvailable;
    }

} catch (Exception $e) {}

if (!headers_sent()) {
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');
    echo json_encode(array('available' => $agentsAvailable));
    exit;
}

?>