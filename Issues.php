<?php
require_once __DIR__ . '/autoload.php';

define('VIEW', 'view');
define('UPDATE_STATUS', 'update_status');

$_statusList = array(VIEW, UPDATE_STATUS);

$status = '';
if (isset($argv[1]) && in_array($argv[1], $_statusList)) {
    echo "Status : {$argv[1]} \n";
    $status = $argv[1];
} else {
    echo "What do you want ? \n";
    echo "1. input 'view' => View info of issue id. \n";
    echo "2. input 'update_status {issue id} {status id}' => Update status for issue id. \n";
    exit;
}


$issueId = null;
if (isset($argv[2])) {
    $issueId = $argv[2];
} else {
    $logger->error("Please input issue id.");
    exit;
}

$valueUpdate = null;
if (isset($argv[3])) {
    $valueUpdate = $argv[3];
} elseif ($status !== VIEW) {
    $logger->error("Please input status id.");
    exit;
}

$message = "\nYou're {$status} issue : {$issueId} ";
$message .= ($status !== VIEW) ? "with content : {$valueUpdate} \n" : "\n";

$logger->info($message);

$issues = new Api\Issues($client);

// View status list of issue
$issues->getStatusListOfIssueId($issueId);

// View information of issue
$issues->getInfo($issueId);

if ($status === UPDATE_STATUS) {
    $issues->updateStatus($issueId, $valueUpdate, USER_ID);
    $issues->getInfo($issueId);
}
