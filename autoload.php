<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/TimeEntry.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('REDMINE_HOST', $_ENV['REDMINE_HOST']);
define('USERNAME', $_ENV['USERNAME']);
define('PASSWORD', $_ENV['PASSWORD']);
define('AUTH_KEY', $_ENV['AUTH_KEY']);
define('LOGIN_USER', $_ENV['LOGIN_USER']);