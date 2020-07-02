<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Log.php';

$logger = new \Common\Log();

foreach (scandir(__DIR__ . '/api') as $file) {
    if (!in_array($file, array('.', '..')) && stristr($file, '.php')) {
        require_once __DIR__ . '/api/' . $file;
    }
}

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('REDMINE_HOST', $_ENV['REDMINE_HOST']);
define('USERNAME', $_ENV['USERNAME']);
define('PASSWORD', $_ENV['PASSWORD']);
define('AUTH_KEY', $_ENV['AUTH_KEY']);
define('LOGIN_USER', $_ENV['LOGIN_USER']);

$client = new Redmine\Client(REDMINE_HOST, USERNAME, PASSWORD, AUTH_KEY);

$apiUser = new Api\Users($client);
$_userLogin = $apiUser->getCurrentUser(LOGIN_USER);

if (isset($_userLogin)) {
    define('USER_ID', $_userLogin['id']);
    echo "Setting for User Login Id : {$_userLogin['id']}  \n";
} else {
    $logger->error("I don't know you with authentication.");
}
