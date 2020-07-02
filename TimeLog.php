<?php
require_once __DIR__ . '/autoload.php';

/**
 * View Time Log
 * Add more Time Log
 * Del Time Log Id
 */

define('VIEW', 'view');
define('ADD', 'add');
define('DEL', 'del');

$delLogId = null;
$issueId = null;

$status = '';
if (isset($argv[1])) {
    echo "Status : {$argv[1]} \n";
    $status = $argv[1];
} else {
    echo "What do you want ? \n";
    echo "1. input 'view' => View Log All. \n";
    echo "2. input 'add {issue id}' => Add more Log for issue. \n";
    echo "3. input 'del {issue id} {log id}' => Delete Log by id of Log. \n";
    exit;
}

switch ($status) {
    case VIEW:
        break;
    case ADD:
        if (!isset($argv[2])) {
            $logger->error("Please input Issue Id.");
            exit;
        }
        $issueId = $argv[2];
        break;
    case DEL:
        if (!isset($argv[2])) {
            $logger->error("Please input Issue Id.");
            exit;
        }
        $issueId = $argv[2];

        if (!isset($argv[3])) {
            $logger->error("Please input Log Id.");
            exit;
        }
        $delLogId = $argv[3];
        break;
    default:
        $logger->error("Please only input view, add or del. \n");
        exit;
}

$timeEntry = new Api\TimeEntry($client);

if ($status == ADD && $issueId !== null) {
    echo "Add more log for {$issueId} . \n";
    $timeEntry->addMoreLogTime($issueId);
    echo "Add more log for today success. \n";
}

if ($status == DEL && $delLogId !== null) {
    echo "DELETE LOG ID : {$delLogId} . \n";
    $timeEntry->remove($delLogId);
}

echo "List Log for issues: {$issueId} : \n";
$timeEntries = $timeEntry->getAll($issueId, USER_ID, 5);
foreach ($timeEntries as $timeEntrie) {
    Api\TimeEntry::viewDetail($timeEntrie);
}