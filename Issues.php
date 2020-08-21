<?php
require_once __DIR__ . '/autoload.php';

define('VIEW', 'view');
define('UPDATE_STATUS', 'update_status');
define('CHECK_STATUS', 'check_status');

$_statusList = array(VIEW, UPDATE_STATUS, CHECK_STATUS);

$status = '';
if (isset($argv[1]) && in_array($argv[1], $_statusList)) {
    echo "Status : {$argv[1]} \n";
    $status = $argv[1];
} else {
    echo "What do you want ? \n";
    echo "1. input 'view' => View info of issue id. \n";
    echo "2. input 'update_status {issue id} {status id}' => Update status for issue id. \n";
    echo "3. input 'check_status {issue id list}' => Check status for issue id list. \n";
    exit;
}


$issueId = null;
if (isset($argv[2])) {
    $issueId = str_replace(' ', '', $argv[2]);
} else {
    $logger->error("Please input issue id.");
}

$valueUpdate = null;
if (isset($argv[3])) {
    $valueUpdate = str_replace(' ', '', $argv[3]);
} elseif ($status == UPDATE_STATUS) {
    $logger->error("Please input status id.");
}

$issues = new Api\Issues($client);
// View status list of issue
$issues->getStatusListOfIssueId($issueId);

if ($status === VIEW) {
    // View information of issue
    $issues->getInfo($issueId);

    $view = sprintf('Link: %s/issues/%s', REDMINE_HOST, $issueId);
    $logger->warning($view);

    return;
}

if ($status === UPDATE_STATUS) {
    $issues->updateStatus($issueId, $valueUpdate, USER_ID);
    $issues->getInfo($issueId);

    $view = sprintf('Link: %s/issues/%s', REDMINE_HOST, $issueId);
    $logger->warning($view);

    return;
}

if ($status === CHECK_STATUS) {
    $issueList = explode("\n", $issueId);
    foreach($issueList as $id) {
        $issues->getStatus($id);
    }
}