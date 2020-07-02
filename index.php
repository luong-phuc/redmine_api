<?php
include_once __DIR__ . '/autoload.php';
$client = new Redmine\Client(REDMINE_HOST, USERNAME, PASSWORD, AUTH_KEY);

/* ==================== USING API ==================== */
define('VIEW', 'view');
define('ADD', 'add');
define('DEL', 'del');

$action = array(
    VIEW => 1,
    ADD => 2,
    DEL => 3
);
$delLogId = null;
$issueId = null;

$status = '';
if (isset($argv[1])) {
    echo "Status : {$argv[1]} \n";
    $status = $argv[1];
} else {
    echo "What do you want ? \n";
    echo "1. input 'view' => View Log All. \n";
    echo "2. input 'add' => Add more Log for issue. \n";
    echo "3. input 'del' => Delete Log by id of Log. \n";
    exit;
}

switch($status) {
    case VIEW:
        break;
    case ADD:
        if (!isset($argv[2])) {
            echo "Please input Issue Id. \n";
            exit;
        }
        $issueId = $argv[2];
        break;
    case DEL:
        if (!isset($argv[2])) {
            echo "Please input Issue Id. \n";
            exit;
        }
        $issueId = $argv[2];

        if(!isset($argv[3])) {
            echo "Please input Log Id. \n";
            exit;
        }
        $delLogId = $argv[3];
        break;
    default:
        echo "Please only input view, add or del. \n";
        exit;
}





$users = $client->user->getCurrentUser(['login' => LOGIN_USER]);
if(isset($users['user'])) {
    define('USER_ID', $users['user']['id']);
    echo "Setting for User Login : {$users['user']['login']}  \n";
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